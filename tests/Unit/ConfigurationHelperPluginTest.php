<?php

declare(strict_types=1);

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\Configuration\Helper\Test\Unit;

use Micro\Framework\Kernel\Configuration\Exception\InvalidConfigurationException;
use Micro\Kernel\App\AppKernel;
use Micro\Plugin\Configuration\Helper\ConfigurationHelperPlugin;
use Micro\Plugin\Configuration\Helper\Facade\ConfigurationHelperFacadeInterface;
use PHPUnit\Framework\TestCase;

class ConfigurationHelperPluginTest extends TestCase
{
    public function testResolvePath()
    {
        $kernel = new AppKernel(
            [],
            [
                ConfigurationHelperPlugin::class,
                PluginHasMethodName::class,
            ],
        );

        $kernel->run();

        /** @var ConfigurationHelperFacadeInterface $locator */
        $locator = $kernel->container()->get(ConfigurationHelperFacadeInterface::class);

        $cfgHelperPath = $locator->resolvePath('@ConfigurationHelperPlugin');
        $this->assertTrue(is_dir($cfgHelperPath));

        $cfgHelperPathExists = $locator->resolvePath($cfgHelperPath);
        $this->assertEquals($cfgHelperPath, $cfgHelperPathExists);

        $noExists = $locator->resolvePath('NoExists');
        $this->assertEquals('NoExists', $noExists);

        $namedPlugin = $locator->resolvePath('@TestPluginHasMethodName');
        $this->assertTrue(is_dir($namedPlugin));

        $this->expectException(InvalidConfigurationException::class);
        $locator->resolvePath('@NoExists');
    }
}
