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
		public function handle($request, Closure $next, $role) {
			/* option of roles for admin, teacher, and admin */
			$roles = array('1' => 'student', '2' => 'teacher', '3' => 'admin');
			
			/* redirect to login page if trying to access page that has role */
			if ($role !== "none" && $request->user() === null) {
				return redirect()
					->action("LandingController@index")
					->with(["message" => "No right access, please login first. No account? register <a href='/register'>here</a>"]);
			}
			
			/* if user has no right access for a specific page, redirects to where it belongs */
			if ($request->user() !== null && !$request->user()->hasRole($role)) {
				$user = $request->user();
				return redirect($roles[$user['attributes']['user_type']]);
			}
			/* otherwise proceed to request */
			return $next($request);
		}
}
