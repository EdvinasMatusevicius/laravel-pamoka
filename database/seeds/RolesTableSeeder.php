<?php

use App\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Roles::class)->state('SuperAdmin')->create();
        factory(Roles::class)->state('Manager')->create();
    }
}
