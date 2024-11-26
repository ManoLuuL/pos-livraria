<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Services\AuthorService;
use App\Http\Resources\AuthorResource;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index()
    {
        $authors = $this->authorService->list();
        return AuthorResource::collection($authors);
    }

    public function store(AuthorRequest $request)
    {
        $author = $this->authorService->create($request->validated());
        return new AuthorResource($author);
    }

    public function destroy($id)
    {
        $this->authorService->delete($id);
        return response()->json(['message' => 'Author deleted successfully']);
    }
}

