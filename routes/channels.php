<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('session.{id}', function (User $user, int $id) {
    $status = User::find($user->id)->status;
    if ($status === 'ONLINE') {
        return $user->connectedToSession->Session_Id === $id;
    } else {
        return false;
    }
});