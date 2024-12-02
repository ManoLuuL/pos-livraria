<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->list();
        return CategoryResource::collection($categories);
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->create($request->validated());
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryService->update($id, $request->validated());
        return new CategoryResource($category);
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
