<?php

namespace TypiCMS\Modules\Attributes\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Attributes\Models\EloquentAttributeGroup;
use AttributeGroups;

class AttributeGroupObserver
{
    /**
     * On save, process attributes.
     *
     * @param Model $model eloquent
     *
     * @return mixed false or void
     */
    public function saved(Model $model)
    {
        $attributes = $this->processAttributes(Request::input('attributes'));
        $this->syncAttributes($model, $attributes);
    }

    /**
     * Convert string of attributes to array.
     *
     * @param  string
     *
     * @return array
     */
    protected function processAttributes($attributes)
    {
        if (!$attributes) {
            return [];
        }

        $attributes = explode(',', $attributes);

        foreach ($attributes as $key => $attribute) {
            $attributes[$key] = trim($attribute);
        }

        return $attributes;
    }

    /**
     * Sync attributes for model.
     *
     * @param Model $model
     * @param array $attributes
     *
     * @return void
     */
    protected function syncAttributes(Model $model, array $attributes)
    {
        if (!method_exists($model, 'attributes')) {
            Log::info('Model doesn’t have a method called attributes');

            return false;
        }

        // Create or add attributes
        $attributeIds = [];

        if ($attributes) {
            $found = AttributeGroups::findOrCreate($attributes);

            foreach ($found as $attribute) {
                $attributeIds[] = $attribute->id;
            }
        }

        // Assign attributes to model
        $model->attributes()->sync($attributeIds);
    }
}
