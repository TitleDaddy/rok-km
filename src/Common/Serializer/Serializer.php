<?php

namespace App\Common\Serializer;

class Serializer implements SerializerInterface
{
    /**
     * @var ItemSerializerInterface[]
     */
    protected array $serializers = [];

    /**
     * @param ItemSerializerInterface[] $serializers
     */
    public function __construct(array $serializers = [])
    {
        $this->serializers = $serializers;
    }

    /**
     * Create a serializer with minimal functionality
     */
    public static function minimal(): self
    {
        $serializer = new static();
        $serializer->addSerializer(new CollectionItemSerializer());

        return $serializer;
    }

    /**
     * @param ItemSerializerInterface $serializer
     */
    public function addSerializer(ItemSerializerInterface $serializer): self
    {
        $this->serializers[] = $serializer;

        return $this;
    }

    /**
     * @param mixed $data e.g. ['events' => $events]
     * @return array
     */
    public function serialize(mixed $data): array
    {
        if ($data === null) {
            return [];
        }

        return is_array($data) ? array_map([$this, 'serializeItem'], $data) : $this->serializeItem($data);
    }

    /**
     * Serialize an individual item
     * @param mixed $item
     * @return mixed the serialized item or the original item
     */
    public function serializeItem(mixed $item): mixed
    {
        foreach ($this->serializers as $serializer) {
            if ($serializer->supports($item)) {
                return $serializer->serialize($item, $this);
            }
        }

        return null;
    }
}
