<?php

namespace Micro\Plugin\Configuration\Helper\Business\Plugin;

use Micro\Framework\Kernel\Plugin\ApplicationPluginInterface;

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
     * @return ApplicationPluginInterface|null
     */
    public function resolve(string $pluginAlias): ApplicationPluginInterface|null
    {
        if(in_array($pluginAlias, $this->cache)) {
            return $this->cache[$pluginAlias];
        }

        $result = $this->pluginClassResolver->resolve($pluginAlias);

        $this->cache[$pluginAlias] = $result;

        return $result;
    }
}