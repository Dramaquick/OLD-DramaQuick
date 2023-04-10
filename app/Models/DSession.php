<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DSession extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'd_sessions';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'Session_Id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Session_Title',
        'Session_Description',
        'Session_MinUser',
        'Session_MaxUser',
        'Session_Speed',
        'Owner_Id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'Session_MinUser' => 'integer',
        'Session_MaxUser' => 'integer',
        'Session_Speed' => 'float'
    ];

    /**
     * Get the owner of this session.
     */
    public function owner() {
        return $this->belongsTo(DUser::class, 'Owner_Id');
    }

    /**
     * Get the questions that belong to this session.
     */
    public function questions() {
        return $this->hasMany(DQuestion::class, 'Session_Id');
    }

    /**
     * Get the tags that belong to this session.
     */
    public function tags() {
        return $this->belongsToMany(DSessionTag::class, 'd_session_tags_links', 'Session_Id', 'Tag_Id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($question) {
          $question->questions()->delete();
        });
    }
}
