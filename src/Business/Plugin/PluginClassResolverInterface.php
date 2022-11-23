<?php

namespace Micro\Plugin\Configuration\Helper\Business\Plugin;

use Micro\Framework\Kernel\Plugin\ApplicationPluginInterface;

interface PluginClassResolverInterface
{
    /**
     * @param string $pluginAlias
     *
     * @return ApplicationPluginInterface|null
     */
    public function resolve(string $pluginAlias): ApplicationPluginInterface|null;
}