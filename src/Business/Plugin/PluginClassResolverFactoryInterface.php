<?php

namespace Micro\Plugin\Configuration\Helper\Business\Plugin;

interface PluginClassResolverFactoryInterface
{
    /**
     * @return PluginClassResolverInterface
     */
    public function create(): PluginClassResolverInterface;
}