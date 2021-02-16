<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->date('date');
            $table->string('note', 200)->nullable();
            $table->integer('objects_id')->unsigned();
            $table->foreign('objects_id')->references('id')->on('objects');
            $table->integer('insurances_date_type_id')->unsigned();
            $table->foreign('insurances_date_type_id')->references('id')->on('insurances_date_type');
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
        Schema::dropIfExists('insurances');
    }
}
