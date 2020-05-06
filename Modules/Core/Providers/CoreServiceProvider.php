<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class CoreServiceProvider extends ServiceProvider
{
   

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(): void
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
    }

    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [];
    }

}
