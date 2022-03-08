<?php

namespace App\Interfaces;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface 
{
    public function createBook(array $bookData) : Book;
    public function updateBookById(int $BookId, array $bookData) : array;
    public function getBookById(int $BookId) : ?Book;
    public function deleteBookById(int $BookId) : array;
    public function fetchAllBooks($searchObject) : Collection;
    public function fetchExternalBooks(string $name);

}