<?php

namespace App\Entity\Commander;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Pairing extends BaseEntity
{
    #[ORM\ManyToOne(targetEntity: Commander::class, inversedBy: 'pairingsAsPrimaryCommander')]
    #[ORM\JoinColumn(nullable: false)]
    private Commander $primaryCommander;

    #[ORM\ManyToOne(targetEntity: Commander::class, inversedBy: 'pairingsAsSecondaryCommander')]
    #[ORM\JoinColumn(nullable: false)]
    private Commander $secondaryCommander;

    public function __construct(Commander $primaryCommander, Commander $secondaryCommander)
    {
        parent::__construct();
        $this->primaryCommander = $primaryCommander;
        $this->secondaryCommander = $secondaryCommander;
    }

    public function getPrimaryCommander(): ?Commander
    {
        return $this->primaryCommander;
    }

    public function setPrimaryCommander(?Commander $primaryCommander): self
    {
        $this->primaryCommander = $primaryCommander;

        return $this;
    }

    public function getSecondaryCommander(): ?Commander
    {
        return $this->secondaryCommander;
    }

    public function setSecondaryCommander(?Commander $secondaryCommander): self
    {
        $this->secondaryCommander = $secondaryCommander;

        return $this;
    }
}
