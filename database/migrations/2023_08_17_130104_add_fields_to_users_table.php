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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('user_status')->nullable()->default(true);
            $table->smallInteger('group_id', false, true)->nullable();
            $table->softDeletes();

            $table->foreign('group_id', 'users_group_id_FK')->references('group_id')->on('ms_groups')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_group_id_FK');

            $table->dropColumn(['group_id', 'user_status']);
            $table->dropSoftDeletes();
        });
    }
};
