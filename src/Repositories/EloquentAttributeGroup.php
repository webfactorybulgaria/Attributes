<?php

namespace TypiCMS\Modules\Attributes\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentAttributeGroup extends RepositoriesAbstract implements AttributeGroupInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
