<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWmsExportDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wms_export_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('export_id')->constrained("wms_exports")->onDelete('cascade');
            $table->integer('product_id')->default(0);
            $table->string('product_code', 255)->nullable();
            $table->string('product_name', 255)->nullable();
            $table->double('product_price')->default(0);
            $table->double('product_quantity')->default(0);
            $table->string('product_unit', 55)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wms_export_details');
    }
}
