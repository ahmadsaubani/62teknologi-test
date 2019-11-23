<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'business_id',
        'address1',
        'address2',
        'address3',
        'city',
        'zip_code',
        'country',
        'state',
        'latitude',
        'longitude'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
