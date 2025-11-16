# libraryApp — Library Borrowing System

> **Midterm Examination Documentation (README Edition)**  
> This README serves as the required Markdown documentation for the midterm: it outlines the project’s goals, scope, features, setup, usage, and sample code snippets.

---

## 📌 Project Title
**libraryApp — A Simple Library Borrowing & Returns System**

## 🧭 Description / Overview
`libraryApp` lets students search books, place borrow requests, set a borrow period, and return books on time. Librarians/admins can manage the catalog, users, and borrowing rules. The focus is a clean borrow→use→return workflow backed by a MySQL database.

## 🎯 Objectives
- Practice full‑stack CRUD for books, users, and borrow records.
- Implement a **borrowing lifecycle**: request → approve → return → (optional) overdue fees.
- Use **MySQL** (via XAMPP) for persistent relational data.
- Strengthen skills in **PHP/Laravel**, routing, validation, and MVC patterns.
- Provide a simple, student‑friendly **UI/UX** and documentation.

## ✨ Features / Functionality
- **User Roles**: Admin, Librarian, Student
- **Catalog Management**: add/edit/delete books; track available copies
- **Search & Filter**: by title, author, category, status
- **Borrow Requests**: student sets borrow start & due date; request is logged
- **Approvals (optional)**: librarian approves or auto‑approves within limits
- **Returns**: mark as returned; compute overdue days/fees (if enabled)
- **History & Dashboard**: recent borrows, active loans, top titles
- **Validation & Guards**: no over‑borrowing beyond available copies
- **Basic Reports (optional)**: daily/weekly borrow summaries

---

## 🛠️ Installation Instructions
> Example stack: **Laravel + PHP 8.x + Composer + XAMPP (Apache/MySQL)** + VS Code

1. **Install Tools**
   - Download & install **VS Code**.
   - Install **XAMPP** (start **Apache** and **MySQL**).
   - Install **Git**, **PHP 8.2+**, and **Composer**.

2. **Copy Project Code**
   - From your repository (or ZIP), place files into your web workspace, e.g.:
     - Windows XAMPP: `C:\xampp\htdocs\libraryApp`
     - Or any folder if you’ll run `php artisan serve`

3. **Create Database**
   - Open **phpMyAdmin** (http://localhost/phpmyadmin)
   - Create a database, e.g. `library_app` (utf8mb4, collation: `utf8mb4_unicode_ci`).

4. **Environment Setup (Laravel)**
   ```bash
   cp .env.example .env
   # then open .env and set DB creds
   ```
   **.env (example):**
   ```env
   APP_NAME=libraryApp
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=library_app
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Install Dependencies & Key**
   ```bash
   composer install
   php artisan key:generate
   ```
   (Optional: if using Vite/Laravel Mix for assets)
   ```bash
   npm install
   npm run build   # or: npm run dev
   ```

6. **Migrate & Seed**
   ```bash
   php artisan migrate --seed
   ```
   > Include seeders for sample users (Admin/Librarian/Student) and a few books.

7. **Run the App**
   ```bash
   php artisan serve
   # App at: http://127.0.0.1:8000
   ```
   Or via XAMPP Apache if deploying into `htdocs`.

---

## ▶️ Usage
**Student: Borrow a Book**
1. **Login** → **Catalog** → search a title.
2. Click **Borrow**, set **Borrow Start** and **Due Date** (e.g., 7–14 days).
3. Confirm request. If auto‑approve: status becomes **Borrowed**; else pending librarian approval.

**Student: Return a Book**
1. Go to **My Borrowed**.
2. Click **Return** → confirm.  
3. System marks returned; computes **overdue days** if `returned_at > due_at`.

**Librarian/Admin:**
- **Approve/Decline** pending requests.
- **Manage Books** (add copies, edit details).
- **View Reports** (active loans, overdue items).

> Sample test accounts (if seeded):  
> - **Admin**: `admin@example.com` / `password`  
> - **Librarian**: `lib@example.com` / `password`  
> - **Student**: `student@example.com` / `password`

---

## 🧩 Code Snippets

### 1) Database Tables (quick SQL sketch)
```sql
CREATE TABLE books (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  isbn VARCHAR(32) UNIQUE,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(255),
  category VARCHAR(100),
  total_copies INT DEFAULT 1,
  available_copies INT DEFAULT 1,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

CREATE TABLE borrows (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  book_id BIGINT UNSIGNED NOT NULL,
  status ENUM('pending','approved','borrowed','returned','declined') DEFAULT 'pending',
  borrowed_at DATETIME NULL,
  due_at DATETIME NULL,
  returned_at DATETIME NULL,
  overdue_days INT DEFAULT 0,
  fee_cents INT DEFAULT 0,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  CONSTRAINT fk_borrows_user FOREIGN KEY (user_id) REFERENCES users(id),
  CONSTRAINT fk_borrows_book FOREIGN KEY (book_id) REFERENCES books(id)
);
```

### 2) Laravel Routes (excerpt)
```php
// routes/web.php
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/books'));
Route::resource('books', BookController::class)->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::post('/borrow/{book}', [BorrowController::class, 'store'])->name('borrow.store');
    Route::post('/borrow/{borrow}/approve', [BorrowController::class, 'approve'])->name('borrow.approve');
    Route::post('/borrow/{borrow}/return', [BorrowController::class, 'return'])->name('borrow.return');
    Route::get('/my/borrows', [BorrowController::class, 'mine'])->name('borrow.mine');
});
```

### 3) Borrow Controller (core actions)
```php
// app/Http/Controllers/BorrowController.php
public function store(Request $request, Book $book)
{
    $this->authorize('borrow', $book);

    $data = $request->validate([
        'borrowed_at' => ['required', 'date', 'after_or_equal:today'],
        'due_at'      => ['required', 'date', 'after:borrowed_at'],
    ]);

    if ($book->available_copies < 1) {
        return back()->withErrors('No available copies for this title.');
    }

    $borrow = $request->user()->borrows()->create([
        'book_id'    => $book->id,
        'status'     => config('library.auto_approve') ? 'borrowed' : 'pending',
        'borrowed_at'=> $data['borrowed_at'],
        'due_at'     => $data['due_at'],
    ]);

    if (config('library.auto_approve')) {
        $book->decrement('available_copies');
    }

    return redirect()->route('borrow.mine')->with('ok', 'Borrow request submitted.');
}

