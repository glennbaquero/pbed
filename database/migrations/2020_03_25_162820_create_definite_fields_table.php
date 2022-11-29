<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefiniteFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('definite_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');            
            $table->string('name_field')->nullable();            
            $table->boolean('hidden')->default(false);            
            $table->boolean('required')->default(false);            
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
        Schema::dropIfExists('definite_fields');
    }
}
