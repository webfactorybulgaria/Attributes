<?php

namespace TypiCMS\Modules\Attributes\Http\Controllers;

use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Attributes\Http\Requests\FormRequest;
use TypiCMS\Modules\Attributes\Models\Attribute;
use TypiCMS\Modules\Attributes\Models\AttributeGroup;
use TypiCMS\Modules\Attributes\Repositories\AttributeInterface;

class AdminController extends BaseAdminController
{
    public function __construct(AttributeInterface $attribute)
    {
        parent::__construct($attribute);
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(AttributeGroup $group)
    {
        $model = $this->repository->getModel();

        return view('attributes::admin.create')
            ->with(compact('model', 'group'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Attributes\Models\Attribute $attribute
     *
     * @return \Illuminate\View\View
     */
    public function edit(AttributeGroup $group, Attribute $attribute)
    {
        return view('attributes::admin.edit')
            ->with([
                'group' => $group,
                'model' => $attribute
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Attributes\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AttributeGroup $group, FormRequest $request)
    {
        $data = $request->all();
        $data['attribute_group_id'] = $group->id;

        $attribute = $this->repository->create($data);

        return $this->redirect($request, $attribute);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Attributes\Models\Attribute            $attribute
     * @param \TypiCMS\Modules\Attributes\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AttributeGroup $group, Attribute $attribute, FormRequest $request)
    {
        $data = $request->all();
        $data['attribute_group_id'] = $group->id;
        $this->repository->update($data);

        return $this->redirect($request, $attribute);
    }

    /**
     * Sort list.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sort()
    {
        $this->repository->sort(Request::all());

        return response()->json([
            'error'   => false,
            'message' => trans('global.Items sorted'),
        ], 200);
    }
}
