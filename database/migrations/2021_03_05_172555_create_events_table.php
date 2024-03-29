<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('element_id')->unsigned();
            $table->foreign('element_id')->references('id')->on('elements');
            $table->integer('events_type_id')->unsigned();
            $table->foreign('events_type_id')->references('id')->on('events_type');
            $table->date('expired_date');
            $table->date('done_date')->nullable();
            $table->integer('work_time_value')->nullable();
            $table->integer('done_work_time_value')->nullable();
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
        Schema::dropIfExists('events');
    }
}
