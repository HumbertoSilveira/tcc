<?php

namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component(
            'bsText',
            'components.form.text',
            [
                'label',
                'name',
                'value' => null,
                'attributes' => [],
                'action' => null
            ]
        );

        Form::component(
            'bsFile',
            'components.form.file',
            [
                'label',
                'name',
                'value' => null,
                'attributes' => [],
                'action' => null
            ]
        );

        Form::component(
            'bsPassword',
            'components.form.password',
            [
                'label',
                'name',
                'attributes' => [],
                'action' => null
            ]
        );

        Form::component(
            'bsTextarea',
            'components.form.textarea',
            [
                'label',
                'name',
                'value' => null,
                'attributes' => [],
                'action' => null
            ]
        );

        Form::component(
            'bsSelect',
            'components.form.select',
            [
                'label',
                'name',
                'value' => null,
                'default_value' => null,
                'attributes' => [],
                'action' => null
            ]
        );

        Form::component(
            'bsDateOfBirthSearch',
            'components.form.date-of-birth-search',
            [
                'label',
                'day_name',
                'month_name',
                'default_day' => null,
                'default_month' => null,
                'attributes' => []
            ]
        );

        Form::component(
            'bsDateOfBirth',
            'components.form.date-of-birth',
            [
                'label',
                'day_name',
                'month_name',
                'year_name',
                'attributes' => [],
                'action'
            ]
        );

        Form::component(
            'bsSelectOrCreate',
            'components.form.select-or-create',
            [
                'label',
                'name',
                'value' => null,
                'default_value' => null,
                'attributes' => [],
                'action' => null,
                'app_id',
                'modal_path',
            ]
        );

        Form::component(
            'bsDatepicker',
            'components.form.datepicker',
            [
                'label',
                'name',
                'value' => null,
                'attributes' => [],
                'action' => null
            ]
        );

        Form::component(
            'bsMultiDatepicker',
            'components.form.multidatepicker',
            [
                'label',
                'name',
                'value' => null,
                'attributes' => [],
                'action' => null
            ]
        );

        Form::component(
            'bsTimepicker',
            'components.form.timepicker',
            [
                'label',
                'name',
                'value' => null,
                'attributes' => [],
                'action' => null
            ]
        );

        Form::component(
            'bsDaterangepicker',
            'components.form.daterangepicker',
            [
                'label',
                'name',
                'value' => null,
                'attributes' => [],
                'action' => null
            ]
        );

        Form::component(
            'bsDuallistbox',
            'components.form.duallistbox',
            [
                'name',
                'value' => null,
                'default_value' => null,
                'attributes' => [],
                'action' => null,
                'enable_add_item' => false,
            ]
        );

        Form::component(
            'bsSwitch',
            'components.form.switch',
            [
                'label',
                'name',
                'value' => null,
                'checked' => null,
                'attributes' => [],
                'action' => null
            ]
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
