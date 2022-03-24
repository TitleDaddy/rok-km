<?php

namespace App\Domain\Governor\Query\Query;

use App\Common\CQRS\QueryInterface;

class GetGovernorByGameIdQuery implements QueryInterface
{
    private string $gameId;

    public function __construct(string $gameId)
    {
        $this->gameId = $gameId;
    }

    public function getGameId(): string
    {
        return $this->gameId;
    }
}
