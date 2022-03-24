<?php

namespace App\Entity\Governor;

use App\Entity\BaseEntity;
use App\Entity\Commander\Commander;
use App\Entity\Kingdom\Kingdom;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class MightiestGovernorRequests extends BaseEntity
{
    #[ORM\ManyToOne(targetEntity: Kingdom::class, inversedBy: 'mightiestGovernorRequests')]
    #[ORM\JoinColumn(nullable: false)]
    private Kingdom $kingdom;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $season;

    #[ORM\ManyToOne(targetEntity: Governor::class, inversedBy: 'mightiestGovernorRequests')]
    #[ORM\JoinColumn(nullable: false)]
    private Governor $governor;

    #[ORM\Column(type: 'boolean')]
    private bool $awarded = false;

    #[ORM\ManyToOne(targetEntity: Commander::class, inversedBy: 'mightiestGovernorRequests')]
    #[ORM\JoinColumn(nullable: false)]
    private Commander $commander;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $rank;

    public function getKingdom(): ?Kingdom
    {
        return $this->kingdom;
    }

    public function setKingdom(?Kingdom $kingdom): self
    {
        $this->kingdom = $kingdom;

        return $this;
    }

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function setSeason(int $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getGovernor(): ?Governor
    {
        return $this->governor;
    }

    public function setGovernor(?Governor $governor): self
    {
        $this->governor = $governor;

        return $this;
    }

    public function getAwarded(): ?bool
    {
        return $this->awarded;
    }

    public function setAwarded(bool $awarded): self
    {
        $this->awarded = $awarded;

        return $this;
    }

    public function getCommander(): ?Commander
    {
        return $this->commander;
    }

    public function setCommander(?Commander $commander): self
    {
        $this->commander = $commander;

        return $this;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(?int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function __toString(): string
    {
        return 'MightiestGovernorRequest';
    }
}
