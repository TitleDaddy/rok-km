<?php

namespace App\Controller\Api\V1\Commander;

use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\Commander\Exception\TalentTreeNotFoundException;
use App\Domain\Commander\Integrations\FS\TalentTreeFileSystemInterface;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/commander/talent_tree/{filename}', name: 'api_v1_fetch_talent_tree', methods: ['GET'])]
class FetchTalentTreeController extends AbstractApiV1Controller
{
    private TalentTreeFileSystemInterface $talentTreeFileSystem;

    public function __construct(TalentTreeFileSystemInterface $talentTreeFileSystem)
    {
        $this->talentTreeFileSystem = $talentTreeFileSystem;
    }

    public function __invoke(string $filename)
    {
        if (! $this->talentTreeFileSystem->isFileExists($filename)) {
            throw new TalentTreeNotFoundException($filename);
        }

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            $filename,
        );
        $contents = $this->talentTreeFileSystem->readContentsFromFile($filename);
        $response = new Response($contents);
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }
}
