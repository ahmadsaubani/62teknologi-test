<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'business_id',
        'alias',
        'name',
        'image_url',
        'is_closed',
        'url',
        'rating',
        'categories',
        'transactions',
        'price',
        'phone',
        'display_phone'
    ];

    public function location()
    {
        return $this->hasOne(Location::class);
    }

    // public function userReview() {
    //     return $this->hasMany(UserReviews::class);
    // }
}
