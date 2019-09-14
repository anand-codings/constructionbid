<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfNotHomeOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard='homeowner')
    {
          if (!Auth::guard('users')->check()) { 
             
            if ($guard == 'company') { 
                return redirect('/');
            } else {
            return redirect('/');
            }
        } 
         
        if (Auth::guard('users')->check()) {
             
            if ($guard == 'company') { 
              
                if (Auth::guard('users')->user()->type != 'company') {
                   
                     return redirect('/');
                    
                }
                   
            } else {  
                 
                if (Auth::guard('users')->user()->type != 'homeowner') 
                return redirect('/');
            }
        }
      
        return $next($request);
    }
}
