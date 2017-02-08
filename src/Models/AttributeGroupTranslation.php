<?php

namespace TypiCMS\Modules\Attributes\Models;

use TypiCMS\Modules\Core\Shells\Models\BaseTranslation;

class AttributeGroupTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Attributes\Shells\Models\AttributeGroup', 'attribute_group_id')->withoutGlobalScopes();
    }
}
