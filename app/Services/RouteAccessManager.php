<?php

declare(strict_types=1);

namespace App\Services;

use App\Admin;
use App\Http\Middleware\RouteAccessMiddleware;
use App\Roles;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class RouteAccessManager
{
    const ROUTE_ACCESS_KEY_PREFIX = 'access-to-';
    const CACHE_FOR_MINUTES = 1440;
    const ROUTE_CACHE_TAG = 'admin-route-cache';
    const ROLE_USER_TAG_PREFIX = 'role-user-';
    const ROUTE_CACHE_KEY='admin-routes';

    public function getRoutes(): array
    {
        return Cache::remember(self::ROUTE_CACHE_KEY, self::CACHE_FOR_MINUTES, function () {


            $routes = collect(Route::getRoutes());
            
            return $routes->filter(function (RoutingRoute $route) {
                return in_array(RouteAccessMiddleware::ALIAS, $route->gatherMiddleware());
            })->map(function (RoutingRoute $route) {
                return $route->getName();
            })->toArray();
        });
    }


    public function accessAllowed(Authenticatable $user, string $route): bool
    {

        return  Cache::tags([
            $this->buildUserTag($user),
            self::ROUTE_CACHE_TAG,
        ])->remember($this->buildRouteAccessKey($route), self::CACHE_FOR_MINUTES, function () use ($user, $route) {
         

            if (!Route::has($route)) {
                return false;
            }

            /** @var Collection|Roles[] $roles */
            $roles = $user->roles()->get();

            if ($roles->contains('full_access', '=', true)) {
                return true;
            }

            return $roles->flatMap(function (Roles $role) {
                return $role->accessible_routes;
            })->contains($route);
        });
    }
    public function flushUserCache(Authenticatable $user):void{
        Cache::tags($this->buildUserTag($user))->flush();
    }
    public function flushCache():void{
        Cache::forget(self::ROUTE_CACHE_KEY);
        Cache::tags(self::ROUTE_CACHE_TAG)->flush();

    }

    private function buildRouteAccessKey(string $route): string
    {
        return self::ROUTE_ACCESS_KEY_PREFIX . $route;
    }
    private function buildUserTag(Authenticatable $user): string
    {
        return self::ROLE_USER_TAG_PREFIX . $user->id;
    }

}
