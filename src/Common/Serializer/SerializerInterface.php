<?php

namespace App\Common\Serializer;

interface SerializerInterface
{
    /**
     * Constructor to make ```new static()``` safe
     */
    public function __construct(array $serializer = []);

    /**
     * Create a serializer with minimal functionality
     * @return static
     */
    public static function minimal(): self;

    /**
     * @param ItemSerializerInterface $serializer
     * @return $this
     */
    public function addSerializer(ItemSerializerInterface $serializer): self;

    /**
     * @param mixed $data e.g. ['events' => $events]
     * @return array
     */
    public function serialize(mixed $data): mixed;

    /**
     * Serialize an individual item
     * @param mixed $item
     * @return mixed the serialized item or the original item
     */
    public function serializeItem(mixed $item): mixed;
}
