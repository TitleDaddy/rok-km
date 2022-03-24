<?php

namespace App\Entity\Alliance;

use App\Entity\BaseEntity;
use App\Entity\Governor\Governor;
use App\Entity\Kingdom\Kingdom;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Alliance extends BaseEntity
{
    #[ORM\ManyToOne(targetEntity: Kingdom::class, inversedBy: 'alliances')]
    #[ORM\JoinColumn(nullable: false)]
    private Kingdom $kingdom;

    #[ORM\OneToOne(inversedBy: 'leadsAlliance', targetEntity: Governor::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private Governor $leader;

    #[ORM\Column(type: 'string', length: 255)]
    private string $type;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $tag;

    #[ORM\OneToMany(mappedBy: 'officerOf', targetEntity: Governor::class)]
    private Collection $officers;

    #[ORM\OneToMany(mappedBy: 'alliance', targetEntity: AllianceEvent::class, orphanRemoval: true)]
    private Collection $allianceEvents;

    #[ORM\OneToMany(mappedBy: 'alliance', targetEntity: Governor::class)]
    private Collection $members;

    public function __construct()
    {
        parent::__construct();
        $this->officers = new ArrayCollection();
        $this->allianceEvents = new ArrayCollection();
        $this->members = new ArrayCollection();
    }

    public function getKingdom(): ?Kingdom
    {
        return $this->kingdom;
    }

    public function setKingdom(?Kingdom $kingdom): self
    {
        $this->kingdom = $kingdom;

        return $this;
    }

    public function getLeader(): ?Governor
    {
        return $this->leader;
    }

    public function setLeader(Governor $leader): self
    {
        $this->leader = $leader;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return Collection<int, Governor>
     */
    public function getOfficers(): Collection
    {
        return $this->officers;
    }

    public function addOfficer(Governor $officer): self
    {
        if (! $this->officers->contains($officer)) {
            $this->officers[] = $officer;
            $officer->setOfficerOf($this);
        }

        return $this;
    }

    public function removeOfficer(Governor $officer): self
    {
        if ($this->officers->removeElement($officer)) {
            // set the owning side to null (unless already changed)
            if ($officer->officerOfAlliance() === $this) {
                $officer->setOfficerOf(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AllianceEvent>
     */
    public function getAllianceEvents(): Collection
    {
        return $this->allianceEvents;
    }

    public function addAllianceEvent(AllianceEvent $allianceEvent): self
    {
        if (! $this->allianceEvents->contains($allianceEvent)) {
            $this->allianceEvents[] = $allianceEvent;
            $allianceEvent->setAlliance($this);
        }

        return $this;
    }

    public function removeAllianceEvent(AllianceEvent $allianceEvent): self
    {
        if ($this->allianceEvents->removeElement($allianceEvent)) {
            // set the owning side to null (unless already changed)
            if ($allianceEvent->getAlliance() === $this) {
                $allianceEvent->setAlliance(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Governor>
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Governor $member): self
    {
        if (! $this->members->contains($member)) {
            $this->members[] = $member;
            $member->setAlliance($this);
        }

        return $this;
    }

    public function removeMember(Governor $member): self
    {
        if ($this->members->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getAlliance() === $this) {
                $member->setAlliance(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return "[{$this->tag}] {$this->name}";
    }
}
