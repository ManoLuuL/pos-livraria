<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function all()
    {
        return Book::all();
    }

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function find($id)
    {
        return Book::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $book = $this->find($id);
        $book->update($data);
        return $book;
    }

    public function delete($id)
    {
        $book = $this->find($id);
        return $book->delete();
    }
}
