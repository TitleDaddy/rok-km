<?php

namespace App\Common\CQRS;

interface QueryBusInterface
{
    public function handle(QueryInterface $query): mixed;
}
