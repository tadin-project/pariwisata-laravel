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
        Schema::create('group_menus', function (Blueprint $table) {
            $table->id('gm_id');
            $table->unsignedInteger('menu_id');
            $table->unsignedSmallInteger('group_id');
            $table->foreign('group_id', 'group_menus_group_id_FK')->references('group_id')->on('ms_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('menu_id', 'group_menus_menu_id_FK')->references('menu_id')->on('ms_menus')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_menus');
    }
};
