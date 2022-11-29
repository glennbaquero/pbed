<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLatestStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('latest_studies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('header');
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('downloadable')->default(false);
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('latest_studies');
    }
}
