<?php

namespace Micro\Plugin\Configuration\Helper\Business\Path;

interface PathResolverFactoryInterface
{
    /**
     * @return PathResolverInterface
     */
    public function create(): PathResolverInterface;
}