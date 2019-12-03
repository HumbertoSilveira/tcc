<?php

namespace App\Providers;

use App\Models\Admin\Permissao;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        $permissoes = cache('permissoes');
        if(is_null($permissoes)) {
            $permissoes = Permissao::with('perfis')->get();
            cache(['permissoes' => $permissoes], 60);
        }

        foreach($permissoes as $permissao){
            $gate->define($permissao->slug, function(User $usuario) use($permissao){
                return $usuario->hasPermission($permissao);
            });
        }

        $gate->before(function(User$usuario){
            if($usuario->hasAnyRole('root'))
                return true;
        });
    }
}
