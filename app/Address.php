<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'state_id',
        'district_id',
        'street',
        'postcode'
    ];

    public function AddressesDistrict(){
		return $this->belongsTo('App\AddressesDistrict', 'district_id');
	}

    public function AddressesState(){
		return $this->belongsTo('App\AddressesState', 'state_id');
	}
}
