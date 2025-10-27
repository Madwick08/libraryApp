<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BookController, MemberController, LoanController};

Route::get('/', fn() => redirect()->route('books.index'));

Route::resource('books', BookController::class);
Route::resource('members', MemberController::class);
Route::resource('loans', LoanController::class)->except('show');
Route::post('/loans/{loan}/return', [LoanController::class, 'return'])->name('loans.return');
