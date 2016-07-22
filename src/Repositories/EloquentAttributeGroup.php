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

    /**
     * Find existing attributes or create if they don't exist.
     *
     * @param array $attributes Array of strings, each representing a attribute
     *
     * @return array Array or Arrayable collection of AttributeGroups objects
     */
    public function findOrCreate(array $attributes)
    {
        $foundAttributes = $this->model->whereIn('value', $attributes)->get();

        $returnAttributes = [];

        if ($foundAttributes) {
            foreach ($foundAttributes as $attribute) {
                $pos = array_search($attribute->value, $attributes);

                // Add returned attributes to array
                if ($pos !== false) {
                    $returnAttributes[] = $attribute;
                    unset($attributes[$pos]);
                }
            }
        }

        // Add remainings attributes as new
        foreach ($attributes as $attribute) {
            $returnAttributes[] = $this->model->create([
                'value'  => $attribute,
                'slug' => Str::slug($attribute),
            ]);
        }

        return $returnAttributes;
    }
}
