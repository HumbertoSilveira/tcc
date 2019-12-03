@php
    if (!isset($attributes['class'])) {
        $attributes['class'] = 'form-control';
    } else {
        $attributes['class'] = 'form-control '.$attributes['class'];
    }

    if (isset($action) && $action == 'edit' && !$errors->all()) {
        $attributes['disabled'] = 'disabled';
    }

    $error_class = '';
    if (isset($attributes['multiple'])) {
        $multiple_name = str_replace(['[', ']'], '', $name);
    }

    if(isset($multiple_name) && $errors->has($multiple_name)) {
        $error_class = ' has-error';
    } else if ($errors->has($name)) {
        $error_class = ' has-error';
    }



@endphp
<div class="form-group{{ $error_class }}">
    @if(!is_null($label))
        {{ Form::label($name, $label) }}
    @endif
    {{ Form::select($name, $value, $default_value, $attributes) }}

    @if(isset($multiple_name) && $errors->has($multiple_name))
        <span class="help-block">{{ $errors->first($multiple_name) }}</span>
    @elseif($errors->has($name))
        <span class="help-block">{{ $errors->first($name) }}</span>
    @endif

</div>
