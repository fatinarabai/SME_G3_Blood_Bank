<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		App\Address::create([
			'street' => "Jalan 1",
			'state_id'=> 1,
			'district_id'=>1,
			'postcode'=>"45683",
		]);



		App\Address::create([
			'street' => "Jalan 2",
			'state_id'=> 1,
			'district_id'=>1,
			'postcode'=>"45683",
		]);

		App\Address::create([
			'street' => "Jalan 3",
			'state_id'=> 1,
			'district_id'=>1,
			'postcode'=>"45683",
		]);

		App\Address::create([
			'street' => "Jalan 4",
			'state_id'=> 1,
			'district_id'=>1,
			'postcode'=>"45683",
		]);

		App\Address::create([
			'street' => "Jalan 5",
			'state_id'=> 1,
			'district_id'=>1,
			'postcode'=>"45683",
		]);

		App\Address::create([
			'street' => "Jalan 6",
			'state_id'=> 1,
			'district_id'=>1,
			'postcode'=>"45683",
		]);

		App\Address::create([
			'street' => "Jalan 7",
			'state_id'=> 1,
			'district_id'=>1,
			'postcode'=>"45683",
		]);

		App\Address::create([
			'street' => "Jalan 8",
			'state_id'=> 1,
			'district_id'=>1,
			'postcode'=>"45683",
		]);

		App\Address::create([
			'street' => "Jalan 8",
			'state_id'=> 1,
			'district_id'=>1,
			'postcode'=>"45683",
		]);

		App\Address::create([
			'street' => "Jalan 8",
			'state_id'=> 1,
			'district_id'=>1,
			'postcode'=>"45683",
		]);
	}
}