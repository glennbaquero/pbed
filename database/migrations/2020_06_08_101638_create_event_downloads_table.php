<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_downloads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('latest_study_id')->unsigned()->index();
            $table->string('full_name');
            $table->string('email');
            $table->string('contact_number');
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
        Schema::dropIfExists('event_downloads');
    }
}
