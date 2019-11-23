<?php

namespace App\Http\Controllers;

use App\Business;
use App\Location;
use App\Review;
use App\UserReviews;
use Exception;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    public function store()
    {
        /**
         * extends from App\Http\Controllers\Controller
         */
        $res = $this->getBusiness();

        try {
            DB::beginTransaction();
        
            foreach ($res['businesses'] as $key) {
                Business::updateOrCreate(
                    [
                        'business_id' => $key['id']
                    ],
                    [
                        'business_id'   => $key['id'],
                        'alias'         => $key['alias'],
                        'name'          => $key['name'],
                        'image_url'     => $key['image_url'],
                        'is_closed'     => $key['is_closed'],
                        'url'           => $key['url'],
                        'rating'        => $key['rating'],
                        'transactions'  => ($key['transactions'] > 0 ? implode(",", $key['transactions']):null),
                        'price'         => array_key_exists('price', $key) ? $key['price'] : null,
                        'phone'         => ($key['phone'] ? $key['phone'] : null),
                        'display_phone' => $key['display_phone']

                    ]
                );

                if ($key['categories'] > 0) {
                    foreach ($key['categories'] as $d) {
                        Business::updateOrCreate(
                            [
                                'business_id' => $key['id'],
                            ],
                            [
                                'business_id' => $key['id'],
                                'categories'    => implode(",", $d)
                            ]
                        );
                    }
                }

                Location::updateOrCreate(
                    [
                        'business_id' => $key['id']
                    ],
                    [
                        'business_id' => $key['id'],
                        'address1' => $key['location']['address1'],
                        'address2' => $key['location']['address2'],
                        'address3' => $key['location']['address3'],
                        'city'      => $key['location']['city'],
                        'zip_code' => $key['location']['zip_code'],
                        'country' => $key['location']['country'],
                        'state' => $key['location']['state'],
                        'latitude' => $key['coordinates']['latitude'],
                        'longitude' => $key['coordinates']['longitude'],
                    ]
                );

                /**
                 * extends from App\Http\Controllers\Controller
                 */
                $reviews = $this->getReview($key['id']);
                
                foreach ($reviews['reviews'] as $review) {
                    $userReview = UserReviews::updateOrCreate(
                        [
                            
                            'api_user_id'   => $review['user']['id'],
                            'name'          => $review['user']['name'],
                        ],
                        [
                            
                            'api_user_id'   => $review['user']['id'],
                            'name'          => $review['user']['name'],
                            'profile_url'   => $review['user']['profile_url'],
                            'image_url'     => $review['user']['image_url'],
                        ]
                    );

                    Review::updateOrCreate(
                        [
                            'business_id'   => $key['id'],
                            'user_review_id'   => $userReview->id,
                            'review_id'     => $review['id'],
                            'url'           => $review['url'],
                        ],
                        [
                            'business_id'   => $key['id'],
                            'user_review_id'   => $userReview->id,
                            'review_id'     => $review['id'],
                            'url'           => $review['url'],
                            'text'          => $review['text'],
                            'rating'        => $review['rating'],
                            'time_created'  => $review['time_created']
                        ]
                    );
                }
            }

            DB::commit();
            return response()->json([
                'status'    => 'sukses',
                'message'   => 'Silahkan check database'
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'    => 'sukses',
                'message'   => $e->getMessage()
            ], 500);
        }
    }
}
