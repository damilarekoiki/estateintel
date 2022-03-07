<?php

namespace App\Interfaces;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface 
{
    public function createBook(array $bookData) : Book;
    public function updateBook(Book $book, array $bookData) : Book;
    public function updateBookById(int $BookId, array $bookData) : Book;
    public function getBook(Book $book) : Book;
    public function getBookById(int $BookId) : Book;
    public function deleteBook(Book $book) : Book;
    public function deleteBookById(int $BookId) : Book;
    public function fetchAllBooks($searchObject) : Collection;
    public function searchBookBy(string $field, $value) : Collection;
    public function searchBook($keyword) : Collection;
    public function fetchExternalBooks(string $name);

}