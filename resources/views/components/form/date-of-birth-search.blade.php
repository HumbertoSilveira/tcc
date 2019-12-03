@php
    if (!isset($attributes['class'])) {
        $attributes['class'] = 'form-control';
    } else {
        $attributes['class'] = 'form-control'.$attributes['class'];
    }

    $days_of_month = [];
    $days_of_month['T'] = 'Todos';

    foreach (range(1, 31) as $day) {
        $day = str_pad($day, 2, '0', STR_PAD_LEFT);
        $days_of_month[$day] = $day;
    }

    $months = collect(config('app.opcoes_gerais.meses_ano'));
    $months->prepend('Todos', 'T');
@endphp
<div class="form-group-dob-search form-group">
    {{ Form::label($day_name, $label) }}

    <div class="form-group-dob-search-inner">
        <span class="form-group-dob-search-day">
            {{ Form::select($day_name, $days_of_month, $default_day, $attributes) }}
        </span>
        <span class="form-group-dob-search-month">
            {{ Form::select($month_name, $months, $default_month, $attributes) }}
        </span>
    </div>
</div>
