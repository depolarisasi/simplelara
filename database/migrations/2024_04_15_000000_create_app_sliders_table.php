<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('slider_url');
            $table->string('slider_title');
            $table->text('slider_caption');
            $table->enum('slider_type', ['Big', 'Small']);
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
        Schema::dropIfExists('app_sliders');
    }
} 