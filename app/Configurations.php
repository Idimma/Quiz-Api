<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Configurations
 *
 * @property int $id
 * @property string $instructions
 * @property string $age_group
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Configurations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Configurations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Configurations query()
 * @method static \Illuminate\Database\Eloquent\Builder|Configurations whereAgeGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configurations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configurations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configurations whereInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configurations whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Configurations extends Model
{
    protected $table = 'configs';
}
