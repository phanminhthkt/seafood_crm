<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_photos', function (Blueprint $table) {
            $table->string('name', 255)->nullable();
            $table->string('photo', 50)->nullable();
            $table->string('type', 50)->nullable();
            $table->integer('is_status')->default(1);
            $table->integer('is_priority')->default(0);
            $table->foreignId('product_id')->constrained("products")->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
