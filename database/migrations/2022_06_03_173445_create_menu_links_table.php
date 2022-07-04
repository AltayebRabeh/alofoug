<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->references('id')->on('menus')->cascadeOnDelete()->cascadeOnUpdate();
            $table->bigInteger('link_id')->references('id')->on('links')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('parent_id')->nullable()->references('id')->on('menu_links');
            $table->bigInteger('order')->default(0)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_links');
    }
};
