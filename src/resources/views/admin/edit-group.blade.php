@extends('core::admin.master')

@section('title', $model->present()->title)

@section('main')
    <a class="btn-back" href="{{ route('admin::index-attribute_groups') }}" title="{{ trans('attributes::global.Back') }}">
    	<span class="text-muted fa fa-arrow-circle-left"></span>
    	<span class="sr-only">{{ trans('attributes::global.Back') }}</span>
    </a>

    <h1 class="@if(!$model->present()->title)text-muted @endif">
        {{ $model->present()->title ?: trans('core::global.Untitled') }}
    </h1>

    {!! BootForm::open()->put()->action(route('admin::update-attribute_group', $model->id))->multipart()->role('form') !!}
    {!! BootForm::bind($model) !!}
        @include('attributes::admin._form-group')
    {!! BootForm::close() !!}

@endsection
