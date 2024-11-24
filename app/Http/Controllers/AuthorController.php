<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        return response()->json(Author::all());
    }

    public function show($id)
    {
        return response()->json(Author::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $author = Author::create($request->all());
        return response()->json($author, 201);
    }
}
