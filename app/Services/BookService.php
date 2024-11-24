<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function getAllBooks()
    {
        return Book::with(['author', 'category'])->get();
    }

    public function createBook(array $data)
    {
        return Book::create($data);
    }

    public function getBook($id)
    {
        return Book::with(['author', 'category'])->findOrFail($id);
    }

    public function updateBook($id, array $data)
    {
        $book = Book::findOrFail($id);
        $book->update($data);
        return $book;
    }

    public function deleteBook($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully']);
    }
}
