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
}
