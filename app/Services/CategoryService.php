<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function list()
    {
        return $this->categoryRepository->all();
    }

    public function create(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->categoryRepository->delete($id);
    }
}
