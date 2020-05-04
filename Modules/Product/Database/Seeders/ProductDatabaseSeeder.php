<?php

declare(strict_types = 1);

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Class ProductDatabaseSeeder
 * @package Modules\Product\Database\Seeders
 */
class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
    }
}
