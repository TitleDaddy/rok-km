<?php

namespace App\Entity\Governor;

use App\Entity\BaseEntity;
use App\Entity\Commander\Commander;
use App\Entity\ROK\Equipment;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class GovernorCommander extends BaseEntity
{
    #[ORM\ManyToOne(targetEntity: Governor::class, inversedBy: 'commanders')]
    #[ORM\JoinColumn(nullable: false)]
    private Governor $governor;

    #[ORM\ManyToOne(targetEntity: Commander::class, inversedBy: 'governorCommanders')]
    #[ORM\JoinColumn(nullable: false)]
    private Commander $commander;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $firstSkill = 1;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $secondSkill = 1;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $thirdSkill = 1;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $fourthSkill = 1;

    #[ORM\ManyToOne(targetEntity: Equipment::class)]
    private ?Equipment $helm = null;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $helmIsSpecialised = false;

    #[ORM\ManyToOne(targetEntity: Equipment::class)]
    private ?Equipment $weapon = null;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $weaponIsSpecialised = false;

    #[ORM\ManyToOne(targetEntity: Equipment::class)]
    private ?Equipment $chest = null;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $chestIsSpecialised = false;

    #[ORM\ManyToOne(targetEntity: Equipment::class)]
    private ?Equipment $gloves = null;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $glovesIsSpecialised = false;

    #[ORM\ManyToOne(targetEntity: Equipment::class)]
    private ?Equipment $legs = null;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $legsIsSpecialised = false;

    #[ORM\ManyToOne(targetEntity: Equipment::class)]
    private ?Equipment $boots = null;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $bootsIsSpecialised = false;

    #[ORM\ManyToOne(targetEntity: Equipment::class)]
    private ?Equipment $firstAccessory = null;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $firstAccessoryIsSpecialised = false;

    #[ORM\ManyToOne(targetEntity: Equipment::class)]
    private ?Equipment $secondAccessory = null;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $secondAccessoryIsSpecialised = false;

    public function getGovernor(): Governor
    {
        return $this->governor;
    }

    public function setGovernor(Governor $governor): self
    {
        $this->governor = $governor;

        return $this;
    }

    public function getCommander(): Commander
    {
        return $this->commander;
    }

    public function setCommander(Commander $commander): self
    {
        $this->commander = $commander;

        return $this;
    }

    public function getFirstSkill(): int
    {
        return $this->firstSkill;
    }

    public function setFirstSkill(int $firstSkill): self
    {
        $this->firstSkill = $firstSkill;

        return $this;
    }

    public function getSecondSkill(): int
    {
        return $this->secondSkill;
    }

    public function setSecondSkill(int $secondSkill): self
    {
        $this->secondSkill = $secondSkill;

        return $this;
    }

    public function getThirdSkill(): int
    {
        return $this->thirdSkill;
    }

    public function setThirdSkill(int $thirdSkill): self
    {
        $this->thirdSkill = $thirdSkill;

        return $this;
    }

    public function getFourthSkill(): int
    {
        return $this->fourthSkill;
    }

    public function setFourthSkill(int $fourthSkill): self
    {
        $this->fourthSkill = $fourthSkill;

        return $this;
    }

    public function getHelm(): ?Equipment
    {
        return $this->helm;
    }

    public function setHelm(?Equipment $helm): self
    {
        $this->helm = $helm;

        return $this;
    }

    public function isHelmSpecialised(): bool
    {
        return $this->helmIsSpecialised;
    }

    public function setHelmIsSpecialised(bool $helmIsSpecialised): self
    {
        $this->helmIsSpecialised = $helmIsSpecialised;

        return $this;
    }

    public function getWeapon(): ?Equipment
    {
        return $this->weapon;
    }

    public function setWeapon(?Equipment $weapon): self
    {
        $this->weapon = $weapon;

        return $this;
    }

    public function isWeaponSpecialised(): bool
    {
        return $this->weaponIsSpecialised;
    }

    public function setWeaponIsSpecialised(bool $weaponIsSpecialised): self
    {
        $this->weaponIsSpecialised = $weaponIsSpecialised;

        return $this;
    }

    public function getChest(): ?Equipment
    {
        return $this->chest;
    }

    public function setChest(?Equipment $chest): self
    {
        $this->chest = $chest;

        return $this;
    }

    public function isChestIsSpecialised(): bool
    {
        return $this->chestIsSpecialised;
    }

    public function setChestIsSpecialised(bool $chestIsSpecialised): self
    {
        $this->chestIsSpecialised = $chestIsSpecialised;

        return $this;
    }

    public function getGloves(): ?Equipment
    {
        return $this->gloves;
    }

    public function setGloves(?Equipment $gloves): self
    {
        $this->gloves = $gloves;

        return $this;
    }

    public function isGlovesSpecialised(): bool
    {
        return $this->glovesIsSpecialised;
    }

    public function setGlovesIsSpecialised(bool $glovesIsSpecialised): self
    {
        $this->glovesIsSpecialised = $glovesIsSpecialised;

        return $this;
    }

    public function getLegs(): ?Equipment
    {
        return $this->legs;
    }

    public function setLegs(?Equipment $legs): self
    {
        $this->legs = $legs;

        return $this;
    }

    public function isLegsSpecialised(): bool
    {
        return $this->legsIsSpecialised;
    }

    public function setLegsIsSpecialised(bool $legsIsSpecialised): self
    {
        $this->legsIsSpecialised = $legsIsSpecialised;

        return $this;
    }

    public function getBoots(): ?Equipment
    {
        return $this->boots;
    }

    public function setBoots(?Equipment $boots): self
    {
        $this->boots = $boots;

        return $this;
    }

    public function isBootsSpecialised(): bool
    {
        return $this->bootsIsSpecialised;
    }

    public function setBootsIsSpecialised(bool $bootsIsSpecialised): self
    {
        $this->bootsIsSpecialised = $bootsIsSpecialised;

        return $this;
    }

    public function getFirstAccessory(): ?Equipment
    {
        return $this->firstAccessory;
    }

    public function setFirstAccessory(?Equipment $firstAccessory): self
    {
        $this->firstAccessory = $firstAccessory;

        return $this;
    }

    public function isFirstAccessorySpecialised(): bool
    {
        return $this->firstAccessoryIsSpecialised;
    }

    public function setFirstAccessoryIsSpecialised(bool $firstAccessoryIsSpecialised): self
    {
        $this->firstAccessoryIsSpecialised = $firstAccessoryIsSpecialised;

        return $this;
    }

    public function getSecondAccessory(): ?Equipment
    {
        return $this->secondAccessory;
    }

    public function setSecondAccessory(?Equipment $secondAccessory): self
    {
        $this->secondAccessory = $secondAccessory;

        return $this;
    }

    public function isSecondAccessorySpecialised(): bool
    {
        return $this->secondAccessoryIsSpecialised;
    }

    public function setSecondAccessoryIsSpecialised(bool $secondAccessoryIsSpecialised): self
    {
        $this->secondAccessoryIsSpecialised = $secondAccessoryIsSpecialised;

        return $this;
    }
}
