<?php

namespace App\Domain\User\Command\Command;

use App\Common\CQRS\CommandInterface;

class CreateDiscordConnectionCommand implements CommandInterface
{
    private string $email;
    private string $username;
    private string $discordId;
    private string $discordDiscriminator;
    private ?string $avatarHash;

    public function __construct(
        string $email,
        string $username,
        string $discordId,
        string $discordDiscriminator,
        ?string $avatarHash
    ) {
        $this->email = $email;
        $this->username = $username;
        $this->discordId = $discordId;
        $this->discordDiscriminator = $discordDiscriminator;
        $this->avatarHash = $avatarHash;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getDiscordId(): string
    {
        return $this->discordId;
    }

    public function getDiscordDiscriminator(): string
    {
        return $this->discordDiscriminator;
    }

    public function getAvatarHash(): ?string
    {
        return $this->avatarHash;
    }
}
