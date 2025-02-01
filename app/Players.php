<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Players
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
 * @method static \Illuminate\Database\Eloquent\Builder|Players newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Players newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Players query()
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereAnswers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereGivenAnswers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereNoQuestions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereQuestionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereQuestions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereSecondsAllocated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereSecondsExpected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereSecondsSpread($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereSecondsUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Players whereUserId($value)
 * @mixin \Eloquent
 */
class Players extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'questions',
        'answers',
        'given_answers',
        'score',
        'percent',
        'no_questions',
        'seconds_used',
        'seconds_allocated',
        'seconds_expected',
        'seconds_spread',
        'type',
        'level',
        'question_type',
        'meta',
    ];
    protected $casts = [
        'questions' => 'array',
        'answers' => 'array',
        'meta' => 'array',
        'given_answers' => 'array',
        'seconds_spread' => 'array',
    ];
}
