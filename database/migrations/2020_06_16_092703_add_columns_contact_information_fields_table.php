<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsContactInformationFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_information_fields', function (Blueprint $table) {
            $table->bigInteger('definite_field_id')->unsigned()->index()->nullable();
            $table->bigInteger('contact_category_field_id')->unsigned()->index()->nullable();
            $table->boolean('is_definite_fields')->default(false);
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
