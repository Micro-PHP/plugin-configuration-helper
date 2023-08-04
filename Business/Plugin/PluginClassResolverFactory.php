<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\ConfigurationHelper\Business\Plugin;

use Micro\Framework\Kernel\KernelInterface;

class PluginClassResolverFactory implements PluginClassResolverFactoryInterface
{
    public function __construct(private readonly KernelInterface $kernel)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): PluginClassResolverInterface
    {
        return new PluginClassResolverCacheDecorator(
            new PluginClassResolver($this->kernel)
        );
    }
}
