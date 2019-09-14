<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use App\User;

class AuthenticateCompany {

    
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::check()) {
            if(Auth::user()->type == "company"){
                return $next($request);
            }
            else{
               
                return redirect('/');        
            }
         
            
        } else {
           
            return redirect('/');
        }
} 

        }

    