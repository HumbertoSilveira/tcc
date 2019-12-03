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
<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    {{ Form::label($name, $label) }}
    {{ Form::Password($name, $attributes) }}
    @if($errors->has($name))
        <span class="help-block">{{ $errors->first($name) }}</span>
    @endif
</div>
