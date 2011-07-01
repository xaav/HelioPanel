<?php

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Symfony\Component\HttpKernel\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Sets the classes to compile in the cache for the container.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class AddClassesToCachePass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $classes = array();
        foreach ($container->getExtensions() as $extension) {
            if ($extension instanceof Extension) {
                $classes = array_merge($classes, $extension->getClassesToCompile());
            }
        }

        $container->setParameter('kernel.compiled_classes', array_unique($classes));
    }
}
