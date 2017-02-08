@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script>
	    $(document).ready(function(){
	        $('.colorpicker-component').colorpicker();
	    });
	</script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

@include('core::admin._image-fieldset', ['field' => 'image'])
{!! TranslatableBootForm::hidden('status')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}

@if($group->type == 'colorbox')
	{!! TranslatableBootForm::inputGroup(trans('attributes::global.attributes.value'), 'value')->addClass('colorpicker-component')->beforeAddon('<i></i>') !!}
@else
	{!! TranslatableBootForm::text(trans('attributes::global.attributes.value'), 'value') !!}
@endif
