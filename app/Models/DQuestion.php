<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    protected $primaryKey = 'Session_Id_Question_Id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const $fillable = [
        'Question_Name',
        'Question_Description',
        'Question_Type',
        'Question_Duration'
    ]

    const $casts = [
        'Question_Duration' => 'integer'
    ]

    /**
     * Get the answers that belong to this question.
     */
    public function answers() { 
        return $this->hasMany(DAnswer::class, 'Session_Id_Question_Id');
    }

    public static function boot() {
        parent::boot();
  
        static::deleting(function($answer) {
          $answer->answers()->delete();
        });
    }
}
