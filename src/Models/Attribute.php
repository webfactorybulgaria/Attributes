<?php

namespace TypiCMS\Modules\Attributes\Models;

use TypiCMS\Modules\Core\Shells\Traits\Translatable;
use InvalidArgumentException;
use Log;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Shells\Models\Base;
use TypiCMS\Modules\History\Shells\Traits\Historable;
use TypiCMS\NestableTrait;

class Attribute extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;
    use NestableTrait;

    protected $presenter = 'TypiCMS\Modules\Attributes\Shells\Presenters\ModulePresenter';

    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'image',
        'attribute_group_id',
        'position',
        // Translatable columns
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

    protected $appends = ['thumb'];

    /**
     * An attribute belongs to an attribute group.
     */
    public function attributeGroup()
    {
        return $this->belongsTo('TypiCMS\Modules\Attributes\Shells\Models\AttributeGroup');
    }

    /**
     * Append thumb attribute.
     *
     * @return string
     */
    public function getThumbAttribute()
    {
        return $this->present()->thumbSrc(null, 22);
    }

    /**
     * Get edit url of model.
     *
     * @return string|void
     */
    public function editUrl()
    {
        try {
            return route('admin::edit-attribute', [$this->attribute_group_id, $this->id]);
        } catch (InvalidArgumentException $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Get back office’s index of models url.
     *
     * @return string|void
     */
    public function indexUrl()
    {
        try {
            return route('admin::edit-attribute_group', $this->attribute_group_id);
        } catch (InvalidArgumentException $e) {
            Log::error($e->getMessage());
        }
    }
}
