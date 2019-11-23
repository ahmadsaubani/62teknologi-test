<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReviews extends Model
{
    protected $fillable = [
        'api_user_id',
        'name',
        'profile_url',
        'image_url',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
