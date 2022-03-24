<?php

declare(strict_types=1);

namespace App\DependencyInjection\Compiler;

use App\Common\Serializer\Serializer;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class ItemSerializerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container): void
    {
        $definition = $container->findDefinition(Serializer::class);

        // find all service IDs with the serializer.itemSerializer tag
        $taggedServices = $container->findTaggedServiceIds('serializer.itemSerializer');
        $hooks = array_map(fn (string $id) => new Reference($id), array_keys($taggedServices));
        $definition->setArguments([$hooks]);
    }
}
