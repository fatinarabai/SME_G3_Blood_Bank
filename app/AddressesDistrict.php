<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressesDistrict extends Model
{
    protected $fillable = [
        'state_id',
        'name',
    ];
}
