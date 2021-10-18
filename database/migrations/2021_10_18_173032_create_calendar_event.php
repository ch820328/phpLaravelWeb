<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_event', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('user_name');
            $table->string('event');
            $table->date('start_at');
            $table->date('end_at');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id']);
            $table->index(['user_name']);
            $table->index(['start_at']);
            $table->index(['end_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_event');
    }
}
