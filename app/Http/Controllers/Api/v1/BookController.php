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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $book = $this->bookRepository->getBookById($id);
        return $this->returnResponse($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBookRequest $request, Book $book)
    {
        //
        $book = $this->bookRepository->updateBook($book, $request->validated());
        $response = new BookResourse($book);
        return $this->returnResponse($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
        $book = $this->bookRepository->deleteBook($book);
        return $this->returnResponse($book, 'success', 204);
    }
}
