<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Models\User;
use\App\Models\Race;
use Auth;
use Validator;
use App\Http\Controllers\NotificationController;

class MemberController extends Controller
{
   
    public function showMememberSection(Request $request)
    {
         return view('members.member-dashboard');    
    }

    public function showMemberLoginForm()
    {
        $success['messagge'] = 'Get Member Login form Successfully';
        $success['html'] = view('members.auth.login')->render();
        return response()->json(['success' => $success], 200);
    }

    public function showMemberRegistrationForm()
    {
        $success['messagge'] = 'Get Member Registration form Successfully';
        $success['html'] = view('members.auth.register')->render();
        return response()->json(['success' => $success], 200);
    }

    

    public function registerMember(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
                            'name' =>'required|string|max:255',
                            'email' =>'required|string|email|max:255|unique:users',
                            'password' => 'required|string|min:6|confirmed',
                        
                        ]);
       if ($validator->fails()) 
       {
            return response()->json(['error_message' => $validator->errors()], 401);
        }
        $inputs = $request->all();
        $inputs['password'] = bcrypt($inputs['password']);
        $user =  User::create($inputs);
        $races = Race::All() ;
        $token = $user->createToken('RaceAppKey')->accessToken;
        $success['token'] = $token;
        $success['html'] = view('members.index-races', compact('token', 'user', 'races' ))->render();
        return response()->json(['success' => $success], 200);
        //return redirect()->route('member.dashboard');
    }  

    public function loginMember(Request $request)
    {
        if(Auth::Attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'member']))
        {
            //Auth::login();
            $user = Auth::User() ;
            $races = Race::All() ;
            $token = $user->createToken('RaceAppKey')->accessToken;
            $success['user'] = $user;
            $success['token'] = $token;
            $success['html'] = view('members.index-races', compact('user', 'token','races' ))->render();
            return response()->json(['success' => $success], 200);

        }else  return response()->json(['error_message' => 'Username Or Password is Incorrect'], 401);

    }

    public function logoutMember(Request $request)
    {
        $request->user()->token()->revoke();
       // $cookie = Cookie::forget('_token');
       $success['message'] = 'Logout Successfully';
       $success['html'] = view('members.auth.login')->render();
        return response()->json(['success' => $success], 200);
        return response()->json(['success' => $success], 200);//->withCookie($cookie);
    }
    
    public function getAllRaces(Request $request)
    {
        $races = Race::All();
        $success['token'] = $request->bearerToken();
        $success['all_races'] = $races;
        
        return response()->json(['success' => $success], 200);
    }

    public function joinRace(Request $request)
    {
         $race = Race::find($request->race_id);
         $user = Auth::User();
         $checkJoined = $race->joinedMembers->contains($user->id);
         if(! $checkJoined )
         {
            $race->joinedMembers()->attach( Auth::user()->id);
            self::notify(Auth::user(), $race, 'joined');
            $races = Race::All();
            $token = $request->bearerToken();
            $success['token'] =  $token;
            $success['message'] = Auth::user()->name . ' Joind ' . $race->title .' Successfully';
            $success['html'] = view('members.index-races', compact('token','races', 'user' ))->render();
            return response()->json(['success' =>  $success], 200);
         }
         else  return response()->json(['success' => 'Already Joined ,'. Auth::user()->name . ' already Joind ' . $race->title .' Successfully'], 200);
       

    }

    public function disJoinRace(Request $request)
    {
        $race = Race::find($request->race_id);
        $user = Auth::user();
        $checkJoined = $race->joinedMembers->contains($user->id);
        if( $checkJoined )
        {
            $race->joinedMembers()->detach( Auth::user()->id);
            self::notify(Auth::user(), $race, 'disjoined');
           
            $races = Race::All() ;
            $token =$request->bearerToken();
           
            $success['token'] =  $token;
            $success['message'] =Auth::user()->name . ' DisJoind from ' . $race->title .' Successfully';
            $success['html'] = view('members.index-races', compact('token','races', 'user' ))->render();
            return response()->json(['success' => $success], 200);
        }
        else  return response()->json(['success' => 'You are Not Joined ' . $race->title . ' Yet!' ], 200);

    }

    public function notify($user, $race, $joinedStatus)
    {
        $NotificationController = new NotificationController();
      
        $notificationMessage = [
                                    "title" => 'Joined New Memmber',
                                    "body" =>  $user->name . ' '.$joinedStatus. ' '. $race->title ,
                                    "icon" => url('/logo.png')
                                 ];
        $NotificationController->sendPushNotification($notificationMessage);

    }
   
}
