<?php

namespace App\Entity\Kingdom;

use App\Entity\BaseEntity;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class KvKSeason extends BaseEntity
{
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $season;

    #[ORM\Column(type: 'date')]
    private DateTimeInterface $startDate;

    #[ORM\Column(type: 'integer')]
    private int $tierOneKillWeight = 0;

    #[ORM\Column(type: 'integer')]
    private int $tierTwoKillWeight = 0;

    #[ORM\Column(type: 'integer')]
    private int $tierThreeKillWeight = 0;

    #[ORM\Column(type: 'integer')]
    private int $tierFourKillWeight = 0;

    #[ORM\Column(type: 'integer')]
    private int $tierFiveKillWeight = 0;

    #[ORM\Column(type: 'integer')]
    private int $deathWeight = 0;

    #[ORM\Column(type: 'decimal', precision: 20, scale: 5, nullable: false)]
    private float $rssWeight = 0;

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function setSeason(int $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getStartDate(): ?DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getTierOneKillWeight(): int
    {
        return $this->tierOneKillWeight;
    }

    public function setTierOneKillWeight(int $tierOneKillWeight): self
    {
        $this->tierOneKillWeight = $tierOneKillWeight;

        return $this;
    }

    public function getTierTwoKillWeight(): int
    {
        return $this->tierTwoKillWeight;
    }

    public function setTierTwoKillWeight(int $tierTwoKillWeight): self
    {
        $this->tierTwoKillWeight = $tierTwoKillWeight;

        return $this;
    }

    public function getTierThreeKillWeight(): int
    {
        return $this->tierThreeKillWeight;
    }

    public function setTierThreeKillWeight(int $tierThreeKillWeight): self
    {
        $this->tierThreeKillWeight = $tierThreeKillWeight;

        return $this;
    }

    public function getTierFourKillWeight(): int
    {
        return $this->tierFourKillWeight;
    }

    public function setTierFourKillWeight(int $tierFourKillWeight): self
    {
        $this->tierFourKillWeight = $tierFourKillWeight;

        return $this;
    }

    public function getTierFiveKillWeight(): int
    {
        return $this->tierFiveKillWeight;
    }

    public function setTierFiveKillWeight(int $tierFiveKillWeight): self
    {
        $this->tierFiveKillWeight = $tierFiveKillWeight;

        return $this;
    }

    public function getDeathWeight(): int
    {
        return $this->deathWeight;
    }

    public function setDeathWeight(int $deathWeight): self
    {
        $this->deathWeight = $deathWeight;

        return $this;
    }

    public function getRssWeight(): float|int
    {
        return $this->rssWeight;
    }

    public function setRssWeight(float|int $rssWeight): self
    {
        $this->rssWeight = $rssWeight;

        return $this;
    }
}
