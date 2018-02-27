<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TempUserMiddleWare
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

        // $id=$request->route()->getParameter('id');
  
       if(Auth::user()->privillage!=0)
       {
     return $next($request);
      
      }

     return redirect('/');  

    
}
}
