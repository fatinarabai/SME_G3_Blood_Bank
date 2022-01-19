<?php

namespace App\Http\Controllers;



use Illuminate\Foundation\Auth;
use Illuminate\Http\Request;
use App\Groups;
use App\User;
use App\Requests;
use App\AddressesState;


class GroupsController extends Controller
{


    public function index(){
    	$group = Groups::all();
    	$user = User::all();
    	$request = Requests::all();


    	return view('groups.index')->with('groups' , $group)
										 ->with('users' , $user)
    									 ->with('requests' , $request);
	}


	public function search(){

		//$user = User::OrderBy('id' ,'asc')->get();
		$user = User::where('role', "Donor")->latest()->paginate(20);
		$group = Groups::all();
		$request = Requests::all();
		$getStates = AddressesState::all();
		

		for($i=0; $i <count($getStates); $i++){
			$states[$i]["id"]=$getStates[$i]->id;
			$states[$i]["state"]=$getStates[$i]->state;
		
		}

		return view('groups.search')->with('groups' , $group)
			->with('users' , $user)
			->with('requests' , $request)
			->with('states', $states);
	}

	public function donor(Request $r){
    	$id = $r->groups_id;
		$address_id = $r->stateId;

		$user = User::where('groups_id' ,4)
		->join("addresses","users.addresses_id","addresses.id")
		->where("state_id", 'like', '%'.$address_id.'%')->get();
		$request = Requests::all();
		$group = Groups::all();

		$getStates = AddressesState::all();
	
		for($i=0; $i <count($getStates); $i++){
			$states[$i]["id"]=$getStates[$i]->id;
			$states[$i]["state"]=$getStates[$i]->state;
		}

		return view('groups.donor')->with('requests' , $request)
			->with('groups' , $group)
			->with('users' , $user)
			->with('states', $states);
    }
}
