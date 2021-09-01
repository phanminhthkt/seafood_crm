<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('sku', 255)->nullable();
            $table->integer('is_status')->default(0);
            $table->integer('is_priority')->default(0);
            $table->double('import_price', 15, 8)->default(0);
            $table->double('export_price', 15, 8)->default(0);
            $table->foreignId('product_id')->constrained("products")->onDelete('cascade');
            $table->foreignId('group_attribute_id')->constrained("group_attributes")->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained("attributes")->onDelete('cascade');
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
        Schema::dropIfExists('table_product_attribute');
    }
}
