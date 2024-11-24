<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\BookService;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        return response()->json($this->bookService->getAllBooks());
    }

    public function store(BookRequest $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);
        return response()->json($this->bookService->createBook($request->all()), 201);
    }

    public function show($id)
    {
        return response()->json($this->bookService->getBook($id));
    }

    public function update(BookRequest $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);
        return response()->json($this->bookService->updateBook($id, $request->all()));
    }

    public function destroy($id)
    {
        return response()->json($this->bookService->deleteBook($id));
    }
}
