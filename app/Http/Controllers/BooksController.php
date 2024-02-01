<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::all();
        return view('admin.books' , compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create.books');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {  
        $book = Books::create($request->all());
        $book->cover = $request->file('cover')->store('images', 'public');
        $book->save();
    
        return redirect('books')->with('success', 'Book Added Successfully!');
    }
    

    

    /**
     * Display the specified resource.
     */
    public function show(Books $books)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Books::findOrFail($id);
        return view('admin.update.books', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Books $book)
{
    $book->update($request->all());

    if ($request->hasFile('cover')) {
        $book->cover = $request->file('cover')->store('images', 'public');
        $book->save();
    }

    return redirect('books')->with('success', 'Book Updated Successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Books::findOrFail($id);
        $book->delete();
        return redirect('books')->with('success', 'Book Deleted Successfully!');
    }
}
