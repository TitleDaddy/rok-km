<?php

namespace App\Domain\Commander\Command\Command;

use App\Common\CQRS\CommandInterface;
use App\Entity\Commander\Commander;

class DeleteCommanderPairingCommand implements CommandInterface
{
    private Commander $primaryCommander;
    private Commander $secondaryCommander;

    public function __construct(Commander $primaryCommander, Commander $secondaryCommander)
    {
        $this->primaryCommander = $primaryCommander;
        $this->secondaryCommander = $secondaryCommander;
    }

    public function getPrimaryCommander(): Commander
    {
        return $this->primaryCommander;
    }

    public function getSecondaryCommander(): Commander
    {
        return $this->secondaryCommander;
    }
}
