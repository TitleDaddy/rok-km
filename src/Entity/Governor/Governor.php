<?php

namespace App\Entity\Governor;

use App\Domain\Governor\Enum\GovernorType;
use App\Entity\Alliance\Alliance;
use App\Entity\BaseEntity;
use App\Entity\Kingdom\Kingdom;
use App\Entity\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Governor extends BaseEntity
{
    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Kingdom::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $ownedKingdoms;

    #[ORM\OneToOne(mappedBy: 'leader', targetEntity: Alliance::class, cascade: ['persist', 'remove'])]
    private ?Alliance $leadsAlliance;

    #[ORM\ManyToOne(targetEntity: Alliance::class, inversedBy: 'officers')]
    private ?Alliance $officerOfAlliance;

    #[ORM\OneToMany(mappedBy: 'governor', targetEntity: MightiestGovernorRequests::class, orphanRemoval: true)]
    private Collection $mightiestGovernorRequests;

    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: false)]
    private string $gameId;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\ManyToOne(targetEntity: Alliance::class, inversedBy: 'members')]
    private ?Alliance $alliance = null;

    #[ORM\OneToMany(mappedBy: 'governor', targetEntity: GovernorCommander::class, orphanRemoval: true)]
    private Collection $commanders;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $power;

    #[ORM\OneToMany(mappedBy: 'governor', targetEntity: GovernorScan::class, orphanRemoval: true)]
    private Collection $governorScans;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'profiles')]
    private User $user;

    #[ORM\Column(type: 'string', length: 255, nullable: false, enumType: GovernorType::class)]
    private GovernorType $type;

    public function __construct(User $user, string $gameId, string $name, GovernorType $type = GovernorType::MAIN, int $power = 0)
    {
        parent::__construct();
        $this->user = $user;
        $this->gameId = $gameId;
        $this->name = $name;
        $this->power = $power;
        $this->type = $type;
        $this->mightiestGovernorRequests = new ArrayCollection();
        $this->commanders = new ArrayCollection();
        $this->governorScans = new ArrayCollection();
        $this->ownedKingdoms = new ArrayCollection();
    }

    public function leadsAlliance(): ?Alliance
    {
        return $this->leadsAlliance;
    }

    public function setLeaderOfAlliance(Alliance $alliance): self
    {
        // set the owning side of the relation if necessary
        if ($alliance->getLeader() !== $this) {
            $alliance->setLeader($this);
        }

        $this->leadsAlliance = $alliance;

        return $this;
    }

    public function officerOfAlliance(): ?Alliance
    {
        return $this->officerOfAlliance;
    }

    public function setOfficerOf(?Alliance $alliance): self
    {
        $this->officerOfAlliance = $alliance;

        return $this;
    }

    /**
     * @return Collection<int, MightiestGovernorRequests>
     */
    public function getMightiestGovernorRequests(): Collection
    {
        return $this->mightiestGovernorRequests;
    }

    public function addMightiestGovernorRequest(MightiestGovernorRequests $mightiestGovernorRequest): self
    {
        if (! $this->mightiestGovernorRequests->contains($mightiestGovernorRequest)) {
            $this->mightiestGovernorRequests[] = $mightiestGovernorRequest;
            $mightiestGovernorRequest->setGovernor($this);
        }

        return $this;
    }

    public function removeMightiestGovernorRequest(MightiestGovernorRequests $mightiestGovernorRequest): self
    {
        if ($this->mightiestGovernorRequests->removeElement($mightiestGovernorRequest)) {
            // set the owning side to null (unless already changed)
            if ($mightiestGovernorRequest->getGovernor() === $this) {
                $mightiestGovernorRequest->setGovernor(null);
            }
        }

        return $this;
    }

    public function getGameId(): ?string
    {
        return $this->gameId;
    }

    public function setGameId(string $gameId): self
    {
        $this->gameId = $gameId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAlliance(): ?Alliance
    {
        return $this->alliance;
    }

    public function setAlliance(?Alliance $alliance): self
    {
        $this->alliance = $alliance;

        return $this;
    }

    /**
     * @return Collection<int, GovernorCommander>
     */
    public function getCommanders(): Collection
    {
        return $this->commanders;
    }

    public function addCommander(GovernorCommander $commander): self
    {
        if (! $this->commanders->contains($commander)) {
            $this->commanders[] = $commander;
            $commander->setGovernor($this);
        }

        return $this;
    }

    public function removeCommander(GovernorCommander $commander): self
    {
        if ($this->commanders->removeElement($commander)) {
            // set the owning side to null (unless already changed)
            if ($commander->getGovernor() === $this) {
                $commander->setGovernor(null);
            }
        }

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(?int $power): self
    {
        $this->power = $power;

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
            $governorScan->setGovernor($this);
        }

        return $this;
    }

    public function removeGovernorScan(GovernorScan $governorScan): self
    {
        if ($this->governorScans->removeElement($governorScan)) {
            // set the owning side to null (unless already changed)
            if ($governorScan->getGovernor() === $this) {
                $governorScan->setGovernor(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getOwnedKingdoms(): array
    {
        return $this->ownedKingdoms->toArray();
    }

    public function addOwnedKingdom(Kingdom $ownedKingdom): self
    {
        if (! $this->ownedKingdoms->contains($ownedKingdom)) {
            $this->ownedKingdoms[] = $ownedKingdom;
        }

        return $this;
    }

    public function removeOwnedKingdom(Kingdom $ownedKingdom): self
    {
        $this->ownedKingdoms->removeElement($ownedKingdom);

        return $this;
    }


    public function __toString(): string
    {
        return $this->name;
    }

    public function getType(): GovernorType
    {
        return $this->type;
    }

    public function setType(GovernorType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
