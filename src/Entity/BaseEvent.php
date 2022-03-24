<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
#[ORM\HasLifecycleCallbacks]
abstract class BaseEvent extends BaseEntity
{
    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $startDate;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $recurringEvery = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getRecurringEvery(): ?int
    {
        return $this->recurringEvery;
    }

    public function setRecurringEvery(?int $recurringEvery): self
    {
        $this->recurringEvery = $recurringEvery;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
