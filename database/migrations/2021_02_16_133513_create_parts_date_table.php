<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartsDateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts_date', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->date('data');
            $table->integer('mileage')->nullable();
            $table->integer('moto_hours')->nullable();
            $table->integer('parts_date_type_id')->unsigned();
            $table->foreign('parts_date_type_id')->references('id')->on('parts_date_type');
            $table->integer('parts_id')->unsigned();
            $table->foreign('parts_id')->references('id')->on('parts');
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
        Schema::dropIfExists('parts_date');
    }
}
