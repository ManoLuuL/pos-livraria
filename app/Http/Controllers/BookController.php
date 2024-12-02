<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Services\BookService;

class BookController extends Controller
{
    protected $service;

    public function __construct(BookService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $books = $this->service->getAllBooks();
        return BookResource::collection($books);
    }

    public function show($id)
    {
        $book = $this->service->getBookById($id);
        return new BookResource($book);
    }

    public function store(StoreBookRequest $request)
    {
        $book = $this->service->createBook($request->validated());
        return new BookResource($book);
    }

    public function update(UpdateBookRequest $request, $id)
    {
        $book = $this->service->updateBook($id, $request->validated());
        return new BookResource($book);
    }

    public function destroy($id)
    {
        $this->service->deleteBook($id);
        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}
