<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Services\BookService;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        $books = $this->bookService->list();
        return BookResource::collection($books);
    }

    public function store(BookRequest $request)
    {
        $book = $this->bookService->create($request->validated());
        return new BookResource($book);
    }

    public function update(BookRequest $request, $id)
    {
        $book = $this->bookService->update($id, $request->validated());
        return new BookResource($book);
    }

    public function destroy($id)
    {
        $this->bookService->delete($id);
        return response()->json(['message' => 'Book deleted successfully']);
    }
}

