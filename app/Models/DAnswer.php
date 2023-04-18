<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DAnswer
 *
 * @property int $Answer_Id
 * @property string $Answer_Values
 * @property int $Question_Id
 * @property int $Session_Id
 * @property int $User_Id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer whereAnswerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer whereAnswerValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer whereUserId($value)
 * @mixin \Eloquent
 */
class DAnswer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'd_answers';

    protected $fillable = [
        'Answer_Values'
    ];

    protected $primaryKey = 'Session_Id_Question_Id_Answer_Id';
}
