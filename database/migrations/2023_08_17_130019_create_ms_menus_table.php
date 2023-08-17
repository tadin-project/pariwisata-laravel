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
        Schema::create('ms_menus', function (Blueprint $table) {
            $table->increments('menu_id');
            $table->char('menu_kode', 25);
            $table->char('menu_nama', 255);
            $table->boolean('menu_status')->nullable()->default(true);
            $table->char('menu_url', 255)->nullable();
            $table->tinyInteger('menu_jenis')->nullable()->default(1)->comment('1=URL;\n2=Kategori');
            $table->integer('parent_menu_id')->nullable()->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_menus');
    }
};
