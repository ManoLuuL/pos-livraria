<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function getAll()
    {
        return Book::with(['author', 'category'])->paginate();
    }

    public function getById($id)
    {
        return Book::with(['author', 'category'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function update(Book $book, array $data)
    {
        $book->update($data);
        return $book;
    }

    public function delete(Book $book)
    {
        return $book->delete();
    }
}
