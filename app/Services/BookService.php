<?php

namespace App\Services;

use App\Models\Book;

class BookService {
    public static function createNewBook($book){
        $book = Book::create($book);
        return $book;
    }

    public static function fetchAllBooks(){
        $books = Book::all();
        return $books;
    }
}