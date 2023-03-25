<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_banner', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->json('user_id');
            $table->string('merchant', 150);
            $table->string('index', 10);
            $table->string('content_type', 30);
            $table->string('name', 30);
            $table->enum('status', ['active', 'disable']);
            $table->string('preview_image');
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
        Schema::dropIfExists('image_banner');
    }
}
