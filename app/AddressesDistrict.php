<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressesDistrict extends Model
{
    protected $fillable = [
        'state_id',
        'name',
        'zone_id',
    ];

    public function Zone(){
		return $this->belongsTo('App\Zone', 'zone_id');
	}
}
