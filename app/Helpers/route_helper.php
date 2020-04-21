<?php
declare(strict_types=1);

use App\Services\RouteAccessManager;
use Illuminate\Support\Facades\Auth;

function canAccess(string $route): bool{
    $manager = app()->make(RouteAccessManager::class);
    $user = Auth::guard('admin')->user();

    return $manager->accessAllowed($user,$route);
}
function canAccessAny(array $routes):bool{

    $manager = app()->make(RouteAccessManager::class);
    $user = Auth::guard('admin')->user();

    foreach ($routes as $route) {
        if($manager->accessAllowed($user,$route)){
            return true;
        }
    }

    return false;
}