<?php

namespace Micro\Plugin\Configuration\Helper\Facade;

interface ConfigurationHelperFacadeInterface
{
    /**
     * Generate full path to file. For example:
     *
     * Input: @HttpSecurityPlugin/Resource/routing/routing.xml
     * Output: /app/vendor/micro/plugin-http-security/src/Resource/routing/routing.xml
     *
     * @api
     *
     * @param string $relativePath
     *
     * @return string
     */
    public function resolvePath(string $relativePath): string;
}