<?php

namespace App\Entity\User;

use App\Domain\User\UserRoles;
use App\Entity\BaseEntity;
use App\Entity\Governor\Governor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class User extends BaseEntity implements UserInterface, PasswordAuthenticatedUserInterface, EquatableInterface
{
    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: false)]
    private string $email;

    #[ORM\Column(name: 'password', type: 'string', nullable: true)]
    private ?string $passwordHash;

    #[ORM\Column(name: 'roles', type: 'json')]
    private array $roles = [];

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserConnection::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $connections;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Governor::class)]
    private Collection $profiles;

    public function __construct(string $email)
    {
        parent::__construct();
        $this->email = $email;
        $this->connections = new ArrayCollection();
        $this->profiles = new ArrayCollection();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return $this->email;
    }

    public function getUserIdentifier(): string
    {
        return $this->id;
    }

    /**
     * @see UserInterface
     * @return string[]
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = UserRoles::ROLE_USER->value;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function hasRole(string $role): bool
    {
        return in_array($role, $this->getRoles(), true);
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return (string) $this->passwordHash;
    }

    public function setPassword(?string $password): self
    {
        $this->passwordHash = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): self
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
        return $this;
    }

    public function __toString(): string
    {
        return $this->email;
    }

    public function isEqualTo(UserInterface $user): bool
    {
        return $this->getUserIdentifier() === $user->getUserIdentifier();
    }

    /**
     * @return Collection<UserConnection>
     */
    public function getConnections(): Collection
    {
        return $this->connections;
    }

    public function addConnection(UserConnection $connection): self
    {
        if (! $this->connections->contains($connection)) {
            $this->connections[] = $connection;
        }

        return $this;
    }

    public function hasConnectionTo(string $type): Collection
    {
        return $this->connections->filter(function (UserConnection $connection) use ($type) {
            return $connection::class === $type;
        });
    }

    /**
     * @return Collection<int, Governor>
     */
    public function getProfiles(): Collection
    {
        return $this->profiles;
    }

    public function addProfile(Governor $profile): self
    {
        if (! $this->profiles->contains($profile)) {
            $this->profiles[] = $profile;
            $profile->setUser($this);
        }

        return $this;
    }

    public function removeProfile(Governor $profile): self
    {
        if ($this->profiles->removeElement($profile)) {
            // set the owning side to null (unless already changed)
            if ($profile->getUser() === $this) {
                $profile->setUser(null);
            }
        }

        return $this;
    }
}
