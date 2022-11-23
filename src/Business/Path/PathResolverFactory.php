<?php

namespace Micro\Plugin\Configuration\Helper\Business\Path;

use Micro\Plugin\Configuration\Helper\Business\Plugin\PluginClassResolverInterface;

class PathResolverFactory implements PathResolverFactoryInterface
{
    /**
     * @param PluginClassResolverInterface $pluginClassResolver
     */
    public function __construct(private readonly PluginClassResolverInterface $pluginClassResolver)
    {
    }

    public function create(): PathResolverInterface
    {
        return new PathResolverCacheDecorator(
            new PathResolver($this->pluginClassResolver)
        );
    }
}