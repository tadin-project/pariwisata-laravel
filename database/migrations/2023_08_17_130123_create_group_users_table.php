<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('group_users', function (Blueprint $table) {
            $table->id('gu_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger('group_id');
            $table->foreign('group_id', 'group_users_group_id_FK')->references('group_id')->on('ms_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id', 'group_users_user_id_FK')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_users');
    }
};
