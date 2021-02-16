<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('name', 100);
            $table->string('serial_number', 50)->nullable();
            $table->string('manufacturer', 100)->nullable();
            $table->string('note', 200)->nullable();
            $table->integer('objects_id')->unsigned();
            $table->foreign('objects_id')->references('id')->on('objects');
            $table->integer('parts_type_id')->unsigned();
            $table->foreign('parts_type_id')->references('id')->on('parts_type');
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
        Schema::dropIfExists('parts');
    }
}
