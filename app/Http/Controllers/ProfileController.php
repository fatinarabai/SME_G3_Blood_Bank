<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Address;
use App\AddressesState;
use Carbon\Carbon;
use Session;
use Image;



class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index' );
    }



    public function editProfile()
    {
		$getStates = AddressesState::all();
		

		for($i=0; $i <count($getStates); $i++){
			$states[$i]["id"]=$getStates[$i]->id;
			$states[$i]["state"]=$getStates[$i]->state;
		
		}
    	$user = User::where('id' , Auth::id())->with("Address.AddressesState","Address.AddressesDistrict")->first();

        return view('profile.editProfile')->with([
			'u' => $user,
		'states'=>$states,]);
    }



    public function pic()
    {
		$user = User::where('id' , Auth::id())->first();
		return view('profile.pic')->with('u' , $user);
    }



    public function upload(Request $request)
	{
		$file = $request->file('pic');
		$filename = time() . '.' . $file->getClientOriginalExtension();
		Image::make($file)->resize(300, 300)->save(public_path('avatars/' . $filename));
		$user = Auth::user();
		$user->avatar = $filename;
		$user->save();

		return view('profile.index', array('user' => Auth::user()) );


	}


    public function update(Request $request) {
		
    	$this->validate($request,[
			'email' => 'required|string|email|max:255',
			'user_name' => 'required|string',
			'mobile' => 'required|numeric',
			'role' => 'required|string',
			'dob' => 'required|date|before: 18 years',
			'street' => 'required',
			'stateId'=>'required',
			'districtId'=>'required',
			'postcode'=>'required',
		]);

		$id = Auth::id();
		$user = User::find($id);

		$address = Address::find($user->addresses_id);
		$address->street = $request->street;
		$address->state_id = $request->stateId;
		$address->district_id = $request->districtId;
		$address->postcode = $request->postcode;
		$address->save();

		$user->email = $request->email;
		$user->username = $request->user_name;
		$user->mobile = $request->mobile;
		$user->dob = Carbon::parse(request()->dob);
		$user->role = $request->role;
		$user->save();
		

		Session::flash('success' , 'Request updated successfully');
		return redirect()->route('profile.index');
    }
}
