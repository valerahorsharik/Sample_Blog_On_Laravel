<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Support\Facades\Auth;


class RoleCheck {

    
    public function handle($request, Closure $next) {
        $role = $request->user()->role;
        if ($role != 'admin') {
            return redirect('/')->withErrors('Soorry, you dont have permission for that...');
        }
        return $next($request);
    }

}
