<?php

namespace App\database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->float('score', 8)->default(0);
            $table->float('percent', 8)->default(0);
            $table->float('seconds_used')->default(0);
            $table->string('type')->nullable();
            $table->string('level')->nullable();
            $table->string('question_type')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('players');
    }
};
