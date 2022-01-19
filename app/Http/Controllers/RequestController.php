<?php

namespace App\Http\Controllers;


use App\Groups;
use App\Requests;
use App\Available;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use App\AddressesState;
use App\Address;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function show($id) {

		$request = Requests::where('id' , $id)->get();
		$group = Groups::all();
		$user = User::all();
		$available = Available::all();

		return view('request.show')->with('requests' , $request)
										 ->with('groups' , $group)
										 ->with('users' , $user)
										 ->with('availables' , $available);
    }

	public function create() {

    	$id = Auth::id();

    	$group = Groups::all();
    	$user = User::where('id',$id)->first();
		$getStates = AddressesState::all();
		

		for($i=0; $i <count($getStates); $i++){
			$states[$i]["id"]=$getStates[$i]->id;
			$states[$i]["state"]=$getStates[$i]->state;
		
		}

    	if($user->is_verified($user->id)) {
			
			return view('request.create')->with(['groups' => $group, 'states'=>$states]);
		} else {
			Session::flash('cancel' , 'You are still not verified');

			return redirect()->route('forum.index');
    		}
	}

	public function store(){
    	$r = request();
		$this->validate($r ,[
			'contents' => 'required|string|min:30' ,
			'required_till' => 'required|date|after:yesterday'
		]);

		$addresses_id = DB::table('addresses')->insertGetId([
            'street' => $r->street,
            'state_id'=>$r->stateId,
            'district_id'=>$r->districtId,
            'postcode'=>$r->postcode,
        ]);

		$req = Requests::create([
			'contents' => $r->contents,
			'user_id' => Auth::id(),
			'groups_id' => $r->groups_id,
			'required_till' => $r->required_till,
			'addresses_id' => $addresses_id,
		]);
			$donors = User::where('id' , '!=' , Auth::id())->get();
			Notification::send($donors , new \App\Notifications\NewRequestAdded($req));

    	Session::flash('success' , 'Request posted successfully');
    	return redirect()->route('forum.show' , ['id' => $r->groups_id]);
	}

	public function  edit($id){

    	$request = Requests::where('id' , $id)->first();
		$getStates = AddressesState::all();
		

		for($i=0; $i <count($getStates); $i++){
			$states[$i]["id"]=$getStates[$i]->id;
			$states[$i]["state"]=$getStates[$i]->state;
		
		}

    	return view('request.edit')->with(['requests' => $request, 'states'=>$states]);
	}

	public function update($id){

    	$r = request();
    	$this->validate($r , [
    		'contents' => 'required|string|min:30',
			'required_till' => 'required|date|after:yesterday'

		]);

			$req = Requests::find($id);

			$address = Address::find($req->addresses_id);


			$address->street = $r->street;
            $address->state_id = $r->stateId;
            $address->district_id = $r->districtId;
            $address->postcode = $r->postcode;
            $address->save();

		
			$req->contents = $r->contents;
			$req->required_till = $r->required_till;
			$req->save();

			$donors = User::where('groups_id' , $r->groups_id)->where('id' , '!=' ,Auth::id())->get();
			Notification::send($donors , new \App\Notifications\NewRequestAdded($req));

			$requests = Requests::where('id' , $id)->get();
			$group = Groups::all();
			$user = User::all();
			$available = Available::all();

			return view('request.show')->with('requests' , $requests)
										 ->with('groups' , $group)
										 ->with('users' , $user)
										 ->with('availables' , $available);
	
			// return redirect()->route('forum.show', ['id' => $r->groups_id]);

	}

	public function available($id){

    	$uid = Auth::id();
		$user = User::where('id' , $uid)->first();

		if($user->is_verified($uid)) {
			Available::create([
				'requests_id' => $id,
				'user_id' => Auth::id()
			]);


			Session::flash('success', 'You are going');

			return redirect()->back();
		} else {
			Session::flash('cancel' , 'You are still not verified');

			return redirect()->route('forum.index');
		}
	}

	public  function unavailable($id){

    	$uid = Auth::id();
		$user = User::where('id' , $uid)->first();


		if($user->is_verified($uid)) {

			$go = Available::where('requests_id', $id)->where('user_id', Auth::id())->first();

			$go->delete();

			Session::flash('cancel', 'You are not going');

			return redirect()->back();
		} else {
			Session::flash('cancel' , 'You are still not verified');

			return redirect()->route('forum.index');
		}

	}

	public static function closest($lat, $lng, $max_distance = 10, $max_locations = 10, $units = 'miles')
	{
		/*
		 *  Allow for changing of units of measurement
		 */
		switch ( $units ) {
			default:
			case 'miles':
				$gr_circle_radius = 3959;
				break;
			case 'kilometers':
				$gr_circle_radius = 6371;
				break;
		}
		$distance_select = sprintf(
			"*, ( %d * acos( cos( radians(%s) ) " .
			" * cos( radians( latitude ) ) " .
			" * cos( radians( longitude ) - radians(%s) ) " .
			" + sin( radians(%s) ) * sin( radians( latitude ) ) " .
			") " .
			") " .
			"AS distance",
			$gr_circle_radius,
			$lat,
			$lng,
			$lat
		);


		return  User::selectraw($distance_select)
			->having( 'distance', '<', $max_distance )
			->take( $max_locations )
			->orderBy( 'distance', 'ASC' )
			->get();
	}

}
