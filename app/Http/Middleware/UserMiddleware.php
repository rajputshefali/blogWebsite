<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Modules\User\Models\User;
use App\Modules\User\Http\Controllers\UserController;
use Session;


class UserMiddleware
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    
         {
         if(Auth::check() && Auth::User()->isBan)
         {
            $banned = Auth::User()->isBan=="1";
            Auth::logout();
            if($banned == 1)
            {
                $message = "Your account is banned.";
            }
            return redirect()->route('login-user')
            ->with('status',$message)
            ->withErrors(['email' =>'Your account has been banned.']);

         }
    
        
        return $next($request);
    }

}
