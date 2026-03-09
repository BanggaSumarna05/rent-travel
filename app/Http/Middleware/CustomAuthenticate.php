<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;

class CustomAuthenticate extends Middleware
{
    /**
     * Handle an incoming request.
     * Adds an optional `is_active` check on the user model when present.
     */
    protected function authenticate($request, array $guards)
    {
        parent::authenticate($request, $guards);

        $user = $request->user();

        if ($user && property_exists($user, 'is_active')) {
            if (!$user->is_active) {
                abort(403, 'Account not active.');
            }
        }
    }
}
