<?php

namespace App\Common\CQRS;

interface EventBusInterface
{
    public function dispatch(EventInterface $event): void;
}
