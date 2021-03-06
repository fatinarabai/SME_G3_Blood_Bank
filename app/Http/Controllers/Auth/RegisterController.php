<?php

namespace App\Http\Controllers\Auth;

use App\Address;
use App\AddressesState;
use App\Requests;
use App\User;
use App\Http\Controllers\Controller;
use http\Env\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Image;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/forum';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
			'mobile' => 'required|numeric',
			'dob' => 'required|date|before:	-18 years',
			'street' => 'required',
			'stateId'=> 'required',
			'districtId'=> 'required',
			'postcode' =>'required',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array $data
	 * @return \App\User
	 */
	protected function create(array $data )
    {
        // $maps_url = 'https://' . 'maps.googleapis.com/' . 'maps/api/geocode/json' . '?address=' . urlencode($data['address']);
        // $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($data['address']) . '&sensor=false');
        // $geo = json_decode($geo, true); // Convert the JSON to an array

        // if (isset($geo['status']) && ($geo['status'] == 'OK')) {
            // $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
            // $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude

            $req = request();
            $file = $req->file('pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(300, 850)->save(public_path('images/' . $filename));

			$addresses_id = DB::table('addresses')->insertGetId([
				'street' => $data['street'],
				'state_id'=>$data['stateId'],
				'district_id'=>$data['districtId'],
				'postcode'=>$data['postcode'],
			]);

            return User::create([
                'name' => $data['name'],
                'username' => $data['user_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'mobile' => $data['mobile'],
                'gender' => $data['gender'],
                'groups_id' => $data['groups_id'],
                'dob' => Carbon::parse($data['dob']),
                'latitude' => 28.2613485,
                'longitude' => 83.9721112,
                'addresses_id' => $addresses_id,
                'citizenship' => $filename

            ]);
        // }
    }

	public function registerPage(){
		$getStates = AddressesState::all();
		

		for($i=0; $i <count($getStates); $i++){
			$states[$i]["id"]=$getStates[$i]->id;
			$states[$i]["state"]=$getStates[$i]->state;
		
		}

		// return $response =[
		// 	'states' => $states,
		// ];
		return view('auth.register', [
			'states' => $states,
		]);
		// return view('auth.register')->with('states' , $states);
		// return view('auth.register');
	}
}