public function return(Borrow $borrow)
{
    $this->authorize('return', $borrow);

    if ($borrow->status !== 'borrowed') {
        return back()->withErrors('This record is not currently borrowed.');
    }

    $borrow->returned_at = now();
    $overdue = 0;
    if ($borrow->due_at && now()->gt($borrow->due_at)) {
        $overdue = now()->diffInDays($borrow->due_at);
    }
    $borrow->overdue_days = $overdue;
    $borrow->fee_cents = $overdue * (config('library.fee_per_day_cents', 0));
    $borrow->status = 'returned';
    $borrow->save();

    $borrow->book()->increment('available_copies');

    return redirect()->route('borrow.mine')->with('ok', 'Book returned. Thank you!');
}
```

### 4) Eloquent Relationships
```php
// app/Models/Book.php
public function borrows() {
    return $this->hasMany(Borrow::class);
}

// app/Models/User.php
public function borrows() {
    return $this->hasMany(Borrow::class);
}

// app/Models/Borrow.php
public function user() { return $this->belongsTo(User::class); }
public function book() { return $this->belongsTo(Book::class); }
```

### 5) Simple Blade Snippet (Borrow Modal)
```blade
{{-- resources/views/books/_borrow_modal.blade.php --}}
<form method="POST" action="{{ route('borrow.store', $book) }}">
  @csrf
  <label>Borrow Start</label>
  <input type="date" name="borrowed_at" required>
  <label>Due Date</label>
  <input type="date" name="due_at" required>
  <button type="submit">Borrow</button>
</form>
```

---

## 👥 Contributors
- **Mark Angelo Dumaguin** — Student Developer

---

## 📄 License (Student Academic Use)
**Student Use License (Non‑Commercial, Academic)**  
Copyright © 2025 Mark Angelo Dumaguin

Permission is hereby granted to classmates, instructors, and academic reviewers to use, view, and evaluate this project for **educational purposes only**.  
Commercial use, redistribution outside the course, or relicensing is **not permitted** without written permission.  
This software is provided “as is” without warranty of any kind.

---

## 📚 Notes
- Seeders can create sample users and books for quick demo.
- Toggle `config/library.php` for `auto_approve` and `fee_per_day_cents`.
- Keep migrations and seeders under version control for easy resets.

---

> ✅ This README fulfills the midterm Markdown documentation criteria: Title, Overview, Objectives, Features, Installation, Usage, Code Snippets, Contributors, and a Student License.
