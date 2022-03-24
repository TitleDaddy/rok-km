<?php

namespace App\Domain\Commander\Serializer;

use App\Common\Serializer\ItemSerializerInterface;
use App\Common\Serializer\SerializerInterface;
use App\Entity\Commander\TalentTree;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class TalentTreeSerializer implements ItemSerializerInterface
{
    private UrlGeneratorInterface $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }
    /**
     * @param TalentTree $item
     * @param SerializerInterface $serializer
     * @return array
     */
    public function serialize(mixed $item, SerializerInterface $serializer): array
    {
        return [
            'name' => $item->getName(),
            'url' => $this->router->generate('api_v1_fetch_talent_tree', [
                'filename' => $item->getFilename(),
            ]),
        ];
    }

    public function supports(mixed $item): bool
    {
        return $item instanceof TalentTree;
    }
}
