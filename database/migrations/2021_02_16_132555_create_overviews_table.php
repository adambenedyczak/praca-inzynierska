<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overviews', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->date('date');
            $table->integer('mileage')->nullable();
            $table->integer('moto_hours')->nullable();
            $table->string('note', 200)->nullable();
            $table->integer('objects_id')->unsigned();
            $table->foreign('objects_id')->references('id')->on('objects');
            $table->integer('overviews_date_type_id')->unsigned();
            $table->foreign('overviews_date_type_id')->references('id')->on('overviews_date_type');
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
        Schema::dropIfExists('overviews');
    }
}
