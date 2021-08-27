<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixbugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixbugs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('id_project')->default(0);
            $table->integer('id_member')->default(0);
            $table->text('content_error')->nullable();
            $table->text('content_fix')->nullable();
            $table->string('link',255);
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('project', 50);
            $table->integer('role')->default(0);
            $table->integer('is_status')->default(0);
            $table->integer('is_active')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('fixbugs');
    }
}
