<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
      $roles = array('1' => 'student', '2' => 'teacher', '3' => 'admin');
      if ($request->user() !== null && !$request->user()->hasRole($role)) {
        $user = $request->user();
        return redirect($roles[$user['attributes']['user_type']]);
      }
      return $next($request);
    }
}
