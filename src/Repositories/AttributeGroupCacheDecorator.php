<?php

namespace TypiCMS\Modules\Attributes\Repositories;

use TypiCMS\Modules\Core\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Services\Cache\CacheInterface;

class AttributeGroupCacheDecorator extends CacheAbstractDecorator implements AttributeGroupInterface
{
    public function __construct(AttributeGroupInterface $repo, CacheInterface $cache)
    {
        $this->repo = $repo;
        $this->cache = $cache;
    }

    /**
     * Find existing attributes or create if they don't exist.
     *
     * @param array $attributes Array of strings, each representing a attribute
     *
     * @return array Array or Arrayable collection of Attribute objects
     */
    public function findOrCreate(array $attributes)
    {
        $this->cache->flush();

        return $this->repo->findOrCreate($attributes);
    }
}
