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
     * Relations.
     */
    public function attributes()
    {
        dd('xx');
        return $this->hasMany('TypiCMS\Modules\Attributes\Models\Attribute')->orderBy('position', 'asc');
    }
}
