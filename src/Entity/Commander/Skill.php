<?php

namespace App\Entity\Commander;

use App\Domain\Commander\Enum\CommanderSkillType;
use App\Domain\Commander\Exception\InvalidSkillIndexException;
use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Skill extends BaseEntity
{
    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'text', nullable: false)]
    private string $description;

    #[ORM\Column(type: 'json')]
    private array $upgrades = [];

    #[ORM\Column(type: 'string', length: 255, enumType: CommanderSkillType::class)]
    private CommanderSkillType $type;

    #[ORM\ManyToOne(targetEntity: Commander::class, inversedBy: 'skills')]
    #[ORM\JoinColumn(nullable: false)]
    private Commander $commander;

    #[ORM\Column(type: 'integer')]
    private int $_index;

    public function __construct(
        string $index,
        string $name,
        string $description,
        array $upgrades,
        CommanderSkillType $type,
        Commander $commander
    ) {
        parent::__construct();
        $this->setIndex($index);
        $this->name = $name;
        $this->description = $description;
        $this->upgrades = $upgrades;
        $this->type = $type;
        $this->commander = $commander;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUpgrades(): array
    {
        return $this->upgrades;
    }

    public function setUpgrades(array $upgrades): self
    {
        $this->upgrades = $upgrades;

        return $this;
    }

    public function getType(): CommanderSkillType
    {
        return $this->type;
    }

    public function setType(CommanderSkillType $type): self
    {
        $this->type = $type;

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

    public function getIndex(): ?int
    {
        return $this->_index;
    }

    public function setIndex(int $index): self
    {
        if ($index < 1 || $index > 5) {
            throw new InvalidSkillIndexException($index);
        }
        $this->_index = $index;

        return $this;
    }
}
