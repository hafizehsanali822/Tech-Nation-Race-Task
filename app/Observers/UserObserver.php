<?php

namespace App\Observers;

use App\Models\User;
use App\Http\Controllers\NotificationController;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
         //  \Log::info('Race created Successfully');
         $NotificationController = new NotificationController();
      
         $notificationMessage = [
                                     "title" => 'New Memeber  Register',
                                     "body" =>  $user->name . " Register Successfuly!",
                                     "icon" => url('/logo.png')
                                  ];
         $NotificationController->sendPushNotification($notificationMessage);
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
