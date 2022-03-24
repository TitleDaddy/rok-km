<?php

namespace App\Entity\Kingdom;

use App\Entity\BaseEntity;
use App\Entity\Governor\GovernorScan;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class KvKSeasonTarget extends BaseEntity
{
    #[ORM\Column(type: 'integer')]
    private int $startingPower = 0;

    #[ORM\Column(type: 'integer')]
    private int $endingPower = 0;

    #[ORM\Column(type: 'integer')]
    private int $deaths = 0;

    #[ORM\Column(type: 'integer')]
    private int $points = 0;

    #[ORM\Column(type: 'integer')]
    private int $rssDonations = 0;

    #[ORM\OneToMany(mappedBy: 'season', targetEntity: GovernorScan::class, orphanRemoval: true)]
    private Collection $governorScans;

    public function __construct()
    {
        parent::__construct();
        $this->governorScans = new ArrayCollection();
    }

    public function getStartingPower(): ?int
    {
        return $this->startingPower;
    }

    public function setStartingPower(int $startingPower): self
    {
        $this->startingPower = $startingPower;

        return $this;
    }

    public function getEndingPower(): ?int
    {
        return $this->endingPower;
    }

    public function setEndingPower(int $endingPower): self
    {
        $this->endingPower = $endingPower;

        return $this;
    }

    public function getDeaths(): ?int
    {
        return $this->deaths;
    }

    public function setDeaths(int $deaths): self
    {
        $this->deaths = $deaths;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getRssDonations(): ?int
    {
        return $this->rssDonations;
    }

    public function setRssDonations(int $rssDonations): self
    {
        $this->rssDonations = $rssDonations;

        return $this;
    }

    /**
     * @return Collection<int, GovernorScan>
     */
    public function getGovernorScans(): Collection
    {
        return $this->governorScans;
    }

    public function addGovernorScan(GovernorScan $governorScan): self
    {
        if (! $this->governorScans->contains($governorScan)) {
            $this->governorScans[] = $governorScan;
            $governorScan->setSeason($this);
        }

        return $this;
    }

    public function removeGovernorScan(GovernorScan $governorScan): self
    {
        if ($this->governorScans->removeElement($governorScan)) {
            // set the owning side to null (unless already changed)
            if ($governorScan->getSeason() === $this) {
                $governorScan->setSeason(null);
            }
        }

        return $this;
    }
}
