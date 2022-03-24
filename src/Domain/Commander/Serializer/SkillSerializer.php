<?php

namespace App\Domain\Commander\Serializer;

use App\Common\Serializer\ItemSerializerInterface;
use App\Common\Serializer\SerializerInterface;
use App\Entity\Commander\Skill;

class SkillSerializer implements ItemSerializerInterface
{
    /**
     * @param Skill $item
     * @param SerializerInterface $serializer
     * @return array
     */
    public function serialize(mixed $item, SerializerInterface $serializer): array
    {
        return [
            'index' => $item->getIndex(),
            'name' => $item->getName(),
            'type' => $item->getType(),
            'description' => $item->getDescription(),
            'upgrades' => $item->getUpgrades(),
        ];
    }

    public function supports(mixed $item): bool
    {
        return $item instanceof Skill;
    }
}
