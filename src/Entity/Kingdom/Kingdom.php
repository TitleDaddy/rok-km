<?php

namespace App\Entity\Kingdom;

use App\Domain\Kingdom\Enum\KingdomFocus;
use App\Domain\Kingdom\Enum\KingdomMigrationStatus;
use App\Domain\Kingdom\Enum\KingdomSeed;
use App\Entity\Alliance\Alliance;
use App\Entity\BaseEntity;
use App\Entity\Governor\Governor;
use App\Entity\Governor\MightiestGovernorRequests;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Kingdom extends BaseEntity
{
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $number;

    #[ORM\Column(type: 'string', length: 1, enumType: KingdomSeed::class)]
    private KingdomSeed $seed;

    #[ORM\Column(type: 'boolean')]
    private ?bool $councilDriven;

    #[ORM\Column(type: 'string', length: 255, enumType: KingdomFocus::class)]
    private KingdomFocus $focus;

    #[ORM\Column(type: 'string', length: 255, enumType: KingdomMigrationStatus::class)]
    private KingdomMigrationStatus $migrationStatus;

    #[ORM\ManyToOne(targetEntity: Governor::class, inversedBy: 'ownedKingdoms')]
    #[ORM\JoinColumn(nullable: false)]
    private Governor $owner;

    #[ORM\OneToMany(mappedBy: 'kingdom', targetEntity: Alliance::class, orphanRemoval: true)]
    private Collection $alliances;

    #[ORM\OneToMany(mappedBy: 'kingdom', targetEntity: KingdomEvent::class, orphanRemoval: true)]
    private Collection $kingdomEvents;

    #[ORM\OneToMany(mappedBy: 'kingdom', targetEntity: MightiestGovernorRequests::class, orphanRemoval: true)]
    private Collection $mightiestGovernorRequests;

    public function __construct(
        int $number,
        KingdomSeed $seed,
        ?bool $councilDriven,
        KingdomFocus $focus,
        KingdomMigrationStatus $migrationStatus,
        Governor $owner
    ) {
        parent::__construct();
        $this->number = $number;
        $this->seed = $seed;
        $this->councilDriven = $councilDriven;
        $this->focus = $focus;
        $this->migrationStatus = $migrationStatus;
        $this->owner = $owner;
        $this->alliances = new ArrayCollection();
        $this->kingdomEvents = new ArrayCollection();
        $this->mightiestGovernorRequests = new ArrayCollection();
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function setOwner(Governor $governor): self
    {
        $this->owner = $governor;

        return $this;
    }

    public function getOwner(): Governor
    {
        return $this->owner;
    }

    public function getAlliances(): array
    {
        return $this->alliances->toArray();
    }

    public function getKingdomEvents(): array
    {
        return $this->kingdomEvents->toArray();
    }

    public function getMightiestGovernorRequests(): array
    {
        return $this->mightiestGovernorRequests->toArray();
    }

    public function getSeed(): KingdomSeed
    {
        return $this->seed;
    }

    public function setSeed(KingdomSeed $seed): self
    {
        $this->seed = $seed;

        return $this;
    }

    public function getCouncilDriven(): ?bool
    {
        return $this->councilDriven;
    }

    public function setCouncilDriven(?bool $councilDriven): self
    {
        $this->councilDriven = $councilDriven;

        return $this;
    }

    public function getFocus(): KingdomFocus
    {
        return $this->focus;
    }

    public function setFocus(KingdomFocus $focus): self
    {
        $this->focus = $focus;

        return $this;
    }

    public function getMigrationStatus(): KingdomMigrationStatus
    {
        return $this->migrationStatus;
    }

    public function setMigrationStatus(KingdomMigrationStatus $migrationStatus): self
    {
        $this->migrationStatus = $migrationStatus;

        return $this;
    }

    public function __toString(): string
    {
        return $this->number;
    }
}
