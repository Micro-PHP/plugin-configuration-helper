<?php

namespace Micro\Plugin\Configuration\Helper\Business\Path;

class PathResolverCacheDecorator implements PathResolverInterface
{
    /**
     * @var array
     */
    private array $cache;

    /**
     * @param PathResolverInterface $pathResolver
     */
    public function __construct(private readonly PathResolverInterface $pathResolver)
    {
        $this->cache = [];
    }

    /**
     * @param string $relative
     *
     * @return string
     */
    public function resolve(string $relative): string
    {
        if(!array_key_exists($relative, $this->cache)) {
            $this->cache[$relative] = $this->pathResolver->resolve($relative);
        }

        return $this->cache[$relative];
    }
}