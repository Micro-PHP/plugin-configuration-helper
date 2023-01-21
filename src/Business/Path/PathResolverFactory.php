<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\Configuration\Helper\Business\Path;

use Micro\Plugin\Configuration\Helper\Business\Plugin\PluginClassResolverInterface;

class PathResolverFactory implements PathResolverFactoryInterface
{
    public function __construct(private readonly PluginClassResolverInterface $pluginClassResolver)
    {
    }

    public function create(): PathResolverInterface
    {
        return new PathResolverCacheDecorator(
            new PathResolver($this->pluginClassResolver)
        );
    }
}
