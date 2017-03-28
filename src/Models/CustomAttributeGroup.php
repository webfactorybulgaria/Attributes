<?php

namespace TypiCMS\Modules\Attributes\Models;

use TypiCMS\Modules\Attributes\Shells\Builders\CustomAttributeQueryBuilder;
use TypiCMS\Modules\Core\Shells\Models\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


/**
 * This is a fake class that is used to eager load the actual attribute groups
 */
class CustomAttributeGroup extends Base
{
    public $incrementing = false;

    public function newQuery() {
        $builder = new Builder(new CustomAttributeQueryBuilder($this->getConnection()));
        $builder->setModel($this);
        return $builder;
    }

    public function getValueAttribute()
    {
        return trans('db.shop.custom_attribute.group_title.' . json_decode($this->id)->groupKey);
    }
}
