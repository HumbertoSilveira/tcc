<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\DB;

class UpdateUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()) {
            DB::table('users')
                ->where('id', auth()->user()->id)
                ->update([
                    'ultima_atividade' => Carbon::now(),
                ]);
        }

        return $next($request);
    }
}
