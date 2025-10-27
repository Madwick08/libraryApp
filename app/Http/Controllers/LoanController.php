<?php

namespace App\Http\Controllers;

use App\Models\{Loan, Book, Member};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index() {
        $loans = Loan::with(['book','member'])->orderByDesc('id')->get();
        return view('loans.index', compact('loans'));
    }

    public function create() {
        $members = Member::orderBy('name')->get();
        $books = Book::orderBy('title')->get();
        return view('loans.create', compact('members','books'));
    }

    // Borrow
    public function store(Request $request) {
        $data = $request->validate([
            'member_id'=>'required|exists:members,id',
            'book_id'=>'required|exists:books,id',
            'due_at'=>'nullable|date',
        ]);

        DB::transaction(function () use ($data) {
            $book = Book::lockForUpdate()->findOrFail($data['book_id']);
            if ($book->copies_available < 1) abort(422,'No available copies for this book.');

            Loan::create([
                'member_id'=>$data['member_id'],'book_id'=>$data['book_id'],
                'borrowed_at'=>now(),'due_at'=>$data['due_at'] ?? now()->addDays(7),
                'status'=>'BORROWED',
            ]);

            $book->decrement('copies_available');
        });

        return redirect()->route('loans.index')->with('success','Book borrowed.');
    }

    // Return
    public function return(Loan $loan) {
        if ($loan->status === 'RETURNED') return redirect()->route('loans.index');
        DB::transaction(function () use ($loan) {
            $loan->update(['status'=>'RETURNED','returned_at'=>now()]);
            $loan->book()->lockForUpdate()->first()->increment('copies_available');
        });
        return redirect()->route('loans.index')->with('success','Book returned.');
    }

    public function edit(Loan $loan) {
        $members = Member::orderBy('name')->get();
        $books = Book::orderBy('title')->get();
        return view('loans.edit', compact('loan','members','books'));
    }

    public function update(Request $request, Loan $loan) {
        $data = $request->validate([
            'member_id'=>'required|exists:members,id',
            'book_id'=>'required|exists:books,id',
            'due_at'=>'nullable|date',
            'status'=>'required|string'
        ]);
        $loan->update($data);
        return redirect()->route('loans.index')->with('success','Loan updated.');
    }

    public function destroy(Loan $loan) {
        DB::transaction(function () use ($loan) {
            if ($loan->status === 'BORROWED') {
                $loan->book()->lockForUpdate()->first()->increment('copies_available');
            }
            $loan->delete();
        });
        return redirect()->route('loans.index')->with('success','Loan deleted.');
    }
}
