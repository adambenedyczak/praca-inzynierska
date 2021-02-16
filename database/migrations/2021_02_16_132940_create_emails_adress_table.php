<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsAdressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails_adress', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('email')->unique();
            $table->boolean('enable_send')->default('1');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('notification_rule_id')->unsigned();
            $table->foreign('notification_rule_id')->references('id')->on('notifications_rules');
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
        Schema::dropIfExists('emails_adress');
    }
}
