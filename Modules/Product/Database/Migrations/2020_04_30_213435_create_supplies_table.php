<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSuppliesTable
 */
class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('logo')->nullable();
            $table->string('phone', 30);
            $table->string('email', 100);
            $table->string('address')->nullable();
            $table->timestamps();
        });

        Schema::create('supply_product', function (Blueprint $table) {
            $table->unsignedBigInteger('supply_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('supply_id')
                ->references('id')
                ->on('supplies')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('supply_product');
        Schema::dropIfExists('supplies');
    }
}
