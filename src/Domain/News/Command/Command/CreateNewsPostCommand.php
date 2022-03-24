<?php

namespace App\Domain\News\Command\Command;

use App\Common\CQRS\CommandInterface;

class CreateNewsPostCommand implements CommandInterface
{
    private string $userId;
    private string $title;
    private string $body;

    public function __construct(string $userId, string $title, string $body)
    {
        $this->userId = $userId;
        $this->title = $title;
        $this->body = $body;
    }

    public function getAuthorId(): string
    {
        return $this->userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
