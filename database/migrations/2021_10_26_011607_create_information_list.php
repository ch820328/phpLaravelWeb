<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page');
            $table->string('tab');
            $table->string('type');
            $table->string('name');
            $table->longText('url');
            $table->json('note');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['page']);
            $table->index(['type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('information_list');
    }
}
