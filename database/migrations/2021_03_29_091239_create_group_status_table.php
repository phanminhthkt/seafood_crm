<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_status', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('type', 50)->nullable();
            $table->integer('is_active')->default(0);
            $table->integer('is_status')->default(0);
            $table->integer('is_priority')->default(0);
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
        Schema::dropIfExists('group_status');
    }
}
