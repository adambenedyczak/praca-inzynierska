<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('object_model_id')->unsigned();
            $table->foreign('object_model_id')->references('id')->on('objects_model');
            $table->string('name', 100);
            $table->integer('elements_category_id')->unsigned();
            $table->foreign('elements_category_id')->references('id')->on('elements_category');
            $table->morphs('elements_typeable');
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
        Schema::dropIfExists('elements');
    }
}
