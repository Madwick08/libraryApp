@extends('layouts.app')

@section('content')
<div class="lib-create">
  <style>
    .lib-create{
      --bg:#f7f5f2;           /* paper */
      --ink:#0f172a;          /* deep ink */
      --muted:#6b7280;        /* slate */
      --brand:#2f855a;        /* library green */
      --brand-2:#38a169;      /* lighter green */
      --card:#ffffff;         /* card */
      --ring: rgba(56,161,105,.35);
      --radius:18px;
      --shadow: 0 18px 50px rgba(16,24,40,.08);
    }
    .lib-create .wrap{
      max-width: 780px; margin: clamp(16px,4vw,48px) auto;
      padding: clamp(12px,2vw,16px);
    }
    .lib-create .hero{
      display:flex; gap:16px; align-items:center; margin-bottom:18px;
    }
    .lib-create .badge{
      width:52px; height:52px; border-radius:14px; display:grid; place-items:center;
      background: radial-gradient(120% 140% at 10% 10%, var(--brand-2) 0%, var(--brand) 60%, #1f6f4a 100%);
      box-shadow: 0 10px 28px rgba(47,133,90,.35);
    }
    .lib-create .badge svg{ width:28px; height:28px; color:#e8f5ee }
    .lib-create h1{
      margin:0; font-size: clamp(22px, 2.4vw, 28px); color:var(--ink); font-weight:700;
      letter-spacing:.2px;
    }
    .lib-create .sub{ color:var(--muted); margin-top:2px; font-size:14px }

    .lib-create .card{
      background:var(--card); border-radius:var(--radius); box-shadow:var(--shadow);
      overflow:hidden; border:1px solid #eef2f7;
    }
    .lib-create .card-head{
      padding:20px 22px; background:
        linear-gradient(180deg, rgba(47,133,90,.06), transparent 60%);
      border-bottom:1px solid #eef2f7;
    }
    .lib-create .card-body{ padding:22px }
    .lib-create .grid{
      display:grid; gap:16px; grid-template-columns: 1fr;
    }
    @media (min-width: 700px){
      .lib-create .grid{
        grid-template-columns: 1fr 1fr;
      }
      .lib-create .grid .span-2{ grid-column: span 2; }
    }

    .lib-create label{
      display:block; font-size:13px; color:#334155; margin:0 0 6px 2px; font-weight:600;
    }
    .lib-create .field{
      position:relative;
    }
    .lib-create .input{
      width:100%; border:1px solid #e5e7eb; background:#fff;
      border-radius:12px; padding:12px 14px; font-size:15px; color:var(--ink);
      transition: box-shadow .15s ease, border-color .15s ease, transform .04s ease;
      outline: none;
    }
    .lib-create .input:focus{
      border-color: var(--brand-2);
      box-shadow: 0 0 0 6px var(--ring);
    }
    .lib-create .input::placeholder{ color:#94a3b8 }
    .lib-create .hint{ margin-top:6px; color:#748096; font-size:12px }

    .lib-create .actions{
      display:flex; gap:10px; padding:18px 22px; border-top:1px solid #eef2f7;
      background:linear-gradient(180deg, transparent, rgba(15,23,42,.02));
      justify-content:flex-end; flex-wrap:wrap;
    }
    .lib-create .btn{
      appearance:none; border:0; padding:12px 16px; border-radius:12px; font-weight:700;
      cursor:pointer; font-size:14px; line-height:1; text-decoration:none; display:inline-flex; align-items:center; gap:8px;
      transition: transform .04s ease, box-shadow .2s ease, background .2s ease, color .2s ease;
    }
    .lib-create .btn:active{ transform: translateY(1px) }
    .lib-create .btn-primary{
      color:#fff; background: linear-gradient(180deg, var(--brand-2), var(--brand));
      box-shadow: 0 12px 28px rgba(47,133,90,.25);
    }
    .lib-create .btn-primary:hover{ filter: brightness(1.03) }
    .lib-create .btn-ghost{
      background:#f1f5f9; color:#0f172a;
    }
    .lib-create .req::after{
      content:" *"; color:#dc2626; font-weight:900;
    }

    .lib-create .errors{
      background:#fff1f2; border:1px solid #fecdd3; color:#7f1d1d;
      padding:12px 14px; border-radius:12px; font-size:14px; margin: 0 22px 18px;
    }
    .lib-create .errors ul{ margin:6px 0 0 18px }
  </style>

  <div class="wrap">
    <div class="hero">
      <div class="badge" aria-hidden="true">
        {{-- Book icon --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M3.75 5.25A2.25 2.25 0 016 3h12.75v16.5H6A2.25 2.25 0 013.75 17.25V5.25zM6 3v14.25M9 7.5h6M9 10.5h6"/>
        </svg>
      </div>
      <div>
        <h1>Add a New Book</h1>
        <div class="sub">Catalog a new title to your shelves.</div>
      </div>
    </div>

    {{-- Validation errors (optional) --}}
    @if ($errors->any())
      <div class="errors">
        <strong>Please correct the following:</strong>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card">
      <div class="card-head">
        <strong>Book details</strong>
      </div>

      <form method="POST" action="{{ route('books.store') }}" class="card-body" autocomplete="on">
        @csrf
        <div class="grid">
          <div class="field span-2">
            <label for="title" class="req">Title</label>
            <input id="title" name="title" required class="input" placeholder="e.g., Clean Code"
                   value="{{ old('title') }}">
            <div class="hint">The full title as it appears on the book.</div>
          </div>

          <div class="field">
            <label for="author">Author</label>
            <input id="author" name="author" class="input" placeholder="e.g., Robert C. Martin"
                   value="{{ old('author') }}">
          </div>

          <div class="field">
            <label for="isbn">ISBN</label>
            <input id="isbn" name="isbn" class="input" placeholder="e.g., 9780132350884"
                   value="{{ old('isbn') }}">
            <div class="hint">13-digit preferred, but optional.</div>
          </div>

          <div class="field">
            <label for="published_year">Published year</label>
            <input id="published_year" type="number" name="published_year" class="input"
                   placeholder="e.g., 2008" inputmode="numeric" min="1400" max="2100" step="1"
                   value="{{ old('published_year') }}">
          </div>

          <div class="field">
            <label for="copies_total" class="req">Total copies</label>
            <input id="copies_total" type="number" name="copies_total" class="input"
                   value="{{ old('copies_total', 1) }}" min="1" step="1" required>
            <div class="hint">How many physical copies are available.</div>
          </div>
        </div>

        <div class="actions">
          <a class="btn btn-ghost" href="{{ route('books.index') }}">Cancel</a>
          <button class="btn btn-primary" type="submit">
            {{-- small plus icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 viewBox="0 0 24 24" aria-hidden="true">
              <path d="M12 5a1 1 0 011 1v5h5a1 1 0 010 2h-5v5a1 1 0 01-2 0v-5H6a1 1 0 010-2h5V6a1 1 0 011-1z"/>
            </svg>
            Save Book
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
