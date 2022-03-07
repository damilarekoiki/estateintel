<?php
namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class HttpService {

    public function get(string $url, array $parameters=[]){
        try {

            $response = Http::get($url, $parameters);

            $result = $response->json();

            return $result;

        } catch (ConnectionException $e) {
            //throw $th;
            return $e;
        }
    }
}