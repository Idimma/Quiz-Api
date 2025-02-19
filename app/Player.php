<?php

namespace App;

use App\Events\PlayerUpdated;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Player
 *
 * @property int $id
 * @property string|null $user_id
 * @property string|null $name
 * @property array|null $questions
 * @property array|null $answers
 * @property array|null $given_answers
 * @property float $score
 * @property float $percent
 * @property int $no_questions
 * @property int $seconds_used
 * @property int $seconds_allocated
 * @property int $seconds_expected
 * @property array|null $seconds_spread
 * @property string|null $type
 * @property string|null $level
 * @property string|null $question_type
 * @property array|null $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Player newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Player newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Player query()
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereAnswers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereGivenAnswers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereNoQuestions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereQuestionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereQuestions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereSecondsAllocated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereSecondsExpected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereSecondsSpread($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereSecondsUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereUserId($value)
 * @mixin \Eloquent
 */
class Player extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'questions',
        'score',
        'percent',
        'seconds_used',
        'type',
        'level',
        'question_type',
    ];

    protected $casts = [
        'questions' => 'array',  // Convert longText to array (assuming it's JSON)
        'score' => 'float',
        'percent' => 'float',
        'seconds_used' => 'float',
    ];

    protected $appends = ['marks', 'mark', 'scores'];

    protected static function booted()
    {
        static::created(function ($player) {
            broadcast(new PlayerUpdated($player));
        });
    }

    public function getMarksAttribute()
    {
        return array_map(fn($q) => $q['mark'], $this->questions);
    }

    public function getScoresAttribute()
    {
        return array_map(fn($q) => $q['score'], $this->questions);
    }
    public function getMarkAttribute()
    {
        return array_sum(array_map(fn($q) => $q['mark'], $this->questions));
    }

}
