<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

/**
 * App\Spelling
 *
 * @property int $id
 * @property string $word
 * @property string|null $type
 * @property string|null $level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Spelling newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Spelling newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Spelling query()
 * @method static \Illuminate\Database\Eloquent\Builder|Spelling whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spelling whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spelling whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spelling whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spelling whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spelling whereWord($value)
 * @mixin \Eloquent
 */
class Spelling extends Model
{
    protected $fillable = ['word', 'type', 'level', 'audio'];
    protected $hidden = ['created_at', 'updated_at', 'type', 'level',];

    public function fixAudio()
    {
        $apiKey = env('GOOGLE_TTS_API_KEY');
        $url = "https://texttospeech.googleapis.com/v1/text:synthesize?key={$apiKey}";
        $word = $this->word;
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
        $audio = '';
        if (isset($data['audioContent'])) $audio = $data['audioContent'];

        $this->audio = $audio;
        $this->save();
    }
}
