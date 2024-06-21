<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\CreateBookRequest;

class BookController extends Controller
{
   
    public function index()
    {
        return Book::all();
    }

    public function store(CreateBookRequest $request)
    {
        $validatedData = $request->validated();
        $book=Book::create($validatedData);
        return response()->json($book, 201);
    }


    public function show( $id)
    {
        return Book::findOrFail($id);
    }

    public function update(Request $request, $id)
    {   $book = Book::findOrFail($id);
        $book->update($request->all());
        return $book;
    }

    
    public function destroy($id)
    {
        return Book::destroy($id);
      
    }
}
