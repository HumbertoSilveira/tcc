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
    <label for="files-input-upload">{{ $label }}</label> <br>
    <span id="fileselector">
        <label class="btn btn-default{{ isset($attributes['disabled']) ? ' disabled' : ''}}" for="upload-file-selector">
            {{ Form::file($name, $attributes) }}
            <i class="fa fa-upload icon-upload-alt margin-correction"></i> <span class="filename">selecione...</span>
        </label>
    </span>
    @if($errors->has($name))
        <span class="help-block">{{ $errors->first($name) }}</span>
    @endif
</div>
