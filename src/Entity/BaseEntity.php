<?php

namespace App\Entity;

use App\Common\AggregateRoot\AggregateRootInterface;
use App\Common\AggregateRoot\AggregateRootTrait;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Stringable;

/**
 * Adds id, created at and updated at timestamps to entities.
 * Entities using this must have HasLifecycleCallbacks annotation.
 */
#[ORM\MappedSuperclass]
#[ORM\HasLifecycleCallbacks]
abstract class BaseEntity implements AggregateRootInterface, Stringable
{
    use AggregateRootTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'guid')]
    protected string $id;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    protected DateTimeInterface $createdAt;

    #[ORM\Column(name: 'updated_at', type: 'datetime')]
    protected DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function getId(): string
    {
        return $this->id;
    }

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new DateTime();
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function __toString(): string
    {
        $cls = static::class;

        return "[{$cls}] {$this->id}";
    }
}
