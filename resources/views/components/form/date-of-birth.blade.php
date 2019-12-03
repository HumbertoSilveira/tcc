@php
    if (!isset($attributes['class'])) {
        $attributes['class'] = 'form-control';
    } else {
        $attributes['class'] = 'form-control '.$attributes['class'];
    }

    if (isset($action) && $action == 'edit' && !$errors->all()) {
        $attributes['disabled'] = 'disabled';
    }

    $days_of_month = [];
    $days_of_month[''] = '--';

    foreach (range(1, 31) as $day) {
        $day = str_pad($day, 2, '0', STR_PAD_LEFT);
        $days_of_month[$day] = $day;
    }
    $months = collect(config('app.opcoes_gerais.meses_ano_short'));
    $months->prepend('--', '');

    $years = [];
    $years[''] = '----';

    foreach (range(date('Y'), date('Y')-150) as $year) {
        $years[$year] = $year;
    }

    $has_error = false;
    if($errors->has('nasc_dia') || $errors->has('nasc_mes') || $errors->has('nasc_ano'))
        $has_error = true;
@endphp
<div class="form-group{{ $has_error ? ' has-error' : '' }}">
    {{ Form::label($day_name, $label) }}
    <div class="row">
        <div class="col-md-4">
            {{ Form::select($day_name, $days_of_month, null, $attributes) }}
        </div>
        <div class="col-md-4">
            {{ Form::select($month_name, $months, null, $attributes) }}
        </div>
        <div class="col-md-4">
            {{ Form::select($year_name, $years, null, $attributes) }}
        </div>
    </div>
    @if($has_error)
        <span class="help-block">{{ 'Erro na data de nascimento.' }}</span>
    @endif
</div>
