<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use App\Models\Notification;


Broadcast::channel('notifications', function (User $user) {
    return true;
});
