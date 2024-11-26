<?php

namespace App\Services;

use App\Repositories\AuthorRepository;

class AuthorService
{
    protected $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function list()
    {
        return $this->authorRepository->all();
    }

    public function create(array $data)
    {
        return $this->authorRepository->create($data);
    }

    public function delete(int $id)
    {
        return $this->authorRepository->delete($id);
    }
}
