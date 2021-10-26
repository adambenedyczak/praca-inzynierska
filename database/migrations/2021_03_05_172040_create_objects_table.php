<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objects_model', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->integer('object_type_id')->unsigned();
            $table->foreign('object_type_id')->references('id')->on('objects_type');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('work_time_unit_id')->unsigned()->default('1');
            $table->foreign('work_time_unit_id')->references('id')->on('work_time_units');
            $table->integer('current_work_time_value')->nullable();
            $table->boolean('favourite')->default(false);
            $table->boolean('archival')->default(false);
            $table->date('archival_date')->nullable();
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
        Schema::dropIfExists('objects');
    }
}
