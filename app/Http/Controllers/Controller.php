<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $token = 'j9x4TFim9t0rIKm9Yzh7QkQuY3f0SB39x5cip1yI1xRJ8dO1qwblZSsPFHiT7bQs4O6BYODSHGUJEZHzedYNXJoSKh7KMV4ely8vzBsnU6sR6_dUporjxMgthoC4XXYx';

    public function getBusiness()
    {
        $client = new Client();
        $req = $client->get('https://api.yelp.com/v3/businesses/search?location=newyork&term=pasta', [
            'headers' => [
                'Authorization' => 'Bearer '.$this->token
            ]
        ]);
        $res =json_decode($req->getBody()->getContents(), true);
        
        return $res;
    }


    public function getReview($id)
    {
        $client = new Client();
        $req = $client->get('https://api.yelp.com/v3/businesses/'.$id.'/reviews', [
            'headers' => [
                'Authorization' => 'Bearer '.$this->token
            ]
        ]);
        $res =json_decode($req->getBody()->getContents(), true);

        return $res;
    }
}
