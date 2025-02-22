<?php

namespace App;

//use App\Events\PlayerUpdated;
use Illuminate\Database\Eloquent\Builder;
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
 * @method static Builder|Player newModelQuery()
 * @method static Builder|Player newQuery()
 * @method static Builder|Player query()
 * @method static Builder|Player whereAnswers($value)
 * @method static Builder|Player whereCreatedAt($value)
 * @method static Builder|Player whereGivenAnswers($value)
 * @method static Builder|Player whereId($value)
 * @method static Builder|Player whereLevel($value)
 * @method static Builder|Player whereMeta($value)
 * @method static Builder|Player whereName($value)
 * @method static Builder|Player whereNoQuestions($value)
 * @method static Builder|Player wherePercent($value)
 * @method static Builder|Player whereQuestionType($value)
 * @method static Builder|Player whereQuestions($value)
 * @method static Builder|Player whereScore($value)
 * @method static Builder|Player whereSecondsAllocated($value)
 * @method static Builder|Player whereSecondsExpected($value)
 * @method static Builder|Player whereSecondsSpread($value)
 * @method static Builder|Player whereSecondsUsed($value)
 * @method static Builder|Player whereType($value)
 * @method static Builder|Player whereUpdatedAt($value)
 * @method static Builder|Player whereUserId($value)
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
        'ai_marked',
    ];

    protected $casts = [
        'questions' => 'array',  // Convert longText to array (assuming it's JSON)
        'score' => 'float',
        'percent' => 'float',
        'seconds_used' => 'float',
        'ai_marked' => 'boolean',
    ];

    protected $appends = ['marks', 'mark', 'scores'];

    protected static function booted()
    {
//        static::created(function ($player) {
//            broadcast(new PlayerUpdated($player));
//        });
//        static::updated(function ($player) {
//            broadcast(new PlayerUpdated($player));
//        });
    }

    public function getMarksAttribute()
    {
        return array_map(fn($q) => $q['mark']??0, $this->questions ?? []);
    }

    public function getScoresAttribute()
    {
        return array_map(fn($q) => $q['score']??0, $this->questions ?? []);
    }

    public function getMarkAttribute()
    {
        return array_sum(array_map(fn($q) => $q['mark']??0, $this->questions ?? []));
    }

}
