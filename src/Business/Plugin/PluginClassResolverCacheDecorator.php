<?php

namespace Micro\Plugin\Configuration\Helper\Business\Plugin;

class PluginClassResolverCacheDecorator implements PluginClassResolverInterface
{
    private array $cache;
    /**
     * @param PluginClassResolverInterface $pluginClassResolver
     */
    public function __construct(private readonly PluginClassResolverInterface $pluginClassResolver)
    {
        $this->cache = [];
    }

    /**
     * @param string $pluginAlias
     *
     * @return object|null
     */
    public function resolve(string $pluginAlias): object|null
    {
        if(in_array($pluginAlias, $this->cache)) {
            return $this->cache[$pluginAlias];
        }

        $result = $this->pluginClassResolver->resolve($pluginAlias);

        $this->cache[$pluginAlias] = $result;

        return $result;
    }
}