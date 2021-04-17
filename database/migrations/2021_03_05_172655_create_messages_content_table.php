<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages_content', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('object_id');
            $table->string('object_name', 100);
            $table->integer('object_type_id');
            $table->integer('element_category_id');
            $table->string('element_category_name', 100);
            $table->string('element_type_name', 100);
            $table->date('element_expired_date');
            $table->integer('element_expired_time_value')->nullable();
            $table->integer('sent_messages_id')->unsigned();
            $table->foreign('sent_messages_id')->references('id')->on('sent_messages');
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
        Schema::dropIfExists('messages_content');
    }
}
