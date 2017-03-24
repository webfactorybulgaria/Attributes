<?php
namespace TypiCMS\Modules\Attributes\Builders;

use Illuminate\Database\Query\Builder as QueryBuilder;

class CustomAttributeQueryBuilder extends QueryBuilder
{
    protected function runSelect()
    {
        $collection = [];
        foreach($this->getBindings() as $id) {
            $customAttribute = new \stdClass;
            $customAttribute->id = $id;

            $collection[] = $customAttribute;
        }

        return $collection;
    }
}
