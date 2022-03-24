<?php

namespace App\Entity\User;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\InheritanceType(value: 'SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type_discriminator', type: 'string')]
#[ORM\DiscriminatorMap([
    'discord' => DiscordUserConnection::class,
])]
abstract class UserConnection extends BaseEntity
{
    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'connections')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __toString(): string
    {
        return "UserConnection {$this->id}";
    }
}
