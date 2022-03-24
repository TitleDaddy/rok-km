<?php

namespace App\Entity\Commander;

use App\Domain\Commander\Enum\CommanderObtainableFrom;
use App\Domain\Commander\Enum\CommanderRarity;
use App\Entity\BaseEntity;
use App\Entity\Governor\GovernorCommander;
use App\Entity\Governor\MightiestGovernorRequests;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Commander extends BaseEntity
{
    #[ORM\OneToMany(mappedBy: 'commander', targetEntity: MightiestGovernorRequests::class, orphanRemoval: true)]
    private Collection $mightiestGovernorRequests;

    #[ORM\OneToMany(mappedBy: 'commander', targetEntity: GovernorCommander::class, orphanRemoval: true)]
    private Collection $governorCommanders;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'json')]
    private array $features = [];

    #[ORM\Column(type: 'string', length: 255, enumType: CommanderRarity::class)]
    private CommanderRarity $rarity;

    #[ORM\Column(type: 'string', length: 255, enumType: CommanderObtainableFrom::class)]
    private CommanderObtainableFrom $obtainableFrom;

    #[ORM\Column(type: 'integer')]
    private int $kingdomAge = 1;

    #[ORM\OneToMany(mappedBy: 'primaryCommander', targetEntity: Pairing::class, orphanRemoval: true)]
    private Collection $pairingsAsPrimaryCommander;

    #[ORM\OneToMany(mappedBy: 'secondaryCommander', targetEntity: Pairing::class, orphanRemoval: true)]
    private Collection $pairingsAsSecondaryCommander;

    #[ORM\OneToMany(mappedBy: 'commander', targetEntity: TalentTree::class, orphanRemoval: true)]
    private Collection $talentTrees;

    #[ORM\OneToMany(mappedBy: 'commander', targetEntity: Skill::class, orphanRemoval: true)]
    private Collection $skills;

    public function __construct(
        string $name,
        array $features,
        CommanderRarity $rarity,
        CommanderObtainableFrom $obtainableFrom,
        int $kingdomAge
    ) {
        parent::__construct();
        $this->mightiestGovernorRequests = new ArrayCollection();
        $this->governorCommanders = new ArrayCollection();
        $this->pairingsAsPrimaryCommander = new ArrayCollection();
        $this->pairingsAsSecondaryCommander = new ArrayCollection();
        $this->talentTrees = new ArrayCollection();
        $this->name = $name;
        $this->features = $features;
        $this->rarity = $rarity;
        $this->obtainableFrom = $obtainableFrom;
        $this->kingdomAge = $kingdomAge;
        $this->skills = new ArrayCollection();
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
            $mightiestGovernorRequest->setCommander($this);
        }

        return $this;
    }

    public function removeMightiestGovernorRequest(MightiestGovernorRequests $mightiestGovernorRequest): self
    {
        if ($this->mightiestGovernorRequests->removeElement($mightiestGovernorRequest)) {
            // set the owning side to null (unless already changed)
            if ($mightiestGovernorRequest->getCommander() === $this) {
                $mightiestGovernorRequest->setCommander(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GovernorCommander>
     */
    public function getGovernorCommanders(): Collection
    {
        return $this->governorCommanders;
    }

    public function addGovernorCommander(GovernorCommander $governorCommander): self
    {
        if (! $this->governorCommanders->contains($governorCommander)) {
            $this->governorCommanders[] = $governorCommander;
            $governorCommander->setCommander($this);
        }

        return $this;
    }

    public function removeGovernorCommander(GovernorCommander $governorCommander): self
    {
        if ($this->governorCommanders->removeElement($governorCommander)) {
            // set the owning side to null (unless already changed)
            if ($governorCommander->getCommander() === $this) {
                $governorCommander->setCommander(null);
            }
        }

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

    public function __toString(): string
    {
        return $this->name;
    }

    public function getFeatures(): ?array
    {
        return $this->features;
    }

    public function setFeatures(array $features): self
    {
        $this->features = $features;

        return $this;
    }

    public function getRarity(): CommanderRarity
    {
        return $this->rarity;
    }

    public function setRarity(CommanderRarity $rarity): self
    {
        $this->rarity = $rarity;

        return $this;
    }

    public function getObtainableFrom(): CommanderObtainableFrom
    {
        return $this->obtainableFrom;
    }

    public function setObtainableFrom(CommanderObtainableFrom $obtainableFrom): self
    {
        $this->obtainableFrom = $obtainableFrom;

        return $this;
    }

    public function getKingdomAge(): ?int
    {
        return $this->kingdomAge;
    }

    public function setKingdomAge(int $kingdomAge): self
    {
        $this->kingdomAge = $kingdomAge;

        return $this;
    }

    public function getPairingsAsPrimaryCommander(): array
    {
        return $this->pairingsAsPrimaryCommander->toArray();
    }

    public function addPairingsAsPrimaryCommander(Pairing $pairingsAsPrimaryCommander): self
    {
        if (! $this->pairingsAsPrimaryCommander->contains($pairingsAsPrimaryCommander)) {
            $this->pairingsAsPrimaryCommander[] = $pairingsAsPrimaryCommander;
            $pairingsAsPrimaryCommander->setPrimaryCommander($this);
        }

        return $this;
    }

    public function removePairingsAsPrimaryCommander(Pairing $pairingsAsPrimaryCommander): self
    {
        if ($this->pairingsAsPrimaryCommander->removeElement($pairingsAsPrimaryCommander)) {
            // set the owning side to null (unless already changed)
            if ($pairingsAsPrimaryCommander->getPrimaryCommander() === $this) {
                $pairingsAsPrimaryCommander->setPrimaryCommander(null);
            }
        }

        return $this;
    }

    public function getPairingsAsSecondaryCommander(): array
    {
        return $this->pairingsAsSecondaryCommander->toArray();
    }

    public function addPairingsAsSecondaryCommander(Pairing $pairingsAsSecondaryCommander): self
    {
        if (! $this->pairingsAsSecondaryCommander->contains($pairingsAsSecondaryCommander)) {
            $this->pairingsAsSecondaryCommander[] = $pairingsAsSecondaryCommander;
            $pairingsAsSecondaryCommander->setSecondaryCommander($this);
        }

        return $this;
    }

    public function removePairingsAsSecondaryCommander(Pairing $pairingsAsSecondaryCommander): self
    {
        if ($this->pairingsAsSecondaryCommander->removeElement($pairingsAsSecondaryCommander)) {
            // set the owning side to null (unless already changed)
            if ($pairingsAsSecondaryCommander->getSecondaryCommander() === $this) {
                $pairingsAsSecondaryCommander->setSecondaryCommander(null);
            }
        }

        return $this;
    }

    public function getTalentTrees(): array
    {
        return $this->talentTrees->toArray();
    }

    public function addTalentTree(TalentTree $talentTree): self
    {
        if (! $this->talentTrees->contains($talentTree)) {
            $this->talentTrees[] = $talentTree;
            $talentTree->setCommander($this);
        }

        return $this;
    }

    public function removeTalentTree(TalentTree $talentTree): self
    {
        if ($this->talentTrees->removeElement($talentTree)) {
            // set the owning side to null (unless already changed)
            if ($talentTree->getCommander() === $this) {
                $talentTree->setCommander(null);
            }
        }

        return $this;
    }

    public function getSkills(): array
    {
        return $this->skills->toArray();
    }

    public function addSkill(Skill $skill): self
    {
        if (! $this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->setCommander($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getCommander() === $this) {
                $skill->setCommander(null);
            }
        }

        return $this;
    }
}
