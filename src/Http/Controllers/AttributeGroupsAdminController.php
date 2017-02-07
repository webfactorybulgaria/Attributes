<?php

namespace TypiCMS\Modules\Attributes\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Attributes\Http\Requests\FormRequest;
use TypiCMS\Modules\Attributes\Models\AttributeGroup;
use TypiCMS\Modules\Attributes\Repositories\AttributeGroupInterface;

class AttributeGroupsAdminController extends BaseAdminController
{
    public function __construct(AttributeGroupInterface $attribute)
    {
        parent::__construct($attribute);
    }

    /**
     * List models.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all([], true);
        app('JavaScript')->put('models', $models);

        return view('attributes::admin.index-groups');
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();

        return view('attributes::admin.create-group')
            ->with(compact('model'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Attributes\Models\AttributeGroup $group
     *
     * @return \Illuminate\View\View
     */
    public function edit(AttributeGroup $group)
    {
        $repository = app('TypiCMS\Modules\Attributes\Repositories\AttributeInterface');
        $models = $repository->allNestedBy('attribute_group_id', $group->id, [], true);
        app('JavaScript')->put('models', $models);

        return view('attributes::admin.edit-group')
            ->with(['model' => $group]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Attributes\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $attribute = $this->repository->create($request->all());

        return $this->redirect($request, $attribute);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Attributes\Models\AttributeGroup     $attribute
     * @param \TypiCMS\Modules\Attributes\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AttributeGroup $group, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $group);
    }
}
