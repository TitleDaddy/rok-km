<?php

namespace App\Common\Serializer;

interface ItemSerializerInterface
{
    public function serialize(mixed $item, SerializerInterface $serializer): array;

    /**
     * Check if a serializer supports this item
     * @param mixed $item
     * @return bool
     */
    public function supports(mixed $item): bool;
}
