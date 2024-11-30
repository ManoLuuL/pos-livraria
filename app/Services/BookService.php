<?php

namespace App\Services;

use App\Repositories\BookRepository;

class BookService
{
    protected $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllBooks()
    {
        return $this->repository->getAll();
    }

    public function getBookById($id)
    {
        return $this->repository->getById($id);
    }

    public function createBook(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateBook($id, array $data)
    {
        $book = $this->repository->getById($id);
        return $this->repository->update($book, $data);
    }

    public function deleteBook($id)
    {
        $book = $this->repository->getById($id);
        return $this->repository->delete($book);
    }
}
