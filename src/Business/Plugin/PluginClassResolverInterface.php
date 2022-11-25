<?php

namespace Micro\Plugin\Configuration\Helper\Business\Plugin;

interface PluginClassResolverInterface
{
    /**
     * @param string $pluginAlias
     *
     * @return object|null
     */
    public function resolve(string $pluginAlias): object|null;
}