@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

<div class="row">
    @if ($model->id)
    <div class="col-sm-6 container-menulinks">
    	<p>
    	    <a href="{{ route('admin::create-attribute', $model->id) }}">
    	        <i class="fa fa-fw fa-plus-circle"></i>@lang('attributes::global.New')
    	    </a>
    	</p>
    	<div ng-app="typicms" ng-cloak ng-controller="ListController">
            <div class="btn-toolbar">
                @include('core::admin._lang-switcher')
            </div>
            <!-- Nested node template -->
            <div ui-tree="treeOptions">
                <ul ui-tree-nodes="" data-max-depth="3" ng-model="models" id="tree-root">
                    <li ng-repeat="model in models" ui-tree-node ng-include="'/views/partials/listItemAttribute.html'"></li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <div class="col-sm-6">
    	{!! BootForm::select(trans('validation.attributes.type'), 'type', config('typicms.attributes.types')) !!}

    	{!! TranslatableBootForm::hidden('status')->value(0) !!}
    	{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}
    	{!! TranslatableBootForm::text(trans('attributes::global.attributes.groupname'), 'value') !!}
    </div>
</div>
