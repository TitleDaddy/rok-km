<?php

namespace App\Entity\Kingdom;

use App\Entity\BaseEvent;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class KingdomEvent extends BaseEvent
{
    #[ORM\ManyToOne(targetEntity: Kingdom::class, inversedBy: 'kingdomEvents')]
    #[ORM\JoinColumn(nullable: false)]
    private Kingdom $kingdom;

    public function getKingdom(): ?Kingdom
    {
        return $this->kingdom;
    }

    public function setKingdom(?Kingdom $kingdom): self
    {
        $this->kingdom = $kingdom;

        return $this;
    }
}
