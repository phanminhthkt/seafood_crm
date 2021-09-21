<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWmsImports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wms_imports', function (Blueprint $table) {
            $table->id();
            $table->string('code', 255)->nullable();
            $table->double('total_price')->default(0);
            $table->integer('store_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('status_id')->default(0);
            $table->integer('is_status')->default(0);
            $table->integer('is_priority')->default(0);
            $table->string('note')->nullable();
            $table->string('note_cancel')->nullable();
            $table->string('import_created_at')->nullable();
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
        Schema::dropIfExists('wms_imports');
    }
}
