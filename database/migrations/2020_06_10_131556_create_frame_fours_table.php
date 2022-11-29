<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrameFoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frame_fours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('show')->default(false);
            $table->string('name');
            $table->string('label');
            $table->string('data');
            $table->string('bgcolor');
            $table->string('first_header');
            $table->text('first_content');
            $table->string('second_header')->nullable();
            $table->text('second_content')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('frame_fours');
    }
}
