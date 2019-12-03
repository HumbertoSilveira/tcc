@php
    if (!isset($attributes['class'])) {
        $attributes['class'] = 'form-control date-mask rangedatepicker';
    } else {
        $attributes['class'] = 'form-control date-mask rangedatepicker'.$attributes['class'];
    }

    if (isset($action) && $action == 'edit' && !$errors->all()) {
        $attributes['disabled'] = 'disabled';
    }
@endphp
<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    {{ Form::label($name, $label) }}
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </span>
        {{ Form::text($name, $value, $attributes) }}
    </div>
    @if($errors->has($name))
        <span class="help-block">{{ $errors->first($name) }}</span>
    @endif
</div>
