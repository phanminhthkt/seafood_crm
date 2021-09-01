<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWmsImportDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wms_import_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('export_id')->constrained("wms_exports")->onDelete('cascade');
            $table->string('product_code', 255)->nullable();
            $table->string('product_name', 255)->nullable();
            $table->double('product_price', 15, 8)->default(0);
            $table->integer('product_quantity')->default(0);
            $table->integer('product_unit')->default(0);
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
        Schema::dropIfExists('wms_import_details');
    }
}
