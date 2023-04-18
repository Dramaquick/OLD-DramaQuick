<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DSessionTag
 *
 * @property int $Tag_Id
 * @property string $Tag_Name
 * @property string $Tag_Emoji
 * @property string $Tag_Color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DSession> $sessions
 * @property-read int|null $sessions_count
 * @method static \Illuminate\Database\Eloquent\Builder|DSessionTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DSessionTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DSessionTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|DSessionTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DSessionTag whereTagColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DSessionTag whereTagEmoji($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DSessionTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DSessionTag whereTagName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DSessionTag whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DSession> $sessions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DSession> $sessions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DSession> $sessions
 * @mixin \Eloquent
 */
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
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'Tag_Id';

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
