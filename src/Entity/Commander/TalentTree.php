<?php

namespace App\Entity\Commander;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class TalentTree extends BaseEntity
{
    #[ORM\ManyToOne(targetEntity: Commander::class, inversedBy: 'talentTrees')]
    #[ORM\JoinColumn(nullable: false)]
    private Commander $commander;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'text')]
    private string $filename;

    public function __construct(Commander $commander, string $name, string $extension)
    {
        parent::__construct();
        $this->commander = $commander;
        $this->name = $name;
        $this->filename = sprintf(
            '%s_talent_tree_%s_%s.%s',
            str_replace(' ', '_', $commander->getName()),
            Uuid::v4(),
            str_replace(' ', '_', $name),
            $extension
        );
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }
}
