@extends('layouts.app')

@section('content')
<div class="lib-loans pro">
  <style>
    .lib-loans.pro{
      --bg:#f7f5f2; --ink:#0f172a; --muted:#6b7280;
      --brand:#2f855a; --brand-2:#38a169; --brand-3:#c7f9cc;
      --card:#ffffff; --ring: rgba(56,161,105,.35);
      --radius:18px; --shadow: 0 18px 50px rgba(16,24,40,.08);
      --table-border:#eef2f7; --danger:#dc2626; --amber:#b45309; --blue:#2563eb;
    }
    .lib-loans.pro .wrap{max-width:1280px;margin:clamp(12px,3vw,40px) auto;padding:clamp(8px,2vw,16px)}

    /* Hero */
    .lib-loans.pro .hero{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:18px}
    .lib-loans.pro .hero-left{display:flex;gap:12px;align-items:center}
    .lib-loans.pro .badge{
      width:56px;height:56px;border-radius:16px;display:grid;place-items:center;
      background: radial-gradient(120% 140% at 10% 10%, var(--brand-2) 0%, var(--brand) 60%, #1f6f4a 100%);
      box-shadow:0 10px 28px rgba(47,133,90,.35)
    }
    .lib-loans.pro .badge svg{width:30px;height:30px;color:#e8f5ee}
    .lib-loans.pro h1{margin:0;font-size:clamp(22px,2.4vw,28px);color:var(--ink);font-weight:800}
    .lib-loans.pro .sub{color:var(--muted);margin-top:2px;font-size:14px}

    /* Buttons */
    .lib-loans.pro .btn{
      appearance:none;border:0;padding:12px 16px;border-radius:12px;font-weight:700;cursor:pointer;
      font-size:14px;line-height:1;text-decoration:none;display:inline-flex;align-items:center;gap:8px;
      transition:transform .04s ease, box-shadow .2s ease, background .2s ease, color .2s ease
    }
    .lib-loans.pro .btn:active{transform:translateY(1px)}
    .lib-loans.pro .btn-primary{color:#fff;background:linear-gradient(180deg,var(--brand-2),var(--brand));box-shadow:0 12px 28px rgba(47,133,90,.25)}
    .lib-loans.pro .btn-ghost{background:#f1f5f9;color:#0f172a}
    .lib-loans.pro .btn-danger{background:#fee2e2;color:#7f1d1d;border:1px solid #fecaca}
    .lib-loans.pro .btn-blue{background:#eff6ff;color:#1e40af;border:1px solid #dbeafe}

    /* Cards */
    .lib-loans.pro .card{background:var(--card);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden;border:1px solid var(--table-border)}
    .lib-loans.pro .card-head{padding:16px 20px;display:flex;align-items:center;justify-content:space-between;gap:12px;background:linear-gradient(180deg,rgba(47,133,90,.06),transparent 60%);border-bottom:1px solid var(--table-border)}
    .lib-loans.pro .card-body{padding:0}

    /* Section Tabs */
    .lib-loans.pro .topnav-wrap{position:sticky;top:8px;z-index:20;margin:10px 0 18px}
    .lib-loans.pro .topnav{
      position:relative;display:flex;gap:6px;align-items:center;background:var(--card);
      border:1px solid var(--table-border);border-radius:16px;padding:6px;box-shadow:var(--shadow)
    }
    .lib-loans.pro .topnav .indicator{
      position:absolute;inset:6px auto 6px 6px;width:0;border-radius:12px;
      background:linear-gradient(180deg,var(--brand-2),var(--brand));
      box-shadow:0 8px 22px rgba(47,133,90,.25);transition:left .25s,width .25s
    }
    .lib-loans.pro .topnav .tab{
      position:relative;z-index:1;display:flex;align-items:center;gap:8px;
      padding:10px 14px;border-radius:12px;text-decoration:none;font-weight:800;
      color:#0f172a;white-space:nowrap
    }
    .lib-loans.pro .topnav .tab .ico{width:20px;height:20px;display:grid;place-items:center;color:#0f172a}
    .lib-loans.pro .topnav .tab .badge{font-size:12px;padding:2px 8px;border-radius:999px;border:1px solid #e5e7eb;background:#f8fafc;color:#334155}
    .lib-loans.pro .topnav .tab.active{color:#fff}
    .lib-loans.pro .topnav .tab.active .ico{color:#fff}
    .lib-loans.pro .topnav .tab.active .badge{background:rgba(255,255,255,.18);border-color:transparent;color:#fff}

    /* KPIs */
    .lib-loans.pro .kpis{display:grid;gap:12px;margin-bottom:12px}
    @media(min-width:900px){.lib-loans.pro .kpis{grid-template-columns:repeat(5,1fr)}}
    .lib-loans.pro .kpi{background:var(--card);border-radius:16px;border:1px solid var(--table-border);box-shadow:var(--shadow);padding:16px;display:flex;gap:12px;align-items:center}
    .lib-loans.pro .kpi .ico{width:40px;height:40px;border-radius:12px;display:grid;place-items:center;background:linear-gradient(180deg,var(--brand-3),#e6f7eb)}
    .lib-loans.pro .kpi .label{font-size:12px;color:var(--muted);text-transform:uppercase;letter-spacing:.08em}
    .lib-loans.pro .kpi .value{font-size:20px;font-weight:800;color:var(--ink)}
    .lib-loans.pro .kpi .small{font-size:12px;color:var(--muted)}

    /* Toolbar */
    .lib-loans.pro .toolbar{display:flex;gap:10px;flex-wrap:wrap;align-items:center;justify-content:space-between;margin:10px 0}
    .lib-loans.pro .search{flex:1 1 360px;display:flex;align-items:center;gap:8px;background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:10px 12px}
    .lib-loans.pro .search input{border:0;outline:0;width:100%;font-size:14px}
    .lib-loans.pro .seg{display:flex;background:#f1f5f9;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden}
    .lib-loans.pro .seg button{padding:10px 12px;border:0;background:transparent;font-weight:700;color:#475569;cursor:pointer}
    .lib-loans.pro .seg button.active{background:#fff;border:1px solid #e5e7eb;color:#0f172a}

    /* Table */
    .lib-loans.pro .table-wrap{overflow-x:auto}
    .lib-loans.pro table{width:100%;border-collapse:separate;border-spacing:0;min-width:1000px}
    .lib-loans.pro thead th{text-align:left;font-size:12px;letter-spacing:.08em;text-transform:uppercase;color:#475569;background:#f8fafc;border-bottom:1px solid var(--table-border);padding:12px 14px;position:sticky;top:0;z-index:1;cursor:pointer}
    .lib-loans.pro thead th.sortable:hover{text-decoration:underline}
    .lib-loans.pro tbody td{padding:14px;border-bottom:1px solid var(--table-border);color:#0f172a;vertical-align:middle}
    .lib-loans.pro tbody tr:hover{background:rgba(16,185,129,.06)}
    .lib-loans.pro .muted{color:var(--muted)}

    /* Chips */
    .lib-loans.pro .chip{font-size:12px;padding:4px 8px;border-radius:999px;border:1px solid #e5e7eb;background:#f8fafc;color:#334155}
    .lib-loans.pro .chip.borrowed{border-color:#bfdbfe;background:#eff6ff;color:#1e40af}
    .lib-loans.pro .chip.returned{border-color:#bbf7d0;background:#ecfdf5;color:#065f46}
    .lib-loans.pro .chip.overdue{border-color:#fecaca;background:#fee2e2;color:#7f1d1d}
    .lib-loans.pro .chip.soon{border-color:#fef3c7;background:#fffbeb;color:var(--amber)}

    /* Footer */
    .lib-loans.pro .footer{padding:14px 20px;display:flex;justify-content:space-between;align-items:center;gap:12px;border-top:1px solid var(--table-border);background:linear-gradient(180deg,transparent,rgba(15,23,42,.02))}
    .lib-loans.pro .count{color:var(--muted);font-size:14px}
    .lib-loans.pro .pagination{margin-left:auto}

    /* Flash & Errors */
    .lib-loans.pro .flash{background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0;border-radius:12px;padding:12px 14px;margin-bottom:14px}
    .lib-loans.pro .errors{background:#fff1f2;border:1px solid #fecdd3;color:#7f1d1d;padding:12px 14px;border-radius:12px;font-size:14px;margin-bottom:16px}
    .lib-loans.pro .errors ul{margin:6px 0 0 18px}

    /* Modals */
    .lib-loans.pro .modal{position:fixed;inset:0;background:rgba(15,23,42,.45);display:none;align-items:center;justify-content:center;padding:20px}
    .lib-loans.pro .modal .panel{width:100%;max-width:440px;background:#fff;border-radius:16px;border:1px solid #e5e7eb;box-shadow:var(--shadow);overflow:hidden}
    .lib-loans.pro .modal .hd{padding:16px 18px;border-bottom:1px solid #e5e7eb;font-weight:800}
    .lib-loans.pro .modal .bd{padding:18px;color:#334155}
    .lib-loans.pro .modal .ft{padding:14px 18px;border-top:1px solid #e5e7eb;display:flex;justify-content:flex-end;gap:10px}
    .lib-loans.pro .modal.show{display:flex}

    @media(max-width:900px){ .lib-loans.pro .col-returned{display:none} }
  </style>

  @php
    use Illuminate\Support\Str;
    use Illuminate\Support\Carbon;

    // Section totals for tabs
    $booksTotal   = \App\Models\Book::count();
    $membersTotal = \App\Models\Member::count();
    $loansTotal   = \App\Models\Loan::count();

    $isBooks   = request()->routeIs('books.*');
    $isMembers = request()->routeIs('members.*');
    $isLoans   = request()->routeIs('loans.*');

    $visible = is_countable($loans) ? count($loans) : ($loans->count() ?? 0);

    // KPI counts for visible list only
    $now = Carbon::now()->startOfDay();
    $soonEdge = Carbon::now()->addDays(3)->endOfDay();

    $borrowedCnt = 0; $returnedCnt = 0; $overdueCnt = 0; $dueSoonCnt = 0;
    $ageSum = 0; $ageCnt = 0;

    foreach ($loans as $ll) {
      $status = strtoupper((string)($ll->status ?? ''));
      $due = $ll->due_at instanceof Carbon ? $ll->due_at : Carbon::parse($ll->due_at);
      $borrowedAt = $ll->borrowed_at instanceof Carbon ? $ll->borrowed_at : Carbon::parse($ll->borrowed_at);

      if ($status === 'BORROWED') {
        $borrowedCnt++;
        if ($due->lt($now)) { $overdueCnt++; }
        elseif ($due->betweenIncluded($now, $soonEdge)) { $dueSoonCnt++; }
        if ($borrowedAt) { $ageSum += $borrowedAt->diffInDays($now); $ageCnt++; }
      } else {
        $returnedCnt++;
      }
    }
    $avgAge = $ageCnt ? round($ageSum / $ageCnt) : 0;
  @endphp

  <div class="wrap">
    <!-- HERO -->
    <div class="hero">
      <div class="hero-left">
        <div class="badge" aria-hidden="true">
          {{-- Loans icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M3.5 6.5H18m-9 4H18m-6 4H18M5 4l2 2-2 2"/>
          </svg>
        </div>
        <div>
          <h1>Loans Dashboard</h1>
          <div class="sub">Track borrowed items, due dates, and returns.</div>
        </div>
      </div>
      <div class="hero-actions" style="display:flex;gap:10px;flex-wrap:wrap">
        <button id="exportCsvBtn" class="btn btn-ghost" title="Export visible rows to CSV">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3a1 1 0 011 1v8.586l2.293-2.293a1 1 0 111.414 1.414l-4.007 4.007a1 1 0 01-1.414 0L7.279 11.707a1 1 0 111.414-1.414L11 12.586V4a1 1 0 011-1z"/><path d="M5 20a1 1 0 100 2h14a1 1 0 100-2H5z"/></svg>
          Export CSV
        </button>
        <a class="btn btn-primary" href="{{ route('loans.create') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
               viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5a1 1 0 011 1v5h5a1 1 0 010 2h-5v5a1 1 0 01-2 0v-5H6a1 1 0 010-2h5V6a1 1 0 011-1z"/></svg>
          Borrow
        </a>
      </div>
    </div>

    <!-- Section Tabs -->
    <div class="topnav-wrap">
      <nav class="topnav" role="tablist" aria-label="Sections">
        <div class="indicator" aria-hidden="true"></div>

        <a href="{{ route('books.index') }}" class="tab {{ $isBooks ? 'active' : '' }}" role="tab" aria-selected="{{ $isBooks ? 'true' : 'false' }}">
          <span class="ico"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M6 3h12v16H6a3 3 0 01-3-3V6a3 3 0 013-3zm0 2a1 1 0 00-1 1v11a1 1 0 001 1h10V5H6z"/></svg></span>
          <span>Books</span><span class="badge">{{ $booksTotal }}</span>
        </a>
        <a href="{{ route('members.index') }}" class="tab {{ $isMembers ? 'active' : '' }}" role="tab" aria-selected="{{ $isMembers ? 'true' : 'false' }}">
          <span class="ico"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11a4 4 0 10-8 0 4 4 0 008 0zm-9 6a6 6 0 1110 0v1H7v-1z"/></svg></span>
          <span>Members</span><span class="badge">{{ $membersTotal }}</span>
        </a>
        <a href="{{ route('loans.index') }}" class="tab {{ $isLoans ? 'active' : '' }}" role="tab" aria-selected="{{ $isLoans ? 'true' : 'false' }}">
          <span class="ico"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M6 3h12v18l-2-1-2 1-2-1-2 1-2-1-2 1V3zm2 4h8v2H8V7zm0 4h8v2H8v-2zm0 4h5v2H8v-2z"/></svg></span>
          <span>Loans</span><span class="badge">{{ $loansTotal }}</span>
        </a>
      </nav>
    </div>

    @if ($errors->any())
      <div class="errors">
        <strong>Please fix the following:</strong>
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
      </div>
    @endif
    @if (session('success'))
      <div class="flash">{{ session('success') }}</div>
    @endif

    <!-- KPIs -->
    <div class="kpis">
      <div class="kpi">
        <div class="ico" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M3 12h18v2H3zM3 6h18v2H3z"/></svg></div>
        <div><div class="label">Loans (this page)</div><div class="value">{{ $visible }}</div></div>
      </div>
      <div class="kpi">
        <div class="ico" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M6 2h12v4H6zM5 7h14v15H5z"/></svg></div>
        <div><div class="label">Borrowed</div><div class="value">{{ $borrowedCnt }}</div></div>
      </div>
      <div class="kpi">
        <div class="ico" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l9 4-9 4-9-4 9-4zm-9 7l9 4 9-4v9l-9 4-9-4V9z"/></svg></div>
        <div><div class="label">Returned</div><div class="value">{{ $returnedCnt }}</div></div>
      </div>
      <div class="kpi">
        <div class="ico" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 6v6l4 2"/></svg></div>
        <div><div class="label">Overdue</div><div class="value">{{ $overdueCnt }}</div></div>
      </div>
      <div class="kpi">
        <div class="ico" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M6 4h12v2H6zM6 8h12v2H6zM6 12h8v2H6z"/></svg></div>
        <div><div class="label">Avg loan age</div><div class="value">{{ $avgAge }}d</div><div class="small">Borrowed items</div></div>
      </div>
    </div>

    <!-- TOOLBAR -->
    <div class="toolbar">
      <div class="search" role="search">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16a6.471 6.471 0 004.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM9.5 14C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
        <input id="q" type="search" placeholder="Search member, book, ID…" aria-label="Search loans">
      </div>
      <div class="seg" role="tablist" aria-label="Quick filters">
        <button class="active" data-filter="all" role="tab" aria-selected="true">All</button>
        <button data-filter="borrowed" role="tab" aria-selected="false">Borrowed</button>
        <button data-filter="overdue" role="tab" aria-selected="false">Overdue</button>
        <button data-filter="soon" role="tab" aria-selected="false">Due soon</button>
        <button data-filter="returned" role="tab" aria-selected="false">Returned</button>
      </div>
    </div>

    <!-- TABLE -->
    <div class="card">
      <div class="card-head">
        <strong>All loans</strong>
        <span class="muted">Click a header to sort</span>
      </div>

      <div class="card-body">
        <div class="table-wrap">
          <table id="loansTable">
            <thead>
            <tr>
              <th class="sortable" data-key="id" data-type="num">ID</th>
              <th class="sortable" data-key="member" style="min-width:220px;">Member</th>
              <th class="sortable" data-key="book" style="min-width:260px;">Book</th>
              <th class="sortable" data-key="borrowedTs" data-type="num">Borrowed</th>
              <th class="sortable" data-key="dueTs" data-type="num">Due</th>
              <th class="sortable col-returned" data-key="returnedTs" data-type="num">Returned</th>
              <th class="sortable" data-key="state">Status</th>
              <th style="min-width:260px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($loans as $l)
              @php
                $status = strtoupper((string)($l->status ?? ''));
                $borrowedAt = $l->borrowed_at instanceof \Illuminate\Support\Carbon ? $l->borrowed_at : \Illuminate\Support\Carbon::parse($l->borrowed_at);
                $dueAt = $l->due_at instanceof \Illuminate\Support\Carbon ? $l->due_at : \Illuminate\Support\Carbon::parse($l->due_at);
                $returnedAt = $l->returned_at ? ($l->returned_at instanceof \Illuminate\Support\Carbon ? $l->returned_at : \Illuminate\Support\Carbon::parse($l->returned_at)) : null;

                $state = 'borrowed';
                if ($status !== 'BORROWED') { $state = 'returned'; }
                elseif ($dueAt->lt($now)) { $state = 'overdue'; }
                elseif ($dueAt->betweenIncluded($now, $soonEdge)) { $state = 'soon'; }
              @endphp
              <tr
                data-id="{{ $l->id }}"
                data-member="{{ Str::lower($l->member->name ?? '') }}"
                data-book="{{ Str::lower($l->book->title ?? '') }}"
                data-state="{{ $state }}"
                data-borrowedts="{{ $borrowedAt?->timestamp ?? 0 }}"
                data-duets="{{ $dueAt?->timestamp ?? 0 }}"
                data-returnedts="{{ $returnedAt?->timestamp ?? 0 }}"
              >
                <td class="muted">#{{ $l->id }}</td>
                <td>{{ $l->member->name }}</td>
                <td>
                  <div style="display:flex;align-items:center;gap:8px">
                    @if($state==='overdue')
                      <span class="chip overdue">Overdue</span>
                    @elseif($state==='soon')
                      <span class="chip soon">Due soon</span>
                    @endif
                    <div>{{ $l->book->title }}</div>
                  </div>
                </td>
                <td>
                  <span class="muted">{{ optional($borrowedAt)->format('Y-m-d') ?? '—' }}</span>
                  <div class="muted" data-human="borrowed">{{ optional($borrowedAt)->diffForHumans(null, true) ?? '' }}</div>
                </td>
                <td>
                  <span class="muted">{{ optional($dueAt)->format('Y-m-d') ?? '—' }}</span>
                  <div class="muted" data-human="due"></div>
                </td>
                <td class="col-returned">
                  <span class="muted">{{ optional($returnedAt)->format('Y-m-d') ?? '—' }}</span>
                </td>
                <td>
                  @if($state === 'returned')
                    <span class="chip returned">Returned</span>
                  @elseif($state === 'overdue')
                    <span class="chip overdue">Overdue</span>
                  @elseif($state === 'soon')
                    <span class="chip soon">Due soon</span>
                  @else
                    <span class="chip borrowed">Borrowed</span>
                  @endif
                </td>
                <td>
                  <div class="actions" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
                    @if(strtoupper($l->status) === 'BORROWED')
                      <form id="return-form-{{ $l->id }}" method="POST" action="{{ route('loans.return', $l) }}">
                        @csrf
                        <button type="button" class="btn btn-blue return-btn"
                                data-form="return-form-{{ $l->id }}"
                                data-title="{{ $l->book->title }}"
                                data-member="{{ $l->member->name }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                               viewBox="0 0 24 24" aria-hidden="true"><path d="M10 19l-7-7 7-7v4h8v6h-8v4z"/></svg>
                          Mark returned
                        </button>
                      </form>
                    @endif

                    <a class="btn btn-ghost" href="{{ route('loans.edit', $l) }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                           viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 15.25V19h3.75L18.81 7.94l-3.75-3.75L4 15.25zM20.71 7.04a1 1 0 000-1.41l-2.34-2.34a1 1 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                      </svg>
                      Edit
                    </a>

                    <form id="delete-form-{{ $l->id }}" method="POST" action="{{ route('loans.destroy', $l) }}">
                      @csrf @method('DELETE')
                      <button type="button" class="btn btn-danger delete-btn"
                              data-form="delete-form-{{ $l->id }}"
                              data-title="#{{ $l->id }} • {{ $l->book->title }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             viewBox="0 0 24 24" aria-hidden="true">
                          <path d="M9 3h6a1 1 0 011 1v1h4a1 1 0 010 2h-1v12a2 2 0 01-2 2H7a2 2 0 01-2-2V7H4a1 1 0 010-2h4V4a1 1 0 011-1zM7 7h10v12H7V7z"/></svg>
                        Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8">
                  <div style="padding:32px;text-align:center;color:var(--muted)">
                    No loans recorded yet.
                    <div style="margin-top:12px">
                      <a class="btn btn-primary" href="{{ route('loans.create') }}">Create first loan</a>
                    </div>
                  </div>
                </td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>

        <div class="footer">
          <div class="count">
            Showing {{ $visible }} loan(s)
            @if(method_exists($loans, 'total')) of {{ $loans->total() }} total @endif
          </div>
          <div class="pagination">
            @if(method_exists($loans, 'links')) {{ $loans->links() }} @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Return Confirm Modal -->
  <div id="returnModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="returnTitle">
    <div class="panel">
      <div class="hd" id="returnTitle">Confirm return</div>
      <div class="bd">Mark <strong id="retBook">this book</strong> as returned by <strong id="retMember">this member</strong>?</div>
      <div class="ft">
        <button id="cancelReturn" class="btn btn-ghost">Cancel</button>
        <button id="confirmReturn" class="btn btn-blue">Mark returned</button>
      </div>
    </div>
  </div>

  <!-- Delete Confirm Modal -->
  <div id="confirmModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="confirmTitle">
    <div class="panel">
      <div class="hd" id="confirmTitle">Confirm deletion</div>
      <div class="bd">Delete loan <strong id="delLoan">this record</strong>? This action cannot be undone.</div>
      <div class="ft">
        <button id="cancelDelete" class="btn btn-ghost">Cancel</button>
        <button id="confirmDelete" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>

  <script>
    (function(){
      const $  = (s, c=document)=>c.querySelector(s);
      const $$ = (s, c=document)=>Array.from(c.querySelectorAll(s));

      /* Topnav indicator */
      const topnav = $('.topnav');
      if(topnav){
        const indicator = topnav.querySelector('.indicator');
        const tabs = $$('.topnav .tab');
        const active = $('.topnav .tab.active') || tabs[0];
        function place(el){
          if(!el || !indicator) return;
          const nr = topnav.getBoundingClientRect(), r = el.getBoundingClientRect();
          indicator.style.left = (r.left - nr.left) + 'px';
          indicator.style.width = r.width + 'px';
        }
        place(active);
        window.addEventListener('resize', ()=>place($('.topnav .tab.active') || tabs[0]));
        tabs.forEach(t=>t.addEventListener('mouseenter',()=>place(t)));
        topnav.addEventListener('mouseleave', ()=>place($('.topnav .tab.active') || tabs[0]));
      }

      /* Search & filters */
      const q = $('#q');
      const segButtons = $$('.seg button');
      const rows = $$('#loansTable tbody tr');
      const normalize = s => (s||'').toString().trim().toLowerCase();
      let activeFilter = 'all';

      function humanizeDue(ts){
        if(!ts) return '';
        const d = new Date(ts*1000), today = new Date(); today.setHours(0,0,0,0);
        const other = new Date(d.getFullYear(), d.getMonth(), d.getDate());
        const diff = Math.round((other - today) / (1000*60*60*24));
        if(diff === 0) return 'due today';
        if(diff === 1) return 'due tomorrow';
        if(diff < 0) return Math.abs(diff) === 1 ? '1 day overdue' : (Math.abs(diff) + ' days overdue');
        return 'due in ' + diff + ' days';
      }

      function applyFilters(){
        const needle = normalize(q?.value);
        rows.forEach(tr=>{
          const match = !needle ||
            tr.dataset.member.includes(needle) ||
            tr.dataset.book.includes(needle) ||
            ('#'+tr.dataset.id).includes(needle);

          const state = tr.dataset.state; // borrowed | overdue | soon | returned
          const stateMatch =
            activeFilter === 'all' ||
            activeFilter === state ||
            (activeFilter === 'borrowed' && (state === 'borrowed' || state === 'overdue' || state === 'soon'));

          tr.style.display = (match && stateMatch) ? '' : 'none';

          // Update inline humanized due text
          const dueTs = parseInt(tr.dataset.duets || '0', 10);
          const dueEl = tr.querySelector('[data-human="due"]');
          if(dueEl){ dueEl.textContent = dueTs ? humanizeDue(dueTs) : ''; }
        });
      }
      q?.addEventListener('input', applyFilters);
      segButtons.forEach(btn=>{
        btn.addEventListener('click', ()=>{
          segButtons.forEach(b=>{ b.classList.remove('active'); b.setAttribute('aria-selected','false'); });
          btn.classList.add('active'); btn.setAttribute('aria-selected','true');
          activeFilter = btn.dataset.filter; applyFilters();
        });
      });

      /* Sorting */
      let sortKey=null, sortDir=1;
      $$('#loansTable thead th.sortable').forEach(th=>{
        th.addEventListener('click', ()=>{
          const key = th.dataset.key;
          const type = th.dataset.type || 'text';
          sortDir = (sortKey === key) ? -sortDir : 1; sortKey = key;
          const tbody = $('#loansTable tbody');
          const visible = rows.slice().filter(tr=>tr.style.display !== 'none');
          visible.sort((a,b)=>{
            let va = a.dataset[key.toLowerCase()], vb = b.dataset[key.toLowerCase()];
            if(type === 'num'){ va = Number(va||0); vb = Number(vb||0); }
            else { va = (va||'').toString(); vb = (vb||'').toString(); }
            if(va < vb) return -1 * sortDir;
            if(va > vb) return  1 * sortDir;
            return 0;
          });
          visible.forEach(tr=>tbody.appendChild(tr));
        });
      });

      /* CSV export (visible rows) */
      $('#exportCsvBtn')?.addEventListener('click', ()=>{
        const headers = $$('#loansTable thead th').map(th=>th.textContent.trim());
        const visibleRows = $$('#loansTable tbody tr').filter(tr=>tr.style.display !== 'none');
        if(!visibleRows.length){ alert('No rows to export.'); return; }
        const getText = td => td.textContent.replace(/\s+/g,' ').trim();
        const data = visibleRows.map(tr=>Array.from(tr.children).map(getText));
        const csv = [headers, ...data].map(row => row.map(c=>`"${(c||'').replace(/"/g,'""')}"`).join(',')).join('\r\n');
        const blob = new Blob([csv], {type:'text/csv;charset=utf-8;'}), url = URL.createObjectURL(blob);
        const a = document.createElement('a'); a.href = url;
        const ts = new Date().toISOString().slice(0,19).replace(/[:T]/g,'-');
        a.download = `loans-export-${ts}.csv`; document.body.appendChild(a); a.click(); a.remove(); URL.revokeObjectURL(url);
      });

      /* Return modal */
      const rModal = $('#returnModal'), rBook = $('#retBook'), rMember = $('#retMember'), rCancel = $('#cancelReturn'), rOK = $('#confirmReturn');
      let retFormId = null;
      $$('.return-btn').forEach(btn=>{
        btn.addEventListener('click', ()=>{
          retFormId = btn.dataset.form;
          rBook.textContent = btn.dataset.title || 'this book';
          rMember.textContent = btn.dataset.member || 'this member';
          rModal.classList.add('show');
        });
      });
      rCancel?.addEventListener('click', ()=>{ rModal.classList.remove('show'); retFormId=null; });
      rOK?.addEventListener('click', ()=>{ if(retFormId){ document.getElementById(retFormId)?.submit(); } });

      /* Delete modal */
      const dModal = $('#confirmModal'), dName = $('#delLoan'), dCancel = $('#cancelDelete'), dOK = $('#confirmDelete');
      let delFormId = null;
      $$('.delete-btn').forEach(btn=>{
        btn.addEventListener('click', ()=>{
          delFormId = btn.dataset.form;
          dName.textContent = btn.dataset.title || 'this record';
          dModal.classList.add('show');
        });
      });
      dCancel?.addEventListener('click', ()=>{ dModal.classList.remove('show'); delFormId=null; });
      dOK?.addEventListener('click', ()=>{ if(delFormId){ document.getElementById(delFormId)?.submit(); } });

      // Initialize
      applyFilters();
    })();
  </script>
</div>
@endsection
