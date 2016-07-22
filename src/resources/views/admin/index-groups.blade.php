@extends('core::admin.master')

@section('title', trans('attributes::global.group-name'))

@section('main')

<div ng-app="typicms" ng-cloak ng-controller="ListController">

    <a href="{{ route('admin::create-attribute_group') }}" class="btn-add" title="@lang('attributes::global.New')">
        <i class="fa fa-plus-circle"></i><span class="sr-only">@lang('attributes::global.New')</span>
    </a>

    <h1>
        <span>@{{ models.length }} @choice('attributes::global.group-attributes', 2)</span>
    </h1>

    <div class="btn-toolbar">
        @include('core::admin._lang-switcher')
    </div>

    <div class="table-responsive">

        <table st-persist="attributesTable" st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th st-sort="status" class="status st-sort">Status</th>
                    <th st-sort="image" class="image st-sort">Image</th>
                    <th st-sort="value" class="value st-sort">Value</th>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>
                        <input st-search="value" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels">
                    <td typi-btn-delete action="delete(model)"></td>
                    <td>
                        <a class="btn btn-default btn-xs btn-edit" href="attribute-groups/@{{ model.id }}/edit" title="@lang('global.Edit')">
                            <span class="fa fa-pencil"></span>
                        </a>

                    </td>
                    <td typi-btn-status action="toggleStatus(model)" model="model"></td>
                    <td>
                        <img ng-src="@{{ model.thumb }}" alt="">
                    </td>
                    <td>@{{ model.value }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" typi-pagination></td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>

@endsection
