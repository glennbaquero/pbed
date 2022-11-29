<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolutionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solution_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('work_solution_id')->unsigned()->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
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
        Schema::dropIfExists('solution_items');
    }
}
