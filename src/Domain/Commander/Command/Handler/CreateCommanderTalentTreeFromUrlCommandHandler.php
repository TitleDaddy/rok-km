<?php

namespace App\Domain\Commander\Command\Handler;

use App\Common\CQRS\CommandHandlerInterface;
use App\Common\Http\Client\Exception\UnexpectedHTTPStatusCodeException;
use App\Domain\Commander\Command\Command\CreateCommanderTalentTreeFromUrlCommand;
use App\Domain\Commander\Exception\CommanderNotFoundException;
use App\Domain\Commander\Exception\TalentTreeAlreadyExistsException;
use App\Domain\Commander\Integrations\FS\TalentTreeFileSystemInterface;
use App\Entity\Commander\TalentTree;
use App\Repository\Commander\CommanderRepositoryInterface;
use App\Repository\Commander\TalentTreeRepositoryInterface;
use Symfony\Component\Mime\MimeTypes;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CreateCommanderTalentTreeFromUrlCommandHandler implements CommandHandlerInterface
{
    private const ALLOWED_IMAGE_DOWNLOADS = [
        'jpeg',
        'jpg',
        'png',
        'webp',
        'gif',
    ];

    private TalentTreeRepositoryInterface $talentTreeRepository;
    private CommanderRepositoryInterface $commanderRepository;
    private TalentTreeFileSystemInterface $talentTreeFileSystem;
    private HttpClientInterface $httpClient;

    public function __construct(
        TalentTreeRepositoryInterface $skillRepository,
        CommanderRepositoryInterface $commanderRepository,
        TalentTreeFileSystemInterface $talentTreeFileSystem,
        HttpClientInterface $httpClient
    ) {
        $this->talentTreeRepository = $skillRepository;
        $this->commanderRepository = $commanderRepository;
        $this->talentTreeFileSystem = $talentTreeFileSystem;
        $this->httpClient = $httpClient;
    }

    public function __invoke(CreateCommanderTalentTreeFromUrlCommand $command)
    {
        $talentTree = $this->talentTreeRepository->forCommanderWithName($command->getCommanderId(), $command->getName());
        if ($talentTree) {
            throw new TalentTreeAlreadyExistsException($command->getName());
        }

        $commander = $this->commanderRepository->findOneById($command->getCommanderId());
        if (! $commander) {
            throw new CommanderNotFoundException($command->getCommanderId());
        }

        $contents = $this->fetchFileFromUrl($command->getUrl());
        $extension = $this->getFileExtension($contents);
        if (! $extension || ! in_array($extension, self::ALLOWED_IMAGE_DOWNLOADS, true)) {
            return; // Likely not a valid file
        }

        $talentTree = new TalentTree($commander, $command->getName(), $extension);
        $this->talentTreeRepository->save($talentTree);
        $this->talentTreeFileSystem->saveContentsToFile($contents, $talentTree->getFilename());
    }

    private function getFileExtension(string $contents): ?string
    {
        $tmpFile = tmpfile();
        fwrite($tmpFile, $contents);
        $metaData = stream_get_meta_data($tmpFile);
        $tmpFilename = $metaData['uri'];
        $mimeGuesser = new MimeTypes();
        $type = $mimeGuesser->guessMimeType($tmpFilename);
        $potentialExtensions = $mimeGuesser->getExtensions($type);
        fclose($tmpFile);

        return $potentialExtensions ? $potentialExtensions[0] : null;
    }

    private function fetchFileFromUrl(string $url): string
    {
        $response = $this->httpClient->request('GET', $url);
        if (! $response->getStatusCode() === 200) {
            throw new UnexpectedHTTPStatusCodeException([200], $response->getStatusCode());
        }

        return $response->getContent();
    }
}
