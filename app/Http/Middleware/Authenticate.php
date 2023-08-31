<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        dd('hello');
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
    public function handle($request, Closure $next)
    {
        $username = 'umair';
        $password = 'tariq';

        if ($request->getUser() != $username || $request->getPassword() != $password) {
            dd('hello');
            $headers = array('WWW-Authenticate' => 'Basic');
            return response('Unauthorized', 401, $headers);
        }
        dd('hello');
        return $next($request);
    }
}
