<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('username', 55)->unique();
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->foreignId('group_id')->nullable()->constrained('group_members')->onDelete('set null');
            $table->string('project', 50)->nullable();
            $table->string('type', 50)->nullable();
            $table->integer('role')->default(0);
            $table->integer('is_status')->default(0);
            $table->integer('is_active')->default(0);
            $table->rememberToken();
            $table->integer('is_priority')->default(0);
            $table->integer('is_job')->default(0)->nullable();
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
        Schema::dropIfExists('members');
    }
}
