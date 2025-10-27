@extends('layouts.app')

@section('content')
<div class="lib-member-create">
  <style>
    .lib-member-create{
      --bg:#f7f5f2;           /* paper */
      --ink:#0f172a;          /* deep ink */
      --muted:#6b7280;        /* slate */
      --brand:#2f855a;        /* library green */
      --brand-2:#38a169;      /* lighter green */
      --card:#ffffff;         /* card */
      --ring: rgba(56,161,105,.35);
      --radius:18px;
      --shadow: 0 18px 50px rgba(16,24,40,.08);
      --table-border:#eef2f7;
    }
    .lib-member-create .wrap{
      max-width: 780px; margin: clamp(16px,4vw,48px) auto;
      padding: clamp(12px,2vw,16px);
    }
    .lib-member-create .hero{
      display:flex; gap:16px; align-items:center; margin-bottom:18px;
    }
    .lib-member-create .badge{
      width:56px; height:56px; border-radius:16px; display:grid; place-items:center;
      background: radial-gradient(120% 140% at 10% 10%, var(--brand-2) 0%, var(--brand) 60%, #1f6f4a 100%);
      box-shadow: 0 10px 28px rgba(47,133,90,.35);
    }
    .lib-member-create .badge svg{ width:30px; height:30px; color:#e8f5ee }
    .lib-member-create h1{
      margin:0; font-size: clamp(22px, 2.4vw, 28px); color:var(--ink); font-weight:800;
      letter-spacing:.2px;
    }
    .lib-member-create .sub{ color:var(--muted); margin-top:2px; font-size:14px }

    .lib-member-create .card{
      background:var(--card); border-radius:var(--radius); box-shadow:var(--shadow);
      overflow:hidden; border:1px solid var(--table-border);
    }
    .lib-member-create .card-head{
      padding:16px 20px; display:flex; align-items:center; justify-content:space-between; gap:12px;
      background: linear-gradient(180deg, rgba(47,133,90,.06), transparent 60%);
      border-bottom:1px solid var(--table-border);
    }
    .lib-member-create .card-body{ padding:22px }

    .lib-member-create .grid{
      display:grid; gap:16px; grid-template-columns: 1fr;
    }
    @media (min-width: 700px){
      .lib-member-create .grid{ grid-template-columns: 1fr 1fr; }
      .lib-member-create .span-2{ grid-column: span 2; }
    }

    .lib-member-create label{
      display:block; font-size:13px; color:#334155; margin:0 0 6px 2px; font-weight:600;
    }
    .lib-member-create .req::after{ content:" *"; color:#dc2626; font-weight:900; }
    .lib-member-create .input{
      width:100%; border:1px solid #e5e7eb; background:#fff;
      border-radius:12px; padding:12px 14px; font-size:15px; color:var(--ink);
      transition: box-shadow .15s ease, border-color .15s ease;
      outline: none;
    }
    .lib-member-create .input:focus{
      border-color: var(--brand-2);
      box-shadow: 0 0 0 6px var(--ring);
    }
    .lib-member-create .hint{ margin-top:6px; color:#748096; font-size:12px }

    .lib-member-create .actions{
      display:flex; gap:10px; padding:16px 20px; border-top:1px solid var(--table-border);
      background:linear-gradient(180deg, transparent, rgba(15,23,42,.02));
      justify-content:flex-end; flex-wrap:wrap;
    }
    .lib-member-create .btn{
      appearance:none; border:0; padding:12px 16px; border-radius:12px; font-weight:700;
      cursor:pointer; font-size:14px; line-height:1; text-decoration:none; display:inline-flex; align-items:center; gap:8px;
      transition: transform .04s ease, box-shadow .2s ease, background .2s ease, color .2s ease;
    }
    .lib-member-create .btn:active{ transform: translateY(1px) }
    .lib-member-create .btn-primary{
      color:#fff; background: linear-gradient(180deg, var(--brand-2), var(--brand));
      box-shadow: 0 12px 28px rgba(47,133,90,.25);
    }
    .lib-member-create .btn-ghost{ background:#f1f5f9; color:#0f172a; }

    .lib-member-create .errors{
      background:#fff1f2; border:1px solid #fecdd3; color:#7f1d1d;
      padding:12px 14px; border-radius:12px; font-size:14px; margin: 0 0 18px;
    }
    .lib-member-create .errors ul{ margin:6px 0 0 18px }
  </style>

  <div class="wrap">
    <div class="hero">
      <div class="badge" aria-hidden="true">
        {{-- Member icon --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M16 11a4 4 0 10-8 0 4 4 0 008 0zM6 19a6 6 0 1112 0v1H6v-1z"/>
        </svg>
      </div>
      <div>
        <h1>Add New Member</h1>
        <div class="sub">Create a patron profile for circulation and notifications.</div>
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
        <strong>Member details</strong>
        <span class="muted" style="color:var(--muted);font-size:14px">Basic contact information</span>
      </div>

      <form method="POST" action="{{ route('members.store') }}" class="card-body" autocomplete="on">
        @csrf
        <div class="grid">
          <div class="field span-2">
            <label for="name" class="req">Full name</label>
            <input id="name" name="name" class="input" required
                   placeholder="e.g., Juan Dela Cruz"
                   autocomplete="name"
                   value="{{ old('name') }}">
            <div class="hint">Preferred display name for receipts and emails.</div>
          </div>

          <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" class="input"
                   placeholder="e.g., juan@example.com"
                   autocomplete="email"
                   value="{{ old('email') }}">
            <div class="hint">Used for due date reminders and announcements.</div>
          </div>

          <div class="field">
            <label for="contact">Contact number</label>
            <input id="contact" name="contact" class="input"
                   placeholder="e.g., 0917 123 4567"
                   autocomplete="tel"
                   value="{{ old('contact') }}">
            <div class="hint">Mobile or landline is fine.</div>
          </div>
        </div>

        <div class="actions">
          <a class="btn btn-ghost" href="{{ route('members.index') }}">Cancel</a>
          <button class="btn btn-primary" type="submit">
            {{-- small plus icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 viewBox="0 0 24 24" aria-hidden="true">
              <path d="M12 5a1 1 0 011 1v5h5a1 1 0 010 2h-5v5a1 1 0 01-2 0v-5H6a1 1 0 010-2h5V6a1 1 0 011-1z"/>
            </svg>
            Save Member
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
