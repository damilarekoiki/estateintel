<?php

namespace App\Http\Controllers;

use App\Http\Requests\FetchExternalBooksRequest;
use App\Http\Resources\ExternalBookResourseCollection;
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
    public function fetchExternalBooks(FetchExternalBooksRequest $request){

        $response = $this->bookRepository->fetchExternalBooks($request->name);

        $response = ExternalBookResourseCollection::collection(collect($response));

        if(empty($response)){
            return $this->returnResponse($response, "not found", 404);
        }

        return $this->returnResponse($response);
    }
}
