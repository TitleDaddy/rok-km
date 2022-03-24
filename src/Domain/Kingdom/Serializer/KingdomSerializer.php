<?php

namespace App\Domain\Kingdom\Serializer;

use App\Common\Serializer\ItemSerializerInterface;
use App\Common\Serializer\SerializerInterface;
use App\Entity\Kingdom\Kingdom;

class KingdomSerializer implements ItemSerializerInterface
{
    /**
     * @param Kingdom $item
     * @param SerializerInterface $serializer
     * @return array
     */
    public function serialize(mixed $item, SerializerInterface $serializer): array
    {
        return [
            'id' => $item->getId(),
            'number' => $item->getNumber(),
            'council_driven' => $item->getCouncilDriven(),
            'seed' => $item->getSeed(),
            'migration_status' => $item->getMigrationStatus(),
            'focus' => $item->getFocus(),
            'ownerUserId' => $item->getOwner()->getUser()->getUserIdentifier(),
        ];
    }

    public function supports(mixed $item): bool
    {
        return $item instanceof Kingdom;
    }
}
