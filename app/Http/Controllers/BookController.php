<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        $books = Book::orderByDesc('id')->get();
        return view('books.index', compact('books'));
    }
    public function create() { return view('books.create'); }
    public function store(Request $request) {
        $data = $request->validate([
            'title'=>'required|max:255','author'=>'nullable|max:255',
            'isbn'=>'nullable|max:50|unique:books,isbn',
            'published_year'=>'nullable|integer','copies_total'=>'required|integer|min:1'
        ]);
        $data['copies_available'] = $data['copies_total'];
        Book::create($data);
        return redirect()->route('books.index')->with('success','Book created.');
    }
    public function edit(Book $book) { return view('books.edit', compact('book')); }
    public function update(Request $request, Book $book) {
        $data = $request->validate([
            'title'=>'required|max:255','author'=>'nullable|max:255',
            'isbn'=>"nullable|max:50|unique:books,isbn,{$book->id}",
            'published_year'=>'nullable|integer','copies_total'=>'required|integer|min:1'
        ]);
        $delta = $data['copies_total'] - $book->copies_total;
        $book->update($data);
        if ($delta !== 0) {
            $book->copies_available = max(0, min($book->copies_available + $delta, $book->copies_total));
            $book->save();
        }
        return redirect()->route('books.index')->with('success','Book updated.');
    }
    public function destroy(Book $book) {
        $book->delete();
        return redirect()->route('books.index')->with('success','Book deleted.');
    }
}
