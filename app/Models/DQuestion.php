<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DQuestion
 *
 * @property int $Question_Id
 * @property string $Question_Name
 * @property string $Question_Description
 * @property string $Question_Type
 * @property int $Question_Duration
 * @property int $Session_Id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DAnswer> $answers
 * @property-read int|null $answers_count
 * @method static \Illuminate\Database\Eloquent\Builder|DQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|DQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DQuestion whereQuestionDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DQuestion whereQuestionDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DQuestion whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DQuestion whereQuestionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DQuestion whereQuestionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DQuestion whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DQuestion whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DAnswer> $answers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DAnswer> $answers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DAnswer> $answers
 * @mixin \Eloquent
 */
class DQuestion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'd_questions';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'Question_Id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Question_Title',
        'Question_Description',
        'Question_Type',
        'Question_Options',
        'Session_Id'
    ];

    /**
     * Get the answers that belong to this question.
     */
    public function answers() {
        return $this->hasMany(DAnswer::class)->where([
            'Question_Id' => $this->Question_Id,
            'Session_Id' => $this->Session_Id
        ]);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($answer) {
          $answer->answers()->delete();
        });
    }
}
