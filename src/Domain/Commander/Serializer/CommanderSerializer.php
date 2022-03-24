<?php

namespace App\Domain\Commander\Serializer;

use App\Common\Serializer\ItemSerializerInterface;
use App\Common\Serializer\SerializerInterface;
use App\Entity\Commander\Commander;

class CommanderSerializer implements ItemSerializerInterface
{
    /**
     * @param Commander $item
     * @param SerializerInterface $serializer
     * @return array
     */
    public function serialize(mixed $item, SerializerInterface $serializer): array
    {
        return [
            'name' => $item->getName(),
            'features' => $item->getFeatures(),
            'rarity' => $item->getRarity(),
            'obtained_from' => $item->getObtainableFrom(),
            'kingdom_age' => $item->getKingdomAge(),
            'skills' => $serializer->serialize($item->getSkills()),
            'xp_needed' => $item->getRarity()->xpUpgradeCost(),
            'heads_needed' => $item->getRarity()->skillUpgradeCost(),
            'pairings' => array_merge(
                $serializer->serialize($item->getPairingsAsPrimaryCommander()),
                $serializer->serialize($item->getPairingsAsSecondaryCommander())
            ),
            'talent_trees' => $serializer->serialize($item->getTalentTrees()),
        ];
    }

    public function supports(mixed $item): bool
    {
        return $item instanceof Commander;
    }
}
