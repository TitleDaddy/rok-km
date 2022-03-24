<?php

namespace App\Entity\Alliance;

use App\Entity\BaseEvent;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class AllianceEvent extends BaseEvent
{
    #[ORM\ManyToOne(targetEntity: Alliance::class, inversedBy: 'allianceEvents')]
    #[ORM\JoinColumn(nullable: false)]
    private Alliance $alliance;

    public function getAlliance(): ?Alliance
    {
        return $this->alliance;
    }

    public function setAlliance(?Alliance $alliance): self
    {
        $this->alliance = $alliance;

        return $this;
    }
}
