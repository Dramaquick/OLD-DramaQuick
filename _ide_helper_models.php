<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\DAnswer
 *
 * @property int $Answer_Id
 * @property string $Answer_Values
 * @property int $Question_Id
 * @property int $Session_Id
 * @property int $User_Id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer whereAnswerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer whereAnswerValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DAnswer whereUserId($value)
 * @mixin \Eloquent
 */
	class DAnswer extends \Eloquent {}
}

namespace App\Models{
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
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DAnswer> $answers
 */
	class DQuestion extends \Eloquent {}
}

namespace App\Models{
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
 * @mixin \Eloquent
 * @property-read \App\Models\User|null $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DQuestion> $questions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DSessionTag> $tags
 */
	class DSession extends \Eloquent {}
}

namespace App\Models{
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
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DSession> $sessions
 */
	class DSessionTag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Link
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $url
 * @property string $title
 * @property int $user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Link newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Link query()
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereUserId($value)
 * @mixin \Eloquent
 */
	class Link extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $user_role
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Link> $links
 * @property-read int|null $links_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserRole($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Link> $links
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 */
	class User extends \Eloquent {}
}

