<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RaceUser;

class RaceUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $raceUser = new RaceUser();
		$raceUser->user_id = 2;
		$raceUser->race_id = 1;
        $raceUser->save();

        $raceUser = new RaceUser();
		$raceUser->user_id = 3;
		$raceUser->race_id = 2;
        $raceUser->save();

        $raceUser = new RaceUser();
		$raceUser->user_id = 4;
		$raceUser->race_id = 1;
        $raceUser->save();

        $raceUser = new RaceUser();
		$raceUser->user_id = 4;
		$raceUser->race_id = 4;
        $raceUser->save();

        $raceUser = new RaceUser();
		$raceUser->user_id = 2;
		$raceUser->race_id = 4;
        $raceUser->save();

        $raceUser = new RaceUser();
		$raceUser->user_id = 5;
		$raceUser->race_id = 4;
        $raceUser->save();
    }
}
