<?php

namespace App\Http\Middleware\Almacen;

use Closure;

class alm_adm_middleware
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
    if( Session('almacen') == 1){
      return $next($request);
    } else {
      return redirect('/');
    }
  }
}
