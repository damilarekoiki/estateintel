<?php

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

$data = [
    'name' => 'Nice book',
    'isbn' => Str::random(10),
    'authors' => ["Angel Moore", 'Luka Fashahun'],
    'country' => 'England',
    'number_of_pages' => 75,
    'publisher' => 'Latest Publisher',
    'release_date' => '2022-02-05'
];

uses(Tests\TestCase::class, RefreshDatabase::class);

it('does not fetch external books without a name field', function () {
    $data = [];
    $response = $this->json('GET', '/api/external-books', $data);
    $response->assertStatus(422);
});

it('can fetch external books', function () {
    $data = ['name' => 'A game of thrones'];
    $response = $this->json('GET', '/api/external-books', $data);
    $response->assertStatus(200);
});

it('does not create a book without a name field', function () use ($data) {
    $bookData = $data;
    unset($bookData['name']);
    $response = $this->postJson('/api/v1/books', $bookData);
    $response->assertStatus(422);
});

it('does not create a book without an isbn field', function () use($data) {
    $bookData = $data;
    unset($bookData['isbn']);
    $response = $this->postJson('/api/v1/books', $bookData);
    $response->assertStatus(422);
});

it('does not create a book without an authors field', function () use($data) {
    $bookData = $data;
    unset($bookData['authors']);
    $response = $this->postJson('/api/v1/books', $bookData);
    $response->assertStatus(422);
});

it('does not create a book without a country field', function () use($data) {
    $bookData = $data;
    unset($bookData['country']);
    $response = $this->postJson('/api/v1/books', $bookData);
    $response->assertStatus(422);
});

it('does not create a book without a number_of_pages field', function () use($data) {
    $bookData = $data;
    unset($bookData['number_of_pages']);
    $response = $this->postJson('/api/v1/books', $bookData);
    $response->assertStatus(422);
});

it('does not create a book without a publisher field', function () use($data) {
    $bookData = $data;
    unset($bookData['publisher']);
    $response = $this->postJson('/api/v1/books', $bookData);
    $response->assertStatus(422);
});

it('does not create a book without a release_date field', function () use($data) {
    $bookData = $data;
    unset($bookData['release_date']);
    $response = $this->postJson('/api/v1/books', $bookData);
    $response->assertStatus(422);
});

it('can create a book', function () {
    $attributes = Book::factory()->raw();
    $response = $this->postJson('/api/v1/books', $attributes);
    $response->assertStatus(200)->assertJson(['status_code' => 201]);
});

it('can fetch a book', function () {
    $book = Book::factory()->create();

    $response = $this->getJson("/api/v1/books/{$book->id}");

    $data = [
        'status_code' => 200,
        'status' => 'success',
        'data' => [
            'id' => $book->id,
            'name' => $book->name,
            'isbn' => $book->isbn,
            'authors' => $book->authors,
            'number_of_pages' => $book->number_of_pages,
            'publisher' => $book->publisher,
            'country' => $book->country,
            'release_date' => $book->release_date
        ]
    ];

    $response->assertStatus(200)->assertJson($data);
});

it('can fetch all books', function () {
    $response = $this->getJson("/api/v1/books");

    $response->assertStatus(200)->assertJson(['status_code' => 200]);
});

it('can update a book', function () {
    $book = Book::factory()->create();
    $bookData = [
        'name' => 'An updated book',
        'isbn' => Str::random(10),
        'authors' => ['Latest Author'],
        'number_of_pages' => 205,
        'publisher' => 'John Dan',
        'country' => 'Ghana',
        'release_date' => '2025-10-05'
    ];
    $response = $this->putJson("/api/v1/books/{$book->id}", $bookData);
    $response->assertStatus(200)
    ->assertJson(['status_code' => 200])
    ->assertJson(['message' => "The book {$book->name} was updated successfully"]);
});

it('can delete a book', function () {
    $book = Book::factory()->create();
    $response = $this->deleteJson("/api/v1/books/{$book->id}");
    $response->assertJson(['status_code' => 204])
    ->assertJson(['message' => "The book '{$book->name}' was deleted successfully"]);
});

it('can delete a book with a post link', function () {
    $book = Book::factory()->create();
    $response = $this->postJson("/api/v1/books/{$book->id}/delete");
    $response->assertJson(['status_code' => 204])
    ->assertJson(['message' => "The book '{$book->name}' was deleted successfully"]);
});