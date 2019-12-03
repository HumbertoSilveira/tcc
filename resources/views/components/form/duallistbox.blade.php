@php
    if (!isset($attributes['id'])) {
        $attributes['id'] = $name;
    }

    if (!isset($attributes['class'])) {
        $attributes['class'] = 'form-control bs-duallistbox';
    } else {
        $attributes['class'] = 'form-control bs-duallistbox '.$attributes['class'];
    }

    if (!isset($attributes['multiple'])) {
        $attributes['multiple'] = 'multiple';
    }

    if (isset($action) && $action == 'edit' && !$errors->all()) {
        $attributes['disabled'] = 'disabled';
    }
@endphp
<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    @if($enable_add_item)
        <div class="row row-duallistbox-add margin-bottom-15">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control"@if (isset($action) && $action == 'edit' && !$errors->all()) disabled="disabled"@endif>
                    <span class="input-group-btn">
                        <button type="button"
                                class="btn btn-default btn-flat btn-duallistbox-add"
                                @if (isset($action) && $action == 'edit' && !$errors->all()) disabled="disabled"@endif>
                            Inserir item
                        </button>
                    </span>
                </div>
            </div>
        </div>
    @endif


    {{ Form::select($name, $value, $default_value, $attributes) }}
    @if($errors->has($name))
        <span class="help-block">{{ $errors->first($name) }}</span>
    @endif
</div>
