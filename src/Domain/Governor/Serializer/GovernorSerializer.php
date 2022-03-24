<?php

namespace App\Domain\Governor\Serializer;

use App\Common\Serializer\ItemSerializerInterface;
use App\Common\Serializer\SerializerInterface;
use App\Entity\Governor\Governor;

class GovernorSerializer implements ItemSerializerInterface
{
    /**
     * @param Governor $item
     * @param SerializerInterface $serializer
     * @return array
     */
    public function serialize(mixed $item, SerializerInterface $serializer): array
    {
        return [
            'id' => $item->getId(),
            'game_id' => $item->getGameId(),
            'name' => $item->getName(),
            'power' => $item->getPower(),
            'type' => $item->getType(),
            'owner_of_kingdoms' => $item->getOwnedKingdoms() ? $serializer->serialize($item->getOwnedKingdoms()) : null,
            'alliance' => $item->getAlliance(),
        ];
    }

    public function supports(mixed $item): bool
    {
        return $item instanceof Governor;
    }
}
