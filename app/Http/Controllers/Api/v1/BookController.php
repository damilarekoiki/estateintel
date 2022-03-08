<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResourse;
use App\Http\Resources\BookResourseCollection;
use App\Http\Resources\CreateBookResourse;
use App\Interfaces\BookRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository) 
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $books = $this->bookRepository->fetchAllBooks($request);
        $response = BookResourseCollection::collection($books);
        return $this->returnResponse($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {

        $book = $this->bookRepository->createBook($request->validated());

        $response = new CreateBookResourse($book);

        return $this->returnResponse($response, "success", 201);

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $book = $this->bookRepository->getBookById($id);
        
        if(empty($book)){
            return $this->returnResponse([], "not found", 404);
        }

        $response = new BookResourse($book);

        return $this->returnResponse($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBookRequest $request, $bookId)
    {
        // Update book
        $bookData = $request->validated();
        $update = $this->bookRepository->updateBookById($bookId, $bookData);
        $book = $update['book'];
        $updatedBook = $update['updated_book'];

        // Return error response
        if(empty($book)){
            return $this->returnResponse([], "not found", 404);
        }

        // Return success response
        $response = new BookResourse($updatedBook);
        $message = "The book {$book->name} was updated successfully";
        return $this->returnResponseWithMessage($response, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($bookId)
    {
        // Delete book
        $delete = $this->bookRepository->deleteBookById($bookId);
        $book = $delete['book'];

        // Return error response
        if(empty($book)){
            return $this->returnResponse([], "not found", 404);
        }

        // Return success response
        $message = "The book '{$book->name}' was deleted successfully";
        return $this->returnResponseWithMessage([], $message);
    }
}
