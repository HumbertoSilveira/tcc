@php
    if (!isset($attributes['class'])) {
        $attributes['class'] = 'bs-switch';
    } else {
        $attributes['class'] = 'bs-switch '.$attributes['class'];
    }

    if (isset($action) && $action == 'edit' && !$errors->all()) {
        $attributes['disabled'] = 'disabled';
    }
@endphp
<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    @if(!is_null($label))
        {{ Form::label($name, $label) }}<br>
    @endif
    {{ Form::checkbox($name, $value, $checked, $attributes) }}
    @if($errors->has($name))
        <span class="help-block">{{ $errors->first($name) }}</span>
    @endif
</div>
