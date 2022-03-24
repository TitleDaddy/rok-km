<?php

namespace App\Domain\News\Serializer;

use App\Common\Serializer\ItemSerializerInterface;
use App\Common\Serializer\SerializerInterface;
use App\Entity\News\NewsPost;

class NewsPostSerializer implements ItemSerializerInterface
{
    /**
     * @param NewsPost $item
     * @param SerializerInterface $serializer
     * @return array
     */
    public function serialize(mixed $item, SerializerInterface $serializer): array
    {
        return [
            'id' => $item->getId(),
            'created_at' => $item->getCreatedAt()->getTimestamp(),
            'updated_at' => $item->getUpdatedAt()->getTimestamp(),
            'author' => $item->getAuthor()->getEmail(),
            'body' => $item->getBody(),
            'title' => $item->getTitle(),
        ];
    }

    public function supports(mixed $item): bool
    {
        return $item instanceof NewsPost;
    }
}
