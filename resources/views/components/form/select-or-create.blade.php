@php
    if (!isset($attributes['class'])) {
        $attributes['class'] = 'form-control';
    } else {
        $attributes['class'] = 'form-control '.$attributes['class'];
    }

    if (isset($action) && $action == 'edit' && !$errors->all()) {
        $attributes['disabled'] = 'disabled';
    }
@endphp
<div id="{{ $app_id }}">
    <div class="custom-input-group">
        <div class="custom-input-group-input">
            <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
                {{ Form::label($name, $label) }}
                {{ Form::select($name, $value, $default_value, $attributes) }}

                @if($errors->has($name))
                    <span class="help-block">{{ $errors->first($name) }}</span>
                @endif
            </div>
        </div>

        <div class="custom-input-group-action">
            <button type="button"
                    class="btn btn-default btn-flat btn-show-modal"
                    @if (isset($action) && $action == 'edit' && !$errors->all()) disabled="disabled"@endif>
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>

    @include($modal_path)
</div>
