<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTheChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('the_challenges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('label');
            $table->string('data');
            $table->string('bgcolor');
            $table->boolean('for_teaching_learning')->default(false);
            $table->string('label_teaching_learning')->nullable();
            $table->string('title_two')->nullable();
            $table->string('label_two')->nullable();
            $table->string('data_two')->nullable();
            $table->string('bgcolor_two')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('the_challenges');
    }
}
