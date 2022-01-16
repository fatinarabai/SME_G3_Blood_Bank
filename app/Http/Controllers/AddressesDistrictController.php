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

    public function updateDistrictCovidZone(){

        // Configure the MoH-Malaysia/covid19-public's GitHub csv url.
        $url = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/clusters.csv";

        // Get the csv content & explode by line.
        $response = file_get_contents($url);

        // Explode the content by line.
        $rows = explode("\n", $response);

        $data = [];

        // Save result into variable (per line).
        foreach ($rows as $row) {
            $data[] = str_getcsv($row);
        }

        // Remove first & last line.
        array_shift($data);
        array_pop($data);

        $clusters = [];

        // Collect all clusters available in clusters.csv
        for ($i = 0; $i < count($data); $i++) {
            array_push($clusters, $data[$i][0]);
        }
        
        $simplified_clusters = [];

        // Rearrange.
        foreach ($clusters as $cluster) {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i][0] == $cluster && $data[$i][6] == 'active') { //filter out ended cluster
                    $simplified_clusters[$cluster]['district'] = (!empty($data[$i][2]) ? $data[$i][2] : '0');
                    $simplified_clusters[$cluster]['cases_active'] = (!empty($data[$i][9]) ? $data[$i][9] : '0');
                }
            }
        }

        // Get list of district only
        $districtsList = [];

        foreach($simplified_clusters as $cluster) {
            //separate if a cluster has multiple district
            $str_arr = explode (", ", $cluster['district']);

            foreach($str_arr as $str){
                if(!in_array($str, $districtsList)){ //dont add if already exist, remove redundancy
                    array_push($districtsList, $str);
                }
            }
        }

        $result = [];

        foreach($districtsList as $district){
            
            $result[$district]['cases_active'] = 0;

            foreach($simplified_clusters as $cluster){  

                $str_arr = explode (", ", $cluster['district']);

                foreach($str_arr as $str){
                    if($str == $district){
                        $result[$district]['cases_active'] = $result[$district]['cases_active'] +  $cluster['cases_active'];

                        if($result[$district]['cases_active'] == 0){
                            $result[$district]['zone_id'] = 1;
                        }
                        else if($result[$district]['cases_active'] < 20){
                            $result[$district]['zone_id'] = 2;
                        }
                        else if($result[$district]['cases_active'] < 41){
                            $result[$district]['zone_id'] = 3;
                        }
                        else{
                            $result[$district]['zone_id'] = 4;
                        }

                        //uppdate matching district name as in db 
                        $db_district = AddressesDistrict::where('name', $district);
                        $db_district->update([
                            'zone_id' => $result[$district]['zone_id']
                        ]);
                    }
                }
            }
        }

        //remaining district not mention will be default green zone
        $remaining_db_district = AddressesDistrict::whereNotIn('name', $districtsList);
        $remaining_db_district->update([
            'zone_id' => 1
        ]);


        // Encode the result as a JSON.
        $result = json_encode($result, JSON_PRETTY_PRINT);

        // return $result;
    }
}
