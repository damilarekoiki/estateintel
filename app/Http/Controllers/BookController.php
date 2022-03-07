<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExternalBookResourse;
use App\Interfaces\BookRepositoryInterface;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository) 
    {
        $this->bookRepository = $bookRepository;
    }
    
    //
    public function fetchExternalBooks(Request $request){

        $response = $this->bookRepository->fetchExternalBooks($request->name);

        $response = ExternalBookResourse::collection(collect($response));

        if(empty($response)){
            return $this->returnResponse($response, "not found", 404);
        }

        return $this->returnResponse($response);
    }
}
