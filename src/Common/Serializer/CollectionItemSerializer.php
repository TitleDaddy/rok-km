<?php

namespace App\Common\Serializer;

class CollectionItemSerializer implements ItemSerializerInterface
{
    /**
     * @param array $item
     */
    public function serialize(mixed $item, SerializerInterface $serializer): array
    {
        return array_map([$serializer, 'serializeItem'], $item);
    }

    public function supports(mixed $item): bool
    {
        return is_array($item);
    }
}
