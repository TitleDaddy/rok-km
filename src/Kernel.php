<?php

namespace App;

use App\DependencyInjection\Compiler\ItemSerializerPass;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ItemSerializerPass());
    }
}
