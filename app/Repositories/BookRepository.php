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
    public function updateBook(Book $book, array $bookData) : Book {
        return tap($book)->update($bookData);
    }
    public function updateBookById(int $BookId, array $bookData) : Book {
        $book = Book::findOrFail($BookId);
        return tap($book)->update($bookData);
    }
    public function getBook(Book $book) : Book {
        return $book;
    }
    public function getBookId(int $BookId) : Book {
        $book = Book::find($BookId);
        return $book;
    }
    public function deleteBook(Book $book) : Book {
        return tap($book)->delete();
    }
    public function deleteBookId(int $BookId) : Book{
        $book = Book::findOrFail($BookId);
        return tap($book)->delete();
    }
    public function fetchAllBooks() : Collection {
        return Book::all();
    }
    public function searchBookBy(string $field, $value) : Book {
        $books = Book::where($field, 'LIKE', '%'.$value.'%')
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