<?php

namespace App\Entity\Governor;

use App\Entity\BaseEntity;
use App\Entity\Kingdom\KvKSeasonTarget;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class GovernorScan extends BaseEntity
{
    #[ORM\ManyToOne(targetEntity: Governor::class, inversedBy: 'governorScans')]
    #[ORM\JoinColumn(nullable: false)]
    private Governor $governor;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $power = 0;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $tierOneKills = 0;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $tierTwoKills = 0;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $tierThreeKills = 0;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $tierFourKills = 0;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $tierFiveKills = 0;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $deaths = 0;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $rssAssistance = 0;

    #[ORM\Column(type: 'date')]
    private DateTimeInterface $date;

    #[ORM\ManyToOne(targetEntity: KvKSeasonTarget::class, inversedBy: 'governorScans')]
    #[ORM\JoinColumn(nullable: false)]
    private KvKSeasonTarget $season;

    public function getGovernor(): ?Governor
    {
        return $this->governor;
    }

    public function setGovernor(?Governor $governor): self
    {
        $this->governor = $governor;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getTierOneKills(): ?int
    {
        return $this->tierOneKills;
    }

    public function setTierOneKills(int $tierOneKills): self
    {
        $this->tierOneKills = $tierOneKills;

        return $this;
    }

    public function getTierTwoKills(): ?int
    {
        return $this->tierTwoKills;
    }

    public function setTierTwoKills(int $tierTwoKills): self
    {
        $this->tierTwoKills = $tierTwoKills;

        return $this;
    }

    public function getTierThreeKills(): ?int
    {
        return $this->tierThreeKills;
    }

    public function setTierThreeKills(int $tierThreeKills): self
    {
        $this->tierThreeKills = $tierThreeKills;

        return $this;
    }

    public function getTierFourKills(): ?int
    {
        return $this->tierFourKills;
    }

    public function setTierFourKills(int $tierFourKills): self
    {
        $this->tierFourKills = $tierFourKills;

        return $this;
    }

    public function getTierFiveKills(): ?int
    {
        return $this->tierFiveKills;
    }

    public function setTierFiveKills(int $tierFiveKills): self
    {
        $this->tierFiveKills = $tierFiveKills;

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

    public function getRssAssistance(): ?int
    {
        return $this->rssAssistance;
    }

    public function setRssAssistance(int $rssAssistance): self
    {
        $this->rssAssistance = $rssAssistance;

        return $this;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSeason(): ?KvKSeasonTarget
    {
        return $this->season;
    }

    public function setSeason(?KvKSeasonTarget $season): self
    {
        $this->season = $season;

        return $this;
    }
}
