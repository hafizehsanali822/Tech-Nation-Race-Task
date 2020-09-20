<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Race;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Race::factory(10)->create();
        $race1 = new Race();
		$race1->id = 1;
		$race1->title = 'Race 1';
		$race1->image = 'race_1.png';
		$race1->start_date = '2020-09-18';
		$race1->end_date = '2020-10-18';
        $race1->save();

        $race2 = new Race();
		$race2->id = 2;
		$race2->title = 'Race 2';
		$race2->image = 'race_2.png';
		$race2->start_date = '2020-09-20';
		$race2->end_date = '2020-10-20';
		$race2->winner_id = 3;
        $race2->save();

        
        $race3 = new Race();
		$race3->id = 3;
		$race3->title = 'Race 3';
		$race3->image = 'race_3.png';
		$race3->start_date = '2020-09-22';
		$race3->end_date = '2020-10-22';
        $race3->save();

        $race4 = new Race();
		$race4->id = 4;
		$race4->title = 'Race 4';
		$race4->image = 'race_4.png';
		$race4->start_date = '2020-09-24';
		$race4->end_date = '2020-10-24';
		$race4->winner_id = 5;
        $race4->save();

        $race5 = new Race();
        $race5->id = 5;
        $race5->title = 'Race 5';
		$race5->image = 'race_5.png';
		$race5->start_date = '2020-09-26';
		$race5->end_date = '2020-10-26';
		$race5->save();
		
		//Assign races to Members
		$race1->joinedMembers()->attach(2);
		$race2->joinedMembers()->attach(4);
		$race2->joinedMembers()->attach(3);
		$race4->joinedMembers()->attach(4);
		$race4->joinedMembers()->attach(2);
		

    }
}
