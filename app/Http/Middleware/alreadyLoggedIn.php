<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Modules\User\Models\User;
class alreadyLoggedIn
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
        // if(url('login-user')==$request->url() || url('registration')==$request->url())
        
        $path=$request->path();

        if( Auth::check() && ($path=="login-user"||$path=="registration" ))
        {
            return redirect('/home');
            
        }
       

        return $next($request);
    }
}
