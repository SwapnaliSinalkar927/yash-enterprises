<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // return $request->expectsJson() ? null : route('admin.auth.login',['redirect-url'=>$request->fullUrl()]);

        if (! $request->expectsJson()) {
            // $url = url()->full();
            // if (strpos($url, '/admin') !== false) {
            //     return route('admin.auth.login',['redirect-url'=>$request->fullUrl()]);
            // } else {
            //     return route('auth.login');
            // }
            $url = url()->full();
            if (strpos($url, '/admin') !== false) {
                return route('admin.auth.login',['redirect-url'=>$request->fullUrl()]);
            }
            else {
                return route('login');
            }
        }
    }
}
