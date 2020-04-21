<?php

namespace App\Http\Middleware;

use App\Services\RouteAccessManager;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RouteAccessMiddleware
{
    const ALIAS = 'admin-access';

    const ACCESS_NOT_ALLOWED_MESSAGE = 'You dont have access to requested page';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $routeAccessManager;
    public function __construct(RouteAccessManager $routeAccessManager)
    {
        $this->routeAccessManager=$routeAccessManager;
    }


    public function handle($request, Closure $next)
    {
        if($this->shouldBlockAccess()){
            return \redirect()->route('home')
            ->with('danger','self::ACCESS_NOT_ALLOWED_MESSAGE');

        }
        return $next($request);
    }
    private function shouldBlockAccess(): bool{
        return Auth::guard('admin')->check() && 
        !$this->routeAccessManager->accessAllowed(
            Auth::guard('admin')->user(),
            (string)Arr::get(Route::current()->action,'as')
        );
    }
}
