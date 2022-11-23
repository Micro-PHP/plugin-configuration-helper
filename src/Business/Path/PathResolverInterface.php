<?php

namespace Micro\Plugin\Configuration\Helper\Business\Path;

interface PathResolverInterface
{
    /**
     * @param string $relative
     *
     * @return string
     */
    public function resolve(string $relative): string;
}