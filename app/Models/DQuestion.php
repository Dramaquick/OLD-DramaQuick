<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DQuestion extends Model
{
    use HasFactory;

    @var string
    protected $table = 'd_questions';
}
