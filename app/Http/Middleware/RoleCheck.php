<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Support\Facades\Auth;

/**
 * Description of RoleCheck
 *
 * @author valeriycss
 */
class RoleCheck {

    //put your code here
    public function handle($request, Closure $next) {
        $role = $request->user()->role;
        if ($role != 'admin') {
            return redirect('/')->withErrors('Soorry, you dont have permission for that...');
        }
        return $next($request);
    }

}
