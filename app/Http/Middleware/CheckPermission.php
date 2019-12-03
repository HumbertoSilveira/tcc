<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Access\Gate;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    private $gate;
    public function __construct(Gate $gate)
    {
        $this->gate = $gate;
    }

    public function handle($request, Closure $next, $permission)
    {
        if(stripos($permission, 'excluir') !== false){
            if($this->gate->denies($permission)){
                return response()->json([
                    'success' => false
                ]);
            }
        }
        if($this->gate->denies($permission)){
            session()->flash('alert', [
                'type' => 'warning',
                'title' => 'Acesso negado',
                'text' => "Você não tem acesso a esta página.",
            ]);

            return redirect()->back();
        }

        return $next($request);
    }
}
