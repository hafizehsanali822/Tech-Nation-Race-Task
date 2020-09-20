<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Models\User;
use\App\Models\Race;
use\App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Http\Controllers\NotificationController;

class AdminController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //dd(\Request::is('admin.index.users')) ;
       $races = Race::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.index_race', compact('races'));
    }

    public function indexUsers(Request $request)
    {
       $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.index-users', compact('users'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateRaceForm()
    {
        return view('admin.create_race');
    }

  
    public function storeRace(Request $request)
    {
        $validatedData = $request->validate([
                                                'title' => 'required|unique:Races',
                                                'start_date' =>  'required|date|after:yesterday', 
                                               'end_date' => 'required|date|after:start_date',
                                                'image' => 'required| image | max:2048',
                                            ]);
                                            dd('a');
        $uniqueimageName = time().'-'.$request->file('image')->getClientOriginalName();
        $request->image->storeAs('/public', $uniqueimageName);

        $race = new Race();
        $race->title =  $request->title;
        $race->start_date =  $request->start_date;
        $race->end_date =  $request->end_date;
        $race->image =  Storage::url($uniqueimageName);
        $race->save();

        return back()->with(['success_message' => 'New race created Successfully!']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showEditRaceForm($id)
    {
        $race = Race::find($id);
        
        if($race == null)
           return back()->with(['errors' => 'Race not Found']);
        return view('admin.edit-race' , compact('race'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRace(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'start_date' =>  'required|date|after:yesterday', 
            'end_date' => 'required|date|after:start_date',
            'image' => 'required| image | max:2048',
        ]);
        $uniqueimageName = time().'-'.$request->file('image')->getClientOriginalName();
        $request->image->storeAs('/public', $uniqueimageName);

        $race = Race::find($request->id);
        $race->title =  $request->title;
        $race->start_date =  $request->start_date;
        $race->end_date =  $request->end_date;
        $race->image =  Storage::url($uniqueimageName);
        $race->save();

        return back()->with(['success_message' => 'Race Updated Successfully!']);
       
    }

    public function deleteRace(Request $request)
    {
        $result = Race::where('id', $request->race_id)->delete();
        if($result)
            return back()->with(['success_message' => 'Race Deleted Successfully!']);
        else return back()->with(['error_message' => 'Something went wrong!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRaceWinnerForm()
    {
        $races = Race::with('joinedMembers')
                 ->has('joinedMembers')  // races have at least one member to join
                 ->doesnthave('winnerMemeber') // Not already assigned winner
                 ->get();
        return view('admin.select-winner', compact('races'));
    }

    
    
    public function annouceRaceWinner(Request $request)
    {
        $race = Race::find($request->races_select);
        $race->winner_id = $request->members_select;
        $race->save();

        return back()->with(['success_message' => 'Assigned winner member to race Successfully!']);
    }

    public function showAdminNotifications()
    {
         $notifications = Notification::orderBy('created_at', 'desc')->paginate(15);
         return view('admin.show-notification', compact('notifications'));
    }

}
