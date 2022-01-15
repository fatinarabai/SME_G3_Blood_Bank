<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressesState extends Model
{
    protected $fillable = [
        'state',
    ];

    public function AddressesDistrict(){
		return $this->hasMany('App\AddressesDistrict', 'state_id');
	}
}
