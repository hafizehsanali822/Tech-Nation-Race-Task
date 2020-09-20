<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Models\User;
use\App\Models\Race;
use\App\Models\Notification;
use Auth;

class NotificationController extends Controller
{
    protected $serverKey;
 
    public function __construct()
    {
        $this->serverKey = config('app.firebase_server_key');
    }

    public function saveDeviceToken(Request $request)
    {
        $user = User::find($request->user_id);
        $user->fcm_token = $request->fcm_token;
        $user->save();
        if($user)
        {   
            return response()->json([ 'message' => 'User token updated' ]); 
        }
        return response()->json([ 'message' => 'Error!'  ]);
    }

    public function sendPushNotification ($notificationMessage, Request $request=null)
    {
        if($notificationMessage['title'] == 'New Memeber  Register')
          $users = User::where('fcm_token' , '<>', null)->where('role', 'admin')->get();
        else  $users = User::where('fcm_token' , '<>', null)->get();
  
         if(count($users) != null)
         {
            foreach ($users as $key => $user) 
            {
                $data = [
                            "to" => $user->fcm_token,
                            "notification" =>$notificationMessage
                        ];
                $dataString = json_encode($data);

                $headers = [
                                'Authorization: key=' . $this->serverKey,
                                'Content-Type: application/json',
                            ];
                // Optional step, Store noty to db , if user wants to check notification later
                $notification = new Notification();
                $notification->title = $notificationMessage['title'];
                $notification->message = $notificationMessage['body'];
                $notification->save();

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            
                curl_exec($ch);
            }

         }

    }

   


}
