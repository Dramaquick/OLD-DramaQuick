<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DSession extends Model
{
    use HasFactory;

    @var string
    protected $table = 'd_sessions';
}
