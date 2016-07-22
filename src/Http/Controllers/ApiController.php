<?php

namespace TypiCMS\Modules\Attributes\Http\Controllers;

use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Attributes\Models\Attribute;
use TypiCMS\Modules\Attributes\Repositories\AttributeInterface as Repository;

class ApiController extends BaseApiController
{
    public function __construct(Repository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Get models.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($builder = null)
    {
        $id = Request::input('attribute_group_id');

        $models = $this->repository->allNestedBy('attribute_group_id', $id, [], true);

        return response()->json($models, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $model = $this->repository->create(Request::all());
        $error = $model ? false : true;

        return response()->json([
            'error' => $error,
            'model' => $model,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $model
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $updated = $this->repository->update(Request::all());

        return response()->json([
            'error' => !$updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \TypiCMS\Modules\Attributes\Models\Attribute $attribute
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Attribute $attribute)
    {
        $deleted = $this->repository->delete($attribute);

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
