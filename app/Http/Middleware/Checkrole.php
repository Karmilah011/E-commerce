<?php
namespace App\Http\Middleware;
use Closure;
class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
          if (in_array($request->user()->role,$roles)) {
            return $next($request);
          }
        return redirect()->back();
    }
}