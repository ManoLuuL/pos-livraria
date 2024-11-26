<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository
{
    public function all()
    {
        return Author::all();
    }

    public function create(array $data)
    {
        return Author::create($data);
    }

    public function find(int $id)
    {
        return Author::findOrFail($id);
    }

    public function delete(int $id)
    {
        $author = $this->find($id);
        return $author->delete();
    }
}
