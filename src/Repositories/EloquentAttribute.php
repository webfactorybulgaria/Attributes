<?php

namespace TypiCMS\Modules\Attributes\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Shells\Repositories\RepositoriesAbstract;

class EloquentAttribute extends RepositoriesAbstract implements AttributeInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get sort data.
     *
     * @param int   $position
     * @param array $item
     *
     * @return array
     */
    protected function getSortData($position, $item)
    {
        return [
            'position'  => $position
        ];
    }
}
