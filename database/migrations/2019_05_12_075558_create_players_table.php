<?php

namespace App\database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('players');
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->longText('questions')->nullable();
            $table->longText('answers')->nullable();
            $table->string('score')->nullable();
            $table->string('class')->nullable();
            $table->string('zone')->nullable();
            $table->text('time')->nullable();
            $table->text('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('players');
    }
};
