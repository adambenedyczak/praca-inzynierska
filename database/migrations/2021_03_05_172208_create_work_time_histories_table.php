<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkTimeHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_time_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('object_model_id')->unsigned();
            $table->foreign('object_model_id')->references('id')->on('objects_model');
            $table->integer('value');
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
        Schema::dropIfExists('work_time_histories');
    }
}
