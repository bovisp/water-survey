<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;

class CanViewSoT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            abort(404);
        }


        if (auth()->user()->hasRole('administrator')) {
            return $next($request);
        }

        if ($this->authenticatedUsersProfile()) {
            return $next($request);
        }

        foreach(auth()->user()->reportingStructure()->flatten(1) as $employee) {
            if ($employee['id'] === $this->userIdFromRequest() && $employee['rank'] > auth()->user()->roles->first()->rank && auth()->user()->active === 1) {
                return $next($request);
            }
        }

        return abort(401);
    }

    protected function userIdFromRequest()
    {
    	preg_match_all("/\/reports\/sot\/([\d]+)/",request()->url(),$matches);

    	return (int) $matches[1][0];
    }

    protected function authenticatedUsersProfile() {
        return (auth()->id() === $this->userIdFromRequest()) && auth()->user()->active === 1;
    }
}
