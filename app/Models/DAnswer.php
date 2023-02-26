<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAnswer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'd_answers';

    const $fillable = [
        'Answer_Values'
    ]

    protected $primaryKey = 'Session_Id_Question_Id_Answer_Id';
}
