<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        // 'api_user_id',
        'user_review_id',
        'business_id',
        'review_id',
        'url',
        'text',
        'rating',
        'time_created'
    ];

    public function userReview()
    {
        return $this->belongsTo(UserReviews::class, 'user_review_id');
    }
}
