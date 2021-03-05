<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsSentContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_sent_content', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('object_id');
            $table->string('object_name', 100);
            $table->string('object_type', 100);
            $table->integer('element_category_id');
            $table->string('element_category_name', 100);
            $table->string('element_type_name', 100);
            $table->date('element_expired_date');
            $table->integer('notification_sent_id')->unsigned();
            $table->foreign('notification_sent_id')->references('id')->on('notification_sent');
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
        Schema::dropIfExists('notifications_sent_content');
    }
}
