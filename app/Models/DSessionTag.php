<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DSessionTag extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'd_session_tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Tag_Name',
        'Tag_Emoji',
        'Tag_Color'
    ];

    /**
     * Get the sessions that have this tag.
     */
    public function sessions() { 
        return $this->belongsToMany(DSession::class, 'd_session_tags_links', 'Tag_Id', 'Session_Id'); 
    }
}
