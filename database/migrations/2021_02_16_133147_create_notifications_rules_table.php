<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_rules', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->integer('parts_notifications')->value('0');
            $table->integer('overviews_notifications')->value('0');
            $table->integer('insurances_notifications')->value('0');
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
        Schema::dropIfExists('notifications_rules');
    }
}
