<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DSession
 *
 * @property int $Session_Id
 * @property string $Session_Title
 * @property string $Session_Description
 * @property int $Session_MinUser
 * @property int $Session_MaxUser
 * @property float $Session_Speed
 * @property int $Owner_Id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DQuestion> $questions
 * @property-read int|null $questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DSessionTag> $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|DSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|DSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DSession whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DSession whereSessionDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DSession whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DSession whereSessionMaxUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DSession whereSessionMinUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DSession whereSessionSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DSession whereSessionTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DSession whereUpdatedAt($value)
 * @property-read \App\Models\User|null $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DQuestion> $questions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DSessionTag> $tags
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DQuestion> $questions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DSessionTag> $tags
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DQuestion> $questions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DSessionTag> $tags
 * @mixin \Eloquent
 */
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
        return $this->belongsTo(User::class, 'Owner_Id');
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
