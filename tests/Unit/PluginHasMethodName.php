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

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class PluginHasMethodName
{
    public function name(): string
    {
        return 'TestPluginHasMethodName';
    }
}
