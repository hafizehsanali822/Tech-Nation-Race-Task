<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(10)->create();
        $admin = new User();
		$admin->id = 1;
		$admin->name = 'Admin 1';
		$admin->email = 'admin1@email.com';
		$admin->password = bcrypt('123456');
		$admin->role = 'admin';
        $admin->save();
        
        $member1 = new User();
        $member1->id = 2;
		$member1->name = 'Danish';
		$member1->email = 'danish@email.com';
		$member1->password = bcrypt('123456');
		$member1->role = 'member';
        $member1->save();
        
        $member2 = new User();
		$member2->id = 3;
		$member2->name = 'Huzaifa';
		$member2->email = 'huzaifa@email.com';
		$member2->password = bcrypt('123456');
		$member2->role = 'member';
        $member2->save();
        
        $member3 = new User();
		$member3->id = 4;
		$member3->name = 'Rehan';
		$member3->email = 'rehan@email.com';
		$member3->password = bcrypt('123456');
		$member3->role = 'member';
        $member3->save();
        
        $member4 = new User();
		$member4->id = 5;
		$member4->name = 'Abdul Hadi';
		$member4->email = 'abdul_hadi@email.com';
		$member4->password = bcrypt('123456');
		$member4->role = 'member';
		$member4->save();
    }
}
