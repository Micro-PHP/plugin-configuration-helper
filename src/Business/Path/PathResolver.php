<?php

namespace Micro\Plugin\Configuration\Helper\Business\Path;

use Micro\Plugin\Configuration\Helper\Business\Plugin\PluginClassResolverInterface;

class PathResolver implements PathResolverInterface
{
    /**
     * @param PluginClassResolverInterface $pluginClassResolver
     */
    public function __construct(private readonly PluginClassResolverInterface $pluginClassResolver)
    {
    }

    /**
     * @param string $relative
     * @return string
     * @throws \ReflectionException
     */
    public function resolve(string $relative): string
    {
        if(!str_starts_with($relative, '@')) {
            return $relative;
        }

        $alias = explode(DIRECTORY_SEPARATOR, $relative);

        $plugin = $this->pluginClassResolver->resolve(ltrim($alias[0], '@'));
        $reflection = new \ReflectionClass($plugin);

        $file = $reflection->getFileName();
        $basePath = dirname($file);
        $alias[0] = $basePath;

        return implode(DIRECTORY_SEPARATOR, $alias);
    }
}