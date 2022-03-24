<?php

namespace App\Domain\User\Serializer;

use App\Common\Serializer\ItemSerializerInterface;
use App\Common\Serializer\SerializerInterface;
use App\Entity\User\User;

class UserSerializer implements ItemSerializerInterface
{
    /**
     * @param User $item
     * @param SerializerInterface $serializer
     * @return array
     */
    public function serialize(mixed $item, SerializerInterface $serializer): array
    {
        return [
            'id' => $item->getUserIdentifier(),
            'email' => $item->getEmail(),
            'roles' => $item->getRoles(),
        ];
    }

    public function supports(mixed $item): bool
    {
        return $item instanceof User;
    }
}
