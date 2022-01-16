<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		App\User::create([
			'name' => 'Kabita Parajuli' ,
			'password' => bcrypt('admin') ,
			'email' => 'admin@gmail.com' ,
			'username' => 'admin',
			'gender' => 'Female',
			'dob' => Carbon::parse('1998-01-01'),
			'admin' => 1 ,
			'avatar' => 'avatar.png' ,
			'groups_id' => 6 ,
			'mobile' => 9821256117,
			'verify' => 'verified' ,
			'citizenship' => 'citizen2.jpg',
			'addresses_id' =>1,
		]);



		App\User::create([
			'name' => 'Prajjwal Poudel' ,
			'password' => bcrypt('prajjwal') ,
			'email' => 'iamprazol@gmail.com' ,
			'username' => 'iamprazol',
			'gender' => 'Male' ,
			'dob' => Carbon::parse('1997-01-01'),
			'avatar' => 'avatar.png',
			'groups_id' => 4 ,
			'mobile' => 9845690436,
			'verify' => 'not verified' ,
			'citizenship' => 'citizen1.jpg',
			'addresses_id' =>2,
		]);

		App\User::create([
			'name' => 'Anjaan Gaire' ,
			'password' => bcrypt('anjaan') ,
			'email' => 'anjaan@gmail.com' ,
			'username' => 'gaire',
			'gender' => 'Male' ,
			'dob' => Carbon::parse('1996-01-01'),
			'avatar' => 'avatar.png',
			'groups_id' => 8 ,
			'mobile' => 9847004480,
			'verify' => 'not verified' ,
			'citizenship' => 'citizen3.jpg',
			'addresses_id' =>3,

		]);

		App\User::create([
			'name' => 'Kushal Poudel' ,
			'password' => bcrypt('kushal') ,
			'email' => 'kushal@gmail.com' ,
			'username' => 'iamkushak',
			'gender' => 'Male' ,
			'dob' => Carbon::parse('1994-05-10'),
			'avatar' => 'avatar.png',
			'groups_id' => 4 ,
			'mobile' => 9845163257,
			'verify' => 'not verified' ,
			'citizenship' => 'citizen1.jpg',
			'addresses_id' =>4,
		]);


		App\User::create([
			'name' => 'Rashilla Lamichhane' ,
			'password' => bcrypt('racella') ,
			'email' => 'lcrasu127@gmail.com' ,
			'username' => 'Racella',
			'gender' => 'Female' ,
			'dob' => Carbon::parse('1998-10-10'),
			'avatar' => 'avatar.png',
			'groups_id' => 4 ,
			'mobile' => 9821256118,
			'verify' => 'not verified' ,
			'citizenship' => 'citizen2.jpg',
			'addresses_id' => 5,
		]);


		App\User::create([
			'name' => 'Uddhav Dhakal' ,
			'password' => bcrypt('uddhav') ,
			'email' => 'uddhav@gmail.com' ,
			'username' => 'uddhav',
			'gender' => 'Male' ,
			'dob' => Carbon::parse('1996-09-21'),
			'avatar' => 'avatar.png',
			'groups_id' => 7 ,
			'mobile' => 9845458129,
			'verify' => 'not verified' ,
			'citizenship' => 'citizen3.jpg',
			'addresses_id' =>6,

		]);

		App\User::create([
			'name' => 'Suyesh Pant' ,
			'password' => bcrypt('suyesh') ,
			'email' => 'suyesh@gmail.com' ,
			'username' => 'suyesh',
			'gender' => 'Male' ,
			'dob' => Carbon::parse('1998-11-21'),
			'avatar' => 'avatar.png',
			'groups_id' => 3 ,
			'mobile' => 9847004390,
			'verify' => 'not verified' ,
			'citizenship' => 'citizen2.jpg',
			'addresses_id' =>7,

		]);
	}

    }

