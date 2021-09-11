<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('sku', 255)->nullable();
            $table->string('type', 50)->nullable();
            $table->integer('is_status')->default(1);
            $table->integer('is_priority')->default(1);
            $table->double('import_price')->default(0);
            $table->double('export_price')->default(0);
            $table->foreignId('parent_id')->constrained("products")->onDelete('cascade')->nullable();
            $table->foreignId('category_id')->constrained("categories")->onDelete('cascade');
            $table->foreignId('unit_id')->constrained("units")->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
