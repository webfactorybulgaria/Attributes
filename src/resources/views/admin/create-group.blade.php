@extends('core::admin.master')

@section('title', trans('attributes::global.New Group'))

@section('main')

    <a class="btn-back" href="{{ route('admin::index-attribute_groups') }}" title="{{ trans('attributes::global.Back') }}">
    	<span class="text-muted fa fa-arrow-circle-left"></span>
    	<span class="sr-only">{{ trans('attributes::global.Back') }}</span>
    </a>

    <h1>
        @lang('attributes::global.New Group')
    </h1>

    {!! BootForm::open()->action(route('admin::index-attribute_groups'))->multipart()->role('form') !!}
        @include('attributes::admin._form-group')
    {!! BootForm::close() !!}

@endsection
