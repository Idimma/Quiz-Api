<?php

namespace App\database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('spellings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('word');
            $table->string('answer');
            $table->string('user');
            $table->boolean('is_right');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('spellings');
    }
};
