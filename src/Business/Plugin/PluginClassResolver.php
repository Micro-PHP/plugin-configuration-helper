<?php

namespace Micro\Plugin\Configuration\Helper\Business\Plugin;

use Micro\Framework\Kernel\Configuration\Exception\InvalidConfigurationException;
use Micro\Framework\Kernel\KernelInterface;

class PluginClassResolver implements PluginClassResolverInterface
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
    public function resolve(string $pluginAlias): object|null
    {
        foreach ($this->kernel->plugins() as $plugin) {
            if($this->getPluginName($plugin) === $pluginAlias) {
                return $plugin;
            }
        }

        throw new InvalidConfigurationException(sprintf('Plugin %s is not installed.', $pluginAlias));
    }

    /**
     * @param object $plugin
     *
     * @return string
     */
    protected function getPluginName(object $plugin): string
    {
        // TODO: Create interface for plugin naming
        if(method_exists($plugin, 'name')) {
            return $plugin->name();
        }

        $pluginName = get_class($plugin);
        if(class_exists($pluginName)) {
            $exploded = explode('\\', $pluginName);
            return array_pop($exploded);
        }

        return $pluginName;
    }
}