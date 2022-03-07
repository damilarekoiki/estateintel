<?php

namespace App\Http\Controllers;

use App\Services\HttpService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    //
    public function fetchExternalBooks(Request $request){


        $url = config('book.external_books_url');
        $parameters = ['name' => $request->name];

        $response = (new HttpService())->get($url, $parameters);

        if(empty($response)){
            return $this->successResponse($response, "not found", 404);
        }

        return $this->successResponse($response);
    }
}
