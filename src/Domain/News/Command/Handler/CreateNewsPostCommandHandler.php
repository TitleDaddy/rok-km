<?php

namespace App\Domain\News\Command\Handler;

use App\Common\CQRS\CommandHandlerInterface;
use App\Common\CQRS\QueryBusInterface;
use App\Domain\News\Command\Command\CreateNewsPostCommand;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Query\Query\FindUserByIdQuery;
use App\Entity\News\NewsPost;
use App\Repository\News\NewsPostRepositoryInterface;

class CreateNewsPostCommandHandler implements CommandHandlerInterface
{
    private NewsPostRepositoryInterface $newsPostRepository;
    private QueryBusInterface $queryBus;

    public function __construct(
        NewsPostRepositoryInterface $newsPostRepository,
        QueryBusInterface $queryBus,
    ) {
        $this->newsPostRepository = $newsPostRepository;
        $this->queryBus = $queryBus;
    }

    public function __invoke(CreateNewsPostCommand $command)
    {
        $user = $this->queryBus->handle(new FindUserByIdQuery($command->getAuthorId()));
        if (! $user) {
            throw new UserNotFoundException($command->getAuthorId());
        }
        $post = new NewsPost($user, $command->getTitle(), $command->getBody());
        $this->newsPostRepository->save($post);
    }
}
