<?php

namespace App\Common\AggregateRoot;

use App\Common\CQRS\EventInterface;

/**
 * @author John White <john@jontyy.com>
 */
interface AggregateRootInterface
{
    /**
     * Get any raised domain events
     * @return EventInterface[]
     */
    public function popEvents(): array;

    public function countEvents(): int;
}
