<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactCategoryFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_category_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contact_category_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('name_field')->nullable();
            $table->boolean('hidden')->default(false);
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
        Schema::dropIfExists('contact_category_fields');
    }
}
