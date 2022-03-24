<?php

namespace App\Entity\News;

use App\Entity\BaseEntity;
use App\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class NewsPost extends BaseEntity
{
    #[ORM\Column(name: 'title', type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(name: 'body', type: 'text')]
    private string $body;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'author_id', referencedColumnName: 'id')]
    private User $author;

    public function __construct(
        User $author,
        string $title = '',
        string $body = ''
    ) {
        parent::__construct();
        $this->author = $author;
        $this->title = $title;
        $this->body = $body;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
