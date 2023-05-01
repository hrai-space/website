<?php

namespace App\Http\Middleware;

use App\Models\Game;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isOwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next): Response
    {
        if($request->route()->hasParameter('game') && $request->route()->action['as'] != 'game.show'){
            if($request->route()->parameter('game')->user_id != $request->user()->id && $request->user()->is_admin != 1){
                abort(403, 'Unauthorized action.');
            }
        }

        return $next($request);
    }
}
