<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactInformationFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_information_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contact_information_id')->unsigned()->index();
            $table->bigInteger('category_id')->unsigned()->index();
            $table->string('name');
            $table->string('name_field')->nullable();
            $table->string('value');
            $table->boolean('is_hidden')->default(false);
            $table->boolean('required')->default(false);
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
        Schema::dropIfExists('contact_information_fields');
    }
}
