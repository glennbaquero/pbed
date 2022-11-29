<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnFrameFoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('frame_fours', function (Blueprint $table) {
            $table->boolean('is_image')->default(false);
            $table->string('image_path')->nullable();
            $table->string('label')->nullable()->change();
            $table->string('data')->nullable()->change();
            $table->string('bgcolor')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
