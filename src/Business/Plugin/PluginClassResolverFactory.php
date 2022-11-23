<?php

namespace Micro\Plugin\Configuration\Helper\Business\Plugin;

use Micro\Framework\Kernel\KernelInterface;

class PluginClassResolverFactory implements PluginClassResolverFactoryInterface
{
    /**
     * @param KernelInterface $kernel
     */
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