<?php

namespace App\database\migrations;

use App\Spelling;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::dropIfExists('spellings');
        Schema::create('spellings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('word');
            $table->string('type')->nullable();
            $table->string('level')->nullable();
            $table->longText('audio')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('spellings');
    }
};
