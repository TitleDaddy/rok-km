<?php

namespace App\Entity\ROK;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Equipment extends BaseEntity
{
    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $type;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $infantryAttack = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $infantryDefense = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $infantryHealth = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $archerAttack = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $archerDefense = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $archerHealth = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $cavalryAttack = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $cavalryDefense = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $cavalryHealth = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $siegeAttack = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $siegeDefense = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $siegeHealth = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $marchSpeed = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 5)]
    private float $counterAttackDamage = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 5)]
    private float $incomingCounterAttackDamage = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 5)]
    private float $skillDamage = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 5)]
    private float $attackDamage = 0;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getInfantryAttack(): ?string
    {
        return $this->infantryAttack;
    }

    public function setInfantryAttack(string $infantryAttack): self
    {
        $this->infantryAttack = $infantryAttack;

        return $this;
    }

    public function getInfantryDefense(): ?string
    {
        return $this->infantryDefense;
    }

    public function setInfantryDefense(string $infantryDefense): self
    {
        $this->infantryDefense = $infantryDefense;

        return $this;
    }

    public function getInfantryHealth(): ?string
    {
        return $this->infantryHealth;
    }

    public function setInfantryHealth(string $infantryHealth): self
    {
        $this->infantryHealth = $infantryHealth;

        return $this;
    }

    public function getArcherAttack(): ?string
    {
        return $this->archerAttack;
    }

    public function setArcherAttack(string $archerAttack): self
    {
        $this->archerAttack = $archerAttack;

        return $this;
    }

    public function getArcherDefense(): ?string
    {
        return $this->archerDefense;
    }

    public function setArcherDefense(string $archerDefense): self
    {
        $this->archerDefense = $archerDefense;

        return $this;
    }

    public function getArcherHealth(): ?string
    {
        return $this->archerHealth;
    }

    public function setArcherHealth(string $archerHealth): self
    {
        $this->archerHealth = $archerHealth;

        return $this;
    }

    public function getCavalryAttack(): ?string
    {
        return $this->cavalryAttack;
    }

    public function setCavalryAttack(string $cavalryAttack): self
    {
        $this->cavalryAttack = $cavalryAttack;

        return $this;
    }

    public function getCavalryDefense(): ?string
    {
        return $this->cavalryDefense;
    }

    public function setCavalryDefense(string $cavalryDefense): self
    {
        $this->cavalryDefense = $cavalryDefense;

        return $this;
    }

    public function getCavalryHealth(): ?string
    {
        return $this->cavalryHealth;
    }

    public function setCavalryHealth(string $cavalryHealth): self
    {
        $this->cavalryHealth = $cavalryHealth;

        return $this;
    }

    public function getSiegeAttack(): ?string
    {
        return $this->siegeAttack;
    }

    public function setSiegeAttack(string $siegeAttack): self
    {
        $this->siegeAttack = $siegeAttack;

        return $this;
    }

    public function getSiegeDefense(): ?string
    {
        return $this->siegeDefense;
    }

    public function setSiegeDefense(string $siegeDefense): self
    {
        $this->siegeDefense = $siegeDefense;

        return $this;
    }

    public function getSiegeHealth(): ?string
    {
        return $this->siegeHealth;
    }

    public function setSiegeHealth(string $siegeHealth): self
    {
        $this->siegeHealth = $siegeHealth;

        return $this;
    }

    public function getMarchSpeed(): ?string
    {
        return $this->marchSpeed;
    }

    public function setMarchSpeed(string $marchSpeed): self
    {
        $this->marchSpeed = $marchSpeed;

        return $this;
    }

    public function getCounterAttackDamage(): ?string
    {
        return $this->counterAttackDamage;
    }

    public function setCounterAttackDamage(string $counterAttackDamage): self
    {
        $this->counterAttackDamage = $counterAttackDamage;

        return $this;
    }

    public function getIncomingCounterAttackDamage(): ?string
    {
        return $this->incomingCounterAttackDamage;
    }

    public function setIncomingCounterAttackDamage(string $incomingCounterAttackDamage): self
    {
        $this->incomingCounterAttackDamage = $incomingCounterAttackDamage;

        return $this;
    }

    public function getSkillDamage(): ?string
    {
        return $this->skillDamage;
    }

    public function setSkillDamage(string $skillDamage): self
    {
        $this->skillDamage = $skillDamage;

        return $this;
    }

    public function getAttackDamage(): ?string
    {
        return $this->attackDamage;
    }

    public function setAttackDamage(string $attackDamage): self
    {
        $this->attackDamage = $attackDamage;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
