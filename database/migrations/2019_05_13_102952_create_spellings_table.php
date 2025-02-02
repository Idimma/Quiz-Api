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
        $spellings = [
            // Level 1 - Simple Words
            ['word' => 'Adam', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Eve', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Noah', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Moses', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Jesus', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Mary', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Joseph', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Bible', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Faith', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Cross', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Sin', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Grace', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Angel', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Heaven', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Church', 'level' => 'Level 1', 'type' => 'Bible'],
            ['word' => 'Amen', 'level' => 'Level 1', 'type' => 'Bible'],

            // Level 2 - Medium Words
            ['word' => 'Abraham', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Isaac', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Jacob', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Exodus', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Bethlehem', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Nazareth', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Zion', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Galilee', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Covenant', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Apostle', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Sabbath', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Disciple', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Prophet', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Parable', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Psalms', 'level' => 'Level 2', 'type' => 'Bible'],
            ['word' => 'Miracle', 'level' => 'Level 2', 'type' => 'Bible'],

            // Level 3 - Difficult Words
            ['word' => 'Leviticus', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Deuteronomy', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Ecclesiastes', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Philippians', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Colossians', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Thessalonians', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Corinthians', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Ephesians', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Lamentations', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Beatitudes', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Revelation', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Pentecost', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Jericho', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Gethsemane', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Galatians', 'level' => 'Level 3', 'type' => 'Bible'],
            ['word' => 'Tabernacle', 'level' => 'Level 3', 'type' => 'Bible'],

            // Level 4 - Advanced Words
            ['word' => 'Melchizedek', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Nehemiah', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Zechariah', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Habakkuk', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Obadiah', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Haggai', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Nineveh', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Capernaum', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Sanhedrin', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Pharisee', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Sadducee', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Seraphim', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Cherubim', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Hallelujah', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Armageddon', 'level' => 'Level 4', 'type' => 'Bible'],
            ['word' => 'Eschatology', 'level' => 'Level 4', 'type' => 'Bible'],
        ];
        $apiKey = env('GOOGLE_TTS_API_KEY');
        foreach ($spellings as $spelling) {
            $url = "https://texttospeech.googleapis.com/v1/text:synthesize?key={$apiKey}";
            $word = $spelling['word'];
            $response = Http::post($url, [
                'input' => ['text' => "Spell " . $word],
                'voice' => [
                    'languageCode' => 'en-AU',
                    'name' => 'en-AU-Polyglot-1',
                    'ssmlGender' => 'MALE'
                ],
                'audioConfig' => ['audioEncoding' => 'MP3']
            ]);
            $data = $response->json();
            if (!isset($data['audioContent'])) continue;
            $spelling['audio'] = $data['audioContent'];
            Spelling::updateOrCreate($spelling, $spelling);
        }


    }

    public function down()
    {
        Schema::dropIfExists('spellings');
    }
};
