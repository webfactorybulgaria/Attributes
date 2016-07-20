<?php

namespace TypiCMS\Modules\Attributes\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class AttributeTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Attributes\Models\Attribute', 'attribute_id')->withoutGlobalScopes();
    }
}
