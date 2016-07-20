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
}
