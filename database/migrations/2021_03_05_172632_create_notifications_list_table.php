<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('date_id')->unsigned();
            $table->foreign('date_id')->references('id')->on('date');
            $table->integer('elements_category_id')->unsigned();
            $table->foreign('elements_category_id')->references('id')->on('elements_category');
            $table->integer('user_id');
            $table->date('send')->nullable();
            $table->date('next_send')->nullable();
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
        Schema::dropIfExists('notifications_list');
    }
}
