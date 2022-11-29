<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOurLeadershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_leaderships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prefix');
            $table->string('name');
            $table->string('main_position')->nullable();
            $table->string('position')->nullable();
            $table->string('company')->nullable();
            $table->string('image_path')->nullable();
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
        Schema::dropIfExists('our_leaderships');
    }
}
