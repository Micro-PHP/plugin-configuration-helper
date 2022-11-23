<?php

namespace Micro\Plugin\Configuration\Helper\Facade;


use Micro\Plugin\Configuration\Helper\Business\Path\PathResolverInterface;

class ConfigurationHelperFacade implements ConfigurationHelperFacadeInterface
{
    /**
     * @param PathResolverInterface $pathResolver
     */
    public function __construct(private readonly PathResolverInterface $pathResolver)
    {
    }

    /**
     * @param string $relativePath
     *
     * @return string
     */
    public function resolvePath(string $relativePath): string
    {
        return $this->pathResolver->resolve($relativePath);
    }
}