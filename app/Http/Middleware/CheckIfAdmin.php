<?php

namespace App\Http\Middleware;

use App\Filament\Pages\Dashboard;
use App\Providers\Filament\AdminPanelProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->is_admin){
            return redirect('operator');
        }
        return $next($request);
    }
}
