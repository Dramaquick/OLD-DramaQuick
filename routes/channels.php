<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

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
    Log::info("Got channel joing with id: " . $user->id);    
    Log::info("Session id: " . $user->Session_Id);
    Log::info("Channel id: " . $id);
    Log::info("Session id === Channel id: " . ($user->Session_Id === $id));

    if($user->Session_Id === $id) {
        return $user;
    }
});

Broadcast::channel('result.session.{id}', function (User $user, int $id) {
    Log::info("Got channel joing with id: " . $user->id);    
    Log::info("Session id: " . $user->Session_Id);
    Log::info("Channel id: " . $id);
    Log::info("Session id === Channel id: " . ($user->Session_Id === $id));

    if($user->Session_Id === $id) {
        return $user;
    }
});