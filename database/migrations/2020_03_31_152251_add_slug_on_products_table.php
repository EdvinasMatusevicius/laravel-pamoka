<?php
declare(strict_types=1);
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddSlugOnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')
            ->after('title');
        });

        $this->updateSlugs();
        
        Schema::table('products',function(Blueprint $table){
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
    private function updateSlugs(): void{
        $products = DB::table('products')->select(['id','title'])->get();

        foreach ($products as $product) {
            $slug= Str::slug($product->title . ' ' . $product->id);
            DB::table('products')->where('id','=',$product->id)->update(['slug'=>$slug]);
        }

    }
}
