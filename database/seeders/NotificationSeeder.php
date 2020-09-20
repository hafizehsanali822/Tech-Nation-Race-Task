<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notificaiton = new Notification();
		$notificaiton->title = 'Joined Member';
		$notificaiton->message = 'Huzaifa Joined Race 2';
	    //$notificaiton->user_id = 1; //display to all
        $notificaiton->save();

        $notificaiton = new Notification();
		$notificaiton->title = 'Race Winner';
		$notificaiton->message = 'Abdul Hadi is the winner of Race 2';
	    $notificaiton->user_id = 5; //visible to only winner
        $notificaiton->save();

        $notificaiton = new Notification();
		$notificaiton->title = 'New Race Created';
		$notificaiton->message = 'New Race Created=> Title: Race 10, Start: 10-10-2020, End Date:  10-11-2020  ';
	   // $notificaiton->user_id = 1;  //display to all
        $notificaiton->save();

        $notificaiton = new Notification();
		$notificaiton->title = 'Joined Member';
		$notificaiton->message = 'Danish Joined Race 4';
	    //$notificaiton->user_id = 1;  //display to all
        $notificaiton->save();

        $notificaiton = new Notification();
		$notificaiton->title = 'Joined Member';
		$notificaiton->message = 'Rihan Joined Race 3';
	    //$notificaiton->user_id = 1;  //display to all
        $notificaiton->save();
    }
}
