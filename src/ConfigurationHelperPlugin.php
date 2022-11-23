<?php

namespace Micro\Plugin\Configuration\Helper;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\KernelInterface;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Kernel\App\AppKernelInterface;
use Micro\Plugin\Configuration\Helper\Business\Path\PathResolverFactory;
use Micro\Plugin\Configuration\Helper\Business\Path\PathResolverFactoryInterface;
use Micro\Plugin\Configuration\Helper\Business\Plugin\PluginClassResolverFactory;
use Micro\Plugin\Configuration\Helper\Business\Plugin\PluginClassResolverFactoryInterface;
use Micro\Plugin\Configuration\Helper\Business\Plugin\PluginClassResolverInterface;
use Micro\Plugin\Configuration\Helper\Facade\ConfigurationHelperFacade;
use Micro\Plugin\Configuration\Helper\Facade\ConfigurationHelperFacadeInterface;

class ConfigurationHelperPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(ConfigurationHelperFacadeInterface::class, function (AppKernelInterface $kernel) {
            return $this->createFacade($kernel);
        });
    }

    /**
     * @param KernelInterface $kernel
     *
     * @return ConfigurationHelperFacadeInterface
     */
    protected function createFacade(KernelInterface $kernel): ConfigurationHelperFacadeInterface
    {
        $classResolverFactory = $this->createPluginClassResolverFactory($kernel);
        $classResolver = $classResolverFactory->create();
        $pathResolver = $this->createPathResolverFactoryInterface($classResolver)->create();

        return new ConfigurationHelperFacade($pathResolver);
    }

    /**
     * @param KernelInterface $kernel
     *
     * @return PluginClassResolverFactoryInterface
     */
    protected function createPluginClassResolverFactory(KernelInterface $kernel): PluginClassResolverFactoryInterface
    {
        return new PluginClassResolverFactory($kernel);
    }

    /**
     * @param PluginClassResolverInterface $pluginClassResolver
     *
     * @return PathResolverFactoryInterface
     */
    protected function createPathResolverFactoryInterface(PluginClassResolverInterface $pluginClassResolver): PathResolverFactoryInterface
    {
        return new PathResolverFactory($pluginClassResolver);
    }
}