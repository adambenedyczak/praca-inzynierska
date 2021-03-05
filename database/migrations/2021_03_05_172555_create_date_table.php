<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('elements_id')->unsigned();
            $table->foreign('elements_id')->references('id')->on('elements');
            $table->integer('date_type_id')->unsigned();
            $table->foreign('date_type_id')->references('id')->on('date_type');
            $table->date('date');
            $table->integer('work_time_value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('date');
    }
}
