<?php

namespace App\Http\Controllers;
use App\Groups;
use App\User;
use App\Address;
use App\AddressesState;
use Auth;
use App\Camps;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Image;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function create_admin(){
        return view('admin.registeradmin');
    }

    public function store_admin()
    {
        $req = request();


        $this->validate($req, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'mobile' => 'required|numeric',
            'dob' => 'required|date|before:	-18 years'
        ]);

        $maps_url = 'https://' . 'maps.googleapis.com/' . 'maps/api/geocode/json' . '?address=' . urlencode($req->address);
        $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($req->address) . '&sensor=false');
        $geo = json_decode($geo, true); // Convert the JSON to an array

        if (isset($geo['status']) && ($geo['status'] == 'OK')) {
            $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
            $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude

            $file = $req->file('pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(300, 850)->save(public_path('images/' . $filename));

            $user =User::create([
                'name' => $req->name,
                'username' => $req->user_name,
                'email' => $req->email,
                'password' => Hash::make($req->password),
                'mobile' => $req->mobile,
                'gender' => $req->gender,
                'groups_id' => $req->groups_id,
                'dob' => Carbon::parse($req->dob),
                'latitude' => $latitude,
                'longitude' => $longitude,
                'address' => $req->address ,
                'citizenship' => $filename,
            ]);

            $user->admin = 1;
            $user->save();



        }
        Session::flash('success' , 'Admin registered successfully');

        return redirect()->route('forum.index');

    }

    public function index(){
		$user = Auth::user();

		if($user->is_verified($user->id)) {
            if ($user->admin) {
                $u = User::all();
                $g = Groups::all();
                return view('admin.index')->with('users', $u)->with('groups', $g);

                } else {
                return response('Unauthorized', 401);
            }
		} else {
            Session::flash('cancel', 'You are still not verified');
            return redirect()->route('forum.index');
        }
    }

	public function display(){
    	$camp = Camps::OrderBy('id' , 'asc')->get();
		$user = Auth::user();
        if($user->is_verified($user->id)) {
            if($user->admin) {
                return view('admin.display')->with('camps', $camp);

            } else {
                return response('Unauthorized', 401);
            }
        } else {
            Session::flash('cancel', 'You are still not verified');
            return redirect()->route('forum.index');
        }
	}

	public function edit($id){
    	$user = Auth::user();
            if($user->is_verified($user->id)) {

                if ($user->admin) {
                    $camp = Camps::where('id', $id)->first();
                    $getStates = AddressesState::all();
		

                    for($i=0; $i <count($getStates); $i++){
                        $states[$i]["id"]=$getStates[$i]->id;
                        $states[$i]["state"]=$getStates[$i]->state;
                    
                    }
                    return view('camps.edit', ['id', $id])->with(['camps' => $camp, 'states' => $states,]);
                } else {
                    return response('Unauthorized', 401);
                }
            } else {
                Session::flash('cancel' , 'You are still not verified');

                return redirect()->route('forum.index');
            }
    }

	public function update($id){

		$r = request();
		$this->validate($r , [
			'title' => 'required|max:30',
			'contents' => 'required|string|min:100' ,
            'street' =>'required', 
            'stateId' =>'required', 
            'districtId' =>'required', 
            'postcode' => 'required',
		]);

			$camp = Camps::find($id);
            $address = Address::find($camp->addresses_id);

            $address->street = $r->street;
            $address->state_id = $r->stateId;
            $address->district_id = $r->districtId;
            $address->postcode = $r->postcode;
            $address->save();

			$camp->contents = $r->contents;
			$camp->title = $r->title;
			$camp->camp_date = $r->camp_date;


			$camp->save();


		Session::flash('success', 'Camp updated successfully');

		return redirect()->route('camps.show');

	}

	public function destroy($id)
	{
		$camp = Camps::find($id);

		$camp->delete();

		Session::flash('success', 'Camp Has Been Deleted Successfully');

		return redirect()->route('camps.show');
	}

	public function show(){
		$camp = Camps::OrderBy('camp_date' ,'desc')->paginate(3);
		return view('camps.show')->with('camps' , $camp);
	}

    public function pic($id){
        $user = Auth::user();
            if($user->is_verified($user->id)) {

                if ($user->admin) {
                    $camp = Camps::where('id', $id)->first();
                    return view('camps.pic', ['id', $id])->with('camps', $camp);
                } else {
                    return response('Unauthorized', 401);
                }
            } else {
                Session::flash('cancel' , 'You are still not verified');

                return redirect()->route('forum.index');
            }
    }

    public function upload(Request $request, $id)
	{
		$file = $request->file('pic');
		$filename = time() . '.' . $file->getClientOriginalExtension();
		Image::make($file)->save(public_path('images/' . $filename));
        
        $camp = Camps::findOrFail($id);
		$camp->camp_pic = $filename;
		$camp->save($request->all());
        $user = Auth::user();
        if ($user->admin) {
            $camp = Camps::where('id', $id)->first();
            $getStates = AddressesState::all();


            for($i=0; $i <count($getStates); $i++){
                $states[$i]["id"]=$getStates[$i]->id;
                $states[$i]["state"]=$getStates[$i]->state;
            
            }
            return view('camps.edit', ['id', $id])->with(['camps' => $camp, 'states' => $states,]);
        } else {
            return response('Unauthorized', 401);
        }
		

	}

	public function create(){

        $getStates = AddressesState::all();
		

		for($i=0; $i <count($getStates); $i++){
			$states[$i]["id"]=$getStates[$i]->id;
			$states[$i]["state"]=$getStates[$i]->state;
		
		}

		return view('camps.create', [
			'states' => $states,
		]);
	}

	public function store(){
		$req = request();

		$this->validate($req, [
			'title' => 'required|max:30',
			'contents' => 'required|string|min:100' ,
            'street' => 'required',
            'stateId' => 'required',
            'districtId' => 'required',
            'postcode' => 'required',
		]);

		$file = $req->file('pic');
		$filename = time() . '.' . $file->getClientOriginalExtension();
		Image::make($file)->resize(300, 850)->save(public_path('images/' . $filename));

        $addresses_id = DB::table('addresses')->insertGetId([
            'street' => $req->street,
            'state_id'=>$req->stateId,
            'district_id'=>$req->districtId,
            'postcode'=>$req->postcode,
        ]);

		$camp = Camps::create([
			'title' => $req->title,
			'contents' => $req->contents ,
			'camp_date' => $req->camp_date ,
			'camp_pic' => $filename,
			'addresses_id' => $addresses_id,
		]);

		Session::flash('success' , 'Camp posted successfully');

		return redirect()->route('camps.show')->with('camps' , $camp);
	}

	public function make_admin($id){

		$ad = User::where('id' , $id)->first();

		$ad->admin = 1 ;

		$ad->save();



		Session::flash('success' , 'You are going');

		return redirect()->back();
    }

	public function remove_admin($id){

		$ad = User::where('id' , $id)->first();

		$ad->admin = 0 ;

		$ad->save();



		Session::flash('success' , 'You are going');

		return redirect()->back();
	}

	public function verify_index()
    {
        $user = Auth::user();
        if ($user->is_verified($user->id)) {
            if ($user->admin) {
                $u = User::where('verify', 'not verified')->get();
                $g = Groups::all();
                return view('admin.verifyindex')->with('users', $u)->with('groups', $g);

            } else {
                return response('Unauthorized', 401);
            }
        } else {
            Session::flash('cancel', 'You are still not verified');
            return redirect()->route('forum.index');
        }
    }

    public function verify_admin()
    {
        $user = Auth::user();
        if ($user->is_verified($user->id)) {
            if ($user->admin) {
                $u = User::where('verify', 'not verified')->get();
                $g = Groups::all();
                return view('admin.verifyadmin')->with('users', $u)->with('groups', $g);

            } else {
                return response('Unauthorized', 401);
            }
        } else {
            Session::flash('cancel', 'You are still not verified');
            return redirect()->route('forum.index');
        }
    }

	public function user_view($id){
    	$u = User::where('id' , $id)->first();
    	$g = Groups::all();

		return view('admin.verify')->with('user' , $u)->with('groups' , $g);


	}

	public function verified($id){

		$ad = User::where('id' , $id)->first();

		$ad->verify = 'verified' ;

		$ad->save();

		Session::flash('success' , 'User has been verified');

		return redirect()->back();
	}

}
