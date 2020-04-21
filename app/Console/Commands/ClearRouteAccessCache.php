<?php

namespace App\Console\Commands;

use App\Services\RouteAccessManager;
use Illuminate\Console\Command;

class ClearRouteAccessCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:clear-access-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear admin route access';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $routeAccessManager;
    public function __construct(RouteAccessManager $routeAccessManager)
    {
        parent::__construct();
        $this->routeAccessManager=$routeAccessManager;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->routeAccessManager->flushCache();
        $this->info('Route access cache cleared');
    }
}
