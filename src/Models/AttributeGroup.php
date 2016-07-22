<?php

namespace TypiCMS\Modules\Attributes\Models;

use TypiCMS\Modules\Core\Traits\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class AttributeGroup extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Attributes\Presenters\ModulePresenter';

    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'type',
        'value',
        'status',
    ];

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = [
        'value',
        'status'
    ];

    /**
     * Define a many-to-many polymorphic relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function products()
    {
        return $this->morphedByMany('TypiCMS\Modules\Products\Models\Product', 'attributable');
    }

    /**
     * Attribute group has many attribute items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('TypiCMS\Modules\Attributes\Models\Attribute')->where('status', 1)->orderBy('position', 'ASC');
    }
}
