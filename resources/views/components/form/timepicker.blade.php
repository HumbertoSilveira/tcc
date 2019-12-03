@php
    if (!isset($attributes['class'])) {
        $attributes['class'] = 'form-control timepicker';
    } else {
        $attributes['class'] = 'form-control timepicker '.$attributes['class'];
    }

    if (isset($action) && $action == 'edit' && !$errors->all()) {
        $attributes['disabled'] = 'disabled';
    }
    $attributes['readonly'] = 'readonly';
@endphp
<div class="bootstrap-timepicker">
    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        {{ Form::label($name, $label) }}
        <div class="input-group date">
            <span class="input-group-addon">
                <i class="fa fa-clock-o"></i>
            </span>
            {{ Form::text($name, $value, $attributes) }}
        </div>
        @if($errors->has($name))
            <span class="help-block">{{ $errors->first($name) }}</span>
        @endif
    </div>
</div>