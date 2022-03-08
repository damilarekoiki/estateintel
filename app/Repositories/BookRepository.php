<?php

namespace App\Repositories;

use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use App\Services\HttpService;
use Illuminate\Database\Eloquent\Collection;

class BookRepository implements BookRepositoryInterface 
{
    public function createBook(array $bookData) : Book {
        $book = Book::create($bookData);
        return $book;
    }
    public function updateBookById(int $bookId, array $bookData) : array {
        $book = Book::where('id', $bookId)->first();
        $updatedBook = null;
        if($book){
            $updatedBook = clone $book;
            $updatedBook = tap($updatedBook)->update($bookData);
        }
        return [
            'book' => $book,
            'updated_book' => $updatedBook,
        ];
    }
    public function getBookById(int $bookId) : ?Book {
        $book = Book::find($bookId);
        return $book;
    }
    public function deleteBookById(int $bookId) : array {
        $book = Book::find($bookId);
        $deletedBook = null;
        if($book){
            $deletedBook = clone $book;
            $deletedBook = tap($deletedBook)->delete();
        }
        return [
            'book' => $book,
            'deleted_book' => $deletedBook,
        ];
    }
    public function fetchAllBooks($searchObject) : Collection {
        
        // If search parameters are present, search by parameters else fetch all
        $books = Book::when($searchObject->name, function ($query) use($searchObject){
            return $query->where('name', 'LIKE', '%'.$searchObject->name.'%');
        })
        ->when($searchObject->country, function ($query) use($searchObject){
            return $query->orWhere('country', 'LIKE', '%'.$searchObject->country.'%');
        })
        ->when($searchObject->publisher, function ($query) use($searchObject){
            return $query->orWhere('publisher', 'LIKE', '%'.$searchObject->publisher.'%');
        })
        ->when($searchObject->release_date, function ($query) use($searchObject){
            return $query->orWhereYear('release_date', 'LIKE', '%'.$searchObject->release_date.'%');
        })
        ->get();

        return $books;

    }
    public function fetchExternalBooks(string $name){
        $url = config('book.external_books_url');
        $parameters = ['name' => $name];

        $response = (new HttpService())->get($url, $parameters);
        return $response;
    }
}