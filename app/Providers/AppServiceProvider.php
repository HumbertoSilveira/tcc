<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('cpf', function ($attribute, $value, $parameters, $validator) {
            return valida_cpf(so_numero($value));
        });

        Validator::extend('cnpj', function ($attribute, $value, $parameters, $validator) {
            return valida_cnpj(so_numero($value));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
