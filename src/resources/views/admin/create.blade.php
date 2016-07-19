@extends('core::admin.master')

@section('title', trans('attributes::global.New'))

@section('main')

    <a class="btn-back" href="{{ route('admin::edit-attribute_group', $group->id) }}" title="{{ trans('attributes::global.Back') }}">
    	<span class="text-muted fa fa-arrow-circle-left"></span>
    	<span class="sr-only">{{ trans('attributes::global.Back') }}</span>
	</a>

    <h1>
        @lang('attributes::global.New')
    </h1>

    {!! BootForm::open()->action(route('admin::index-attributes', $group->id))->multipart()->role('form') !!}
        @include('attributes::admin._form')
    {!! BootForm::close() !!}

@endsection
