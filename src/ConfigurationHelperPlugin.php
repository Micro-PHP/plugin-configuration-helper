<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\Configuration\Helper;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\KernelInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Kernel\App\AppKernelInterface;
use Micro\Plugin\Configuration\Helper\Business\Path\PathResolverFactory;
use Micro\Plugin\Configuration\Helper\Business\Path\PathResolverFactoryInterface;
use Micro\Plugin\Configuration\Helper\Business\Plugin\PluginClassResolverFactory;
use Micro\Plugin\Configuration\Helper\Business\Plugin\PluginClassResolverFactoryInterface;
use Micro\Plugin\Configuration\Helper\Business\Plugin\PluginClassResolverInterface;
use Micro\Plugin\Configuration\Helper\Facade\ConfigurationHelperFacade;
use Micro\Plugin\Configuration\Helper\Facade\ConfigurationHelperFacadeInterface;

class ConfigurationHelperPlugin implements DependencyProviderInterface
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

    protected function createFacade(KernelInterface $kernel): ConfigurationHelperFacadeInterface
    {
        $classResolverFactory = $this->createPluginClassResolverFactory($kernel);
        $classResolver = $classResolverFactory->create();
        $pathResolver = $this->createPathResolverFactoryInterface($classResolver)->create();

        return new ConfigurationHelperFacade($pathResolver);
    }

    protected function createPluginClassResolverFactory(KernelInterface $kernel): PluginClassResolverFactoryInterface
    {
        return new PluginClassResolverFactory($kernel);
    }

    protected function createPathResolverFactoryInterface(PluginClassResolverInterface $pluginClassResolver): PathResolverFactoryInterface
    {
        return new PathResolverFactory($pluginClassResolver);
    }
}
