<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permissions)
    {
        if(!auth()->check()) {
            //проверяем на доступы
            foreach (explode('|', $permissions) as $permission) {
                $unreg_role = Role::where('slug', 'nezaregistrirovannyi')->first();
                if (!$unreg_role->hasPermission($permission)) {
                    abort(403, 'Зарегистрируйтесь или войдите, что бы посетить эту страницу');
                }
            }
        }else {
            foreach (explode('|', $permissions) as $permission) {
                if (!auth()->user()->can($permission)) {
                    abort(403, 'Вам не доступна эта страница');
                }
            }
        }
        return $next($request);
    }
}
