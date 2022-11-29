<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenge_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('work_challenge_id')->unsigned()->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('graphs')->nullable();
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
        Schema::dropIfExists('challenge_items');
    }
}
