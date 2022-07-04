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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('bio')->nullable();
            $table->text('logo')->nullable();
            $table->text('min_logo')->nullable();
            $table->text('social_media')->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('address')->nullable();
            $table->text('statistics')->nullable();
            $table->integer('latest_posts_count')->default(8);
            $table->integer('paginate')->default(20);
            $table->tinyInteger('contact_count')->default(3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
