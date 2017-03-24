<?php

namespace TypiCMS\Modules\Attributes\Models;

use TypiCMS\Modules\Attributes\Shells\Builders\CustomAttributeQueryBuilder;
use TypiCMS\Modules\Core\Shells\Models\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


class CustomAttribute extends Base
{
    public $incrementing = false;

    public function newQuery() {
        $builder = new Builder(new CustomAttributeQueryBuilder($this->getConnection()));
        $builder->setModel($this);
        return $builder;
    }

    public function fillAttr($key, $val)
    {
        $tmp = new \stdClass;
        $tmp->groupKey = $key;
        $tmp->value = $val;
        $this->id = json_encode($tmp);
    }

}
