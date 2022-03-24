<?php

namespace App\Entity\User;

use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity]
class DiscordUserConnection extends UserConnection
{
    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $discordEmail;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $discordUsername;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $discordId;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $discordDiscriminator;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $discordAvatarHash;

    public function __construct(
        User $user,
        string $discordEmail,
        string $discordUsername,
        string $discordId,
        string $discordDiscriminator,
        string $discordAvatarHash
    ) {
        parent::__construct($user);
        $this->discordEmail = $discordEmail;
        $this->discordUsername = $discordUsername;
        $this->discordId = $discordId;
        $this->discordDiscriminator = $discordDiscriminator;
        $this->discordAvatarHash = $discordAvatarHash;
    }

    public function getDiscordEmail(): string
    {
        return $this->discordEmail;
    }

    public function setDiscordEmail(string $discordEmail): self
    {
        $this->discordEmail = $discordEmail;

        return $this;
    }

    public function getDiscordUsername(): string
    {
        return $this->discordUsername;
    }

    public function setDiscordUsername(string $discordUsername): self
    {
        $this->discordUsername = $discordUsername;

        return $this;
    }

    public function getDiscordId(): string
    {
        return $this->discordId;
    }

    public function setDiscordId(string $discordId): self
    {
        $this->discordId = $discordId;

        return $this;
    }

    public function getDiscordDiscriminator(): string
    {
        return $this->discordDiscriminator;
    }

    public function setDiscordDiscriminator(string $discordDiscriminator): self
    {
        $this->discordDiscriminator = $discordDiscriminator;

        return $this;
    }

    public function getDiscordAvatarHash(): string
    {
        return $this->discordAvatarHash;
    }

    public function setDiscordAvatarHash(string $discordAvatarHash): self
    {
        $this->discordAvatarHash = $discordAvatarHash;

        return $this;
    }

    public function __toString(): string
    {
        return "Discord {$this->getDiscordUsername()}#{$this->getDiscordDiscriminator()}";
    }
}
