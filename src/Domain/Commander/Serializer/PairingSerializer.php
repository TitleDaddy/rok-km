<?php

namespace App\Domain\Commander\Serializer;

use App\Common\Serializer\ItemSerializerInterface;
use App\Common\Serializer\SerializerInterface;
use App\Entity\Commander\Pairing;

class PairingSerializer implements ItemSerializerInterface
{
    /**
     * @param Pairing $item
     * @param SerializerInterface $serializer
     * @return array
     */
    public function serialize(mixed $item, SerializerInterface $serializer): array
    {
        return [
            'primary_commander' => $item->getPrimaryCommander()->getName(),
            'secondary_commander' => $item->getSecondaryCommander()->getName(),
        ];
    }

    public function supports(mixed $item): bool
    {
        return $item instanceof Pairing;
    }
}
