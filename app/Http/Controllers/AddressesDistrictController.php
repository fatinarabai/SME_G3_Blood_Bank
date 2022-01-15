<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use App\AddressesDistrict;

class AddressesDistrictController extends Controller
{
    public function getDistrict($id){
            $data = AddressesDistrict::where('addresses_districts.state_id',$id)->get();

            for($i=0; $i<count($data);$i++){
                $district[$i]["id"] = $data[$i]->id;
                $district[$i]["district"] = $data[$i]->name;
            }

            return response()->json($district);
	}
}
