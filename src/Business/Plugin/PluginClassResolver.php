<?php

namespace Micro\Plugin\Configuration\Helper\Business\Plugin;

use Micro\Framework\Kernel\Configuration\Exception\InvalidConfigurationException;
use Micro\Framework\Kernel\KernelInterface;
use Micro\Framework\Kernel\Plugin\ApplicationPluginInterface;

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
    public function resolve(string $pluginAlias): ApplicationPluginInterface|null
    {
        foreach ($this->kernel->plugins() as $plugin) {
            if($this->getPluginName($plugin) === $pluginAlias) {
                return $plugin;
            }
        }

        throw new InvalidConfigurationException(sprintf('Plugin %s is not installed.', $pluginAlias));
    }

    /**
     * @param ApplicationPluginInterface $plugin
     *
     * @return string
     */
    protected function getPluginName(ApplicationPluginInterface $plugin): string
    {
        $pluginName = $plugin->name();
        if(class_exists($pluginName)) {
            $exploded = explode('\\', $pluginName);
            return array_pop($exploded);
        }

        return $pluginName;
    }
}