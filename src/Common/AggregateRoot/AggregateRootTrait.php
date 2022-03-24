<?php

namespace App\Common\AggregateRoot;

use App\Common\CQRS\EventInterface;

trait AggregateRootTrait
{
    /**
     * @var EventInterface[]
     */
    protected array $events = [];

    public function popEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    protected function raise(EventInterface $event): self
    {
        $this->events[] = $event;

        return $this;
    }

    public function countEvents(): int
    {
        return count($this->events);
    }
}
