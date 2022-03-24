<?php

namespace App\Domain\Commander\Query\Query;

use App\Common\CQRS\QueryInterface;

class FindCommanderPairingByNamesQuery implements QueryInterface
{
    private string $primaryCommanderId;
    private string $secondaryCommanderId;

    public function __construct(string $primaryCommanderId, string $secondaryCommanderId)
    {
        $this->primaryCommanderId = $primaryCommanderId;
        $this->secondaryCommanderId = $secondaryCommanderId;
    }

    public function getPrimaryCommanderId(): string
    {
        return $this->primaryCommanderId;
    }

    public function getSecondaryCommanderId(): string
    {
        return $this->secondaryCommanderId;
    }
}
