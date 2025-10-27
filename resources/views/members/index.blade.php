@extends('layouts.app')

@section('content')
<div class="lib-members pro">
  <style>
    .lib-members.pro{
      --bg:#f7f5f2; --ink:#0f172a; --muted:#6b7280;
      --brand:#2f855a; --brand-2:#38a169; --brand-3:#c7f9cc;
      --card:#ffffff; --ring: rgba(56,161,105,.35);
      --radius:18px; --shadow: 0 18px 50px rgba(16,24,40,.08);
      --table-border:#eef2f7; --danger:#dc2626; --amber:#b45309;
    }
    .lib-members.pro .wrap{max-width:1280px;margin:clamp(12px,3vw,40px) auto;padding:clamp(8px,2vw,16px)}

    /* Hero */
    .lib-members.pro .hero{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:18px}
    .lib-members.pro .hero-left{display:flex;gap:12px;align-items:center}
    .lib-members.pro .badge{
      width:56px;height:56px;border-radius:16px;display:grid;place-items:center;
      background: radial-gradient(120% 140% at 10% 10%, var(--brand-2) 0%, var(--brand) 60%, #1f6f4a 100%);
      box-shadow:0 10px 28px rgba(47,133,90,.35)
    }
    .lib-members.pro .badge svg{width:30px;height:30px;color:#e8f5ee}
    .lib-members.pro h1{margin:0;font-size:clamp(22px,2.4vw,28px);color:var(--ink);font-weight:800}
    .lib-members.pro .sub{color:var(--muted);margin-top:2px;font-size:14px}

    /* Buttons */
    .lib-members.pro .btn{
      appearance:none;border:0;padding:12px 16px;border-radius:12px;font-weight:700;cursor:pointer;
      font-size:14px;line-height:1;text-decoration:none;display:inline-flex;align-items:center;gap:8px;
      transition:transform .04s ease, box-shadow .2s ease, background .2s ease, color .2s ease
    }
    .lib-members.pro .btn:active{transform:translateY(1px)}
    .lib-members.pro .btn-primary{color:#fff;background:linear-gradient(180deg,var(--brand-2),var(--brand));box-shadow:0 12px 28px rgba(47,133,90,.25)}
    .lib-members.pro .btn-ghost{background:#f1f5f9;color:#0f172a}
    .lib-members.pro .btn-danger{background:#fee2e2;color:#7f1d1d;border:1px solid #fecaca}

    /* Cards */
    .lib-members.pro .card{background:var(--card);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden;border:1px solid var(--table-border)}
    .lib-members.pro .card-head{padding:16px 20px;display:flex;align-items:center;justify-content:space-between;gap:12px;background:linear-gradient(180deg,rgba(47,133,90,.06),transparent 60%);border-bottom:1px solid var(--table-border)}
    .lib-members.pro .card-body{padding:0}

    /* KPIs */
    .lib-members.pro .kpis{display:grid;gap:12px;margin-bottom:12px}
    @media(min-width:900px){.lib-members.pro .kpis{grid-template-columns:repeat(4,1fr)}}
    .lib-members.pro .kpi{background:var(--card);border-radius:16px;border:1px solid var(--table-border);box-shadow:var(--shadow);padding:16px;display:flex;gap:12px;align-items:center}
    .lib-members.pro .kpi .ico{width:40px;height:40px;border-radius:12px;display:grid;place-items:center;background:linear-gradient(180deg,var(--brand-3),#e6f7eb)}
    .lib-members.pro .kpi .label{font-size:12px;color:var(--muted);text-transform:uppercase;letter-spacing:.08em}
    .lib-members.pro .kpi .value{font-size:20px;font-weight:800;color:var(--ink)}
    .lib-members.pro .kpi .small{font-size:12px;color:var(--muted)}

    /* Toolbar */
    .lib-members.pro .toolbar{display:flex;gap:10px;flex-wrap:wrap;align-items:center;justify-content:space-between;margin:10px 0}
    .lib-members.pro .search{flex:1 1 340px;display:flex;align-items:center;gap:8px;background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:10px 12px}
    .lib-members.pro .search input{border:0;outline:0;width:100%;font-size:14px}
    .lib-members.pro .seg{display:flex;background:#f1f5f9;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden}
    .lib-members.pro .seg button{padding:10px 12px;border:0;background:transparent;font-weight:700;color:#475569;cursor:pointer}
    .lib-members.pro .seg button.active{background:#fff;border:1px solid #e5e7eb;color:#0f172a}

    /* Table */
    .lib-members.pro .table-wrap{overflow-x:auto}
    .lib-members.pro table{width:100%;border-collapse:separate;border-spacing:0;min-width:900px}
    .lib-members.pro thead th{text-align:left;font-size:12px;letter-spacing:.08em;text-transform:uppercase;color:#475569;background:#f8fafc;border-bottom:1px solid var(--table-border);padding:12px 14px;position:sticky;top:0;z-index:1;cursor:pointer}
    .lib-members.pro thead th.sortable:hover{text-decoration:underline}
    .lib-members.pro tbody td{padding:14px;border-bottom:1px solid var(--table-border);color:#0f172a;vertical-align:middle}
    .lib-members.pro tbody tr:hover{background:rgba(16,185,129,.06)}
    .lib-members.pro .muted{color:var(--muted)}
    .lib-members.pro .chip{font-size:12px;padding:4px 8px;border-radius:999px;border:1px solid #e5e7eb;background:#f8fafc;color:#334155}
    .lib-members.pro .chip.warn{border-color:#fef3c7;background:#fffbeb;color:var(--amber)}

    /* Footer */
    .lib-members.pro .footer{padding:14px 20px;display:flex;justify-content:space-between;align-items:center;gap:12px;border-top:1px solid var(--table-border);background:linear-gradient(180deg,transparent,rgba(15,23,42,.02))}
    .lib-members.pro .count{color:var(--muted);font-size:14px}
    .lib-members.pro .pagination{margin-left:auto}

    /* Flash */
    .lib-members.pro .flash{background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0;border-radius:12px;padding:12px 14px;margin-bottom:14px}

    /* Modal */
    .lib-members.pro .modal{position:fixed;inset:0;background:rgba(15,23,42,.45);display:none;align-items:center;justify-content:center;padding:20px}
    .lib-members.pro .modal .panel{width:100%;max-width:440px;background:#fff;border-radius:16px;border:1px solid #e5e7eb;box-shadow:var(--shadow);overflow:hidden}
    .lib-members.pro .modal .hd{padding:16px 18px;border-bottom:1px solid #e5e7eb;font-weight:800}
    .lib-members.pro .modal .bd{padding:18px;color:#334155}
    .lib-members.pro .modal .ft{padding:14px 18px;border-top:1px solid #e5e7eb;display:flex;justify-content:flex-end;gap:10px}
    .lib-members.pro .modal.show{display:flex}

    /* Section Topnav (Books / Members / Loans) */
    .lib-members.pro .topnav-wrap{position:sticky;top:8px;z-index:20;margin:10px 0 18px}
    .lib-members.pro .topnav{
      position:relative;display:flex;gap:6px;align-items:center;background:var(--card);
      border:1px solid var(--table-border);border-radius:16px;padding:6px;box-shadow:var(--shadow)
    }
    .lib-members.pro .topnav .indicator{
      position:absolute;inset:6px auto 6px 6px;width:0;border-radius:12px;
      background:linear-gradient(180deg,var(--brand-2),var(--brand));
      box-shadow:0 8px 22px rgba(47,133,90,.25);transition:left .25s,width .25s
    }
    .lib-members.pro .topnav .tab{
      position:relative;z-index:1;display:flex;align-items:center;gap:8px;
      padding:10px 14px;border-radius:12px;text-decoration:none;font-weight:800;
      color:#0f172a;white-space:nowrap
    }
    .lib-members.pro .topnav .tab .ico{width:20px;height:20px;display:grid;place-items:center;color:#0f172a}
    .lib-members.pro .topnav .tab .badge{font-size:12px;padding:2px 8px;border-radius:999px;border:1px solid #e5e7eb;background:#f8fafc;color:#334155}
    .lib-members.pro .topnav .tab.active{color:#fff}
    .lib-members.pro .topnav .tab.active .ico{color:#fff}
    .lib-members.pro .topnav .tab.active .badge{background:rgba(255,255,255,.18);border-color:transparent;color:#fff}

    @media(max-width:900px){ .lib-members.pro .col-email{display:none} }
  </style>

  @php
    // Visible counts (current page)
    $visible = is_countable($members) ? count($members) : ($members->count() ?? 0);
    $withEmail = 0; $noEmail = 0; $withContact = 0; $noContact = 0;
    foreach($members as $mm){
      $e = trim((string)($mm->email ?? '')); $c = trim((string)($mm->contact ?? ''));
      $e ? $withEmail++ : $noEmail++; $c ? $withContact++ : $noContact++;
    }

    // Section totals for topnav
    $membersTotal = method_exists($members,'total') ? $members->total()
                    : (is_countable($members) ? count($members) : ($members->count() ?? $visible));
    $booksTotal = \App\Models\Book::count();
    $loansTotal = \App\Models\Loan::count();

    $isBooks   = request()->routeIs('books.*');
    $isMembers = request()->routeIs('members.*');
    $isLoans   = request()->routeIs('loans.*');
  @endphp

  <div class="wrap">
    <!-- HERO -->
    <div class="hero">
      <div class="hero-left">
        <div class="badge" aria-hidden="true">
          {{-- Users icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M16 11a4 4 0 10-8 0 4 4 0 008 0zM6 19a6 6 0 1112 0v1H6v-1z"/>
          </svg>
        </div>
        <div>
          <h1>Members Dashboard</h1>
          <div class="sub">Manage patron profiles, contacts, and circulation.</div>
        </div>
      </div>

      <div class="hero-actions" style="display:flex;gap:10px;flex-wrap:wrap">
        <button id="exportCsvBtn" class="btn btn-ghost" title="Export visible rows to CSV">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3a1 1 0 011 1v8.586l2.293-2.293a1 1 0 111.414 1.414l-4.007 4.007a1 1 0 01-1.414 0L7.279 11.707a1 1 0 111.414-1.414L11 12.586V4a1 1 0 011-1z"/><path d="M5 20a1 1 0 100 2h14a1 1 0 100-2H5z"/></svg>
          Export CSV
        </button>
        <a class="btn btn-primary" href="{{ route('members.create') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
               viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5a1 1 0 011 1v5h5a1 1 0 010 2h-5v5a1 1 0 01-2 0v-5H6a1 1 0 010-2h5V6a1 1 0 011-1z"/></svg>
          New Member
        </a>
      </div>
    </div>

    <!-- Section Tabs -->
    <div class="topnav-wrap">
      <nav class="topnav" role="tablist" aria-label="Sections">
        <div class="indicator" aria-hidden="true"></div>

        <a href="{{ route('books.index') }}"
           class="tab {{ $isBooks ? 'active' : '' }}"
           role="tab" aria-selected="{{ $isBooks ? 'true' : 'false' }}">
          <span class="ico">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M6 3h12v16H6a3 3 0 01-3-3V6a3 3 0 013-3zm0 2a1 1 0 00-1 1v11a1 1 0 001 1h10V5H6z"/></svg>
          </span>
          <span>Books</span>
          <span class="badge">{{ $booksTotal }}</span>
        </a>

        <a href="{{ route('members.index') }}"
           class="tab {{ $isMembers ? 'active' : '' }}"
           role="tab" aria-selected="{{ $isMembers ? 'true' : 'false' }}">
          <span class="ico">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11a4 4 0 10-8 0 4 4 0 008 0zm-9 6a6 6 0 1110 0v1H7v-1z"/></svg>
          </span>
          <span>Members</span>
          <span class="badge">{{ $membersTotal }}</span>
        </a>

        <a href="{{ route('loans.index') }}"
           class="tab {{ $isLoans ? 'active' : '' }}"
           role="tab" aria-selected="{{ $isLoans ? 'true' : 'false' }}">
          <span class="ico">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M6 3h12v18l-2-1-2 1-2-1-2 1-2-1-2 1V3zm2 4h8v2H8V7zm0 4h8v2H8v-2zm0 4h5v2H8v-2z"/></svg>
          </span>
          <span>Loans</span>
          <span class="badge">{{ $loansTotal }}</span>
        </a>
      </nav>
    </div>

    @if (session('success'))
      <div class="flash">{{ session('success') }}</div>
    @endif

    <!-- KPIs -->
    <div class="kpis">
      <div class="kpi">
        <div class="ico" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16 11a4 4 0 10-8 0 4 4 0 008 0z"/></svg></div>
        <div><div class="label">Members (this page)</div><div class="value">{{ $visible }}</div></div>
      </div>
      <div class="kpi">
        <div class="ico" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4v16l4-2 4 2 4-2 4 2z"/></svg></div>
        <div><div class="label">With email</div><div class="value">{{ $withEmail }}</div><div class="small">{{ $noEmail }} missing</div></div>
      </div>
      <div class="kpi">
        <div class="ico" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M6 8h12v2H6zm0 4h12v2H6z"/></svg></div>
        <div><div class="label">With contact</div><div class="value">{{ $withContact }}</div><div class="small">{{ $noContact }} missing</div></div>
      </div>
      <div class="kpi">
        <div class="ico" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M3 13h18v2H3zM3 7h18v2H3zM3 17h18v2H3z"/></svg></div>
        <div><div class="label">Total (all)</div><div class="value">{{ $membersTotal }}</div></div>
      </div>
    </div>

    <!-- TOOLBAR -->
    <div class="toolbar">
      <div class="search" role="search">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16a6.471 6.471 0 004.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM9.5 14C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
        <input id="q" type="search" placeholder="Search name, email, contact…" aria-label="Search members">
      </div>
      <div class="seg" role="tablist" aria-label="Quick filters">
        <button class="active" data-filter="all" role="tab" aria-selected="true">All</button>
        <button data-filter="noemail" role="tab" aria-selected="false">Missing email</button>
        <button data-filter="nocontact" role="tab" aria-selected="false">Missing contact</button>
      </div>
    </div>

    <!-- TABLE -->
    <div class="card">
      <div class="card-head">
        <strong>Directory</strong>
        <span class="muted">Click a header to sort</span>
      </div>

      <div class="card-body">
        <div class="table-wrap">
          <table id="membersTable">
            <thead>
            <tr>
              <th class="sortable" data-key="id" data-type="num">ID</th>
              <th class="sortable" data-key="name" style="min-width:240px;">Name</th>
              <th class="sortable col-email" data-key="email">Email</th>
              <th class="sortable" data-key="contact">Contact</th>
              <th style="min-width:220px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($members as $m)
              @php
                $name = $m->name ?? '';
                $email = $m->email ?? '';
                $contact = $m->contact ?? '';
                $hasEmail = trim($email) !== '';
                $hasContact = trim($contact) !== '';
              @endphp
              <tr
                data-id="{{ $m->id }}"
                data-name="{{ \Illuminate\Support\Str::lower($name) }}"
                data-email="{{ \Illuminate\Support\Str::lower($email) }}"
                data-contact="{{ \Illuminate\Support\Str::lower($contact) }}"
                data-hasemail="{{ $hasEmail ? '1' : '0' }}"
                data-hascontact="{{ $hasContact ? '1' : '0' }}"
              >
                <td class="muted">#{{ $m->id }}</td>
                <td>
                  <div style="display:flex;align-items:center;gap:8px">
                    @if(!$hasEmail)
                      <span class="chip warn">No email</span>
                    @elseif(!$hasContact)
                      <span class="chip warn">No contact</span>
                    @endif
                    <div>{{ $name }}</div>
                  </div>
                </td>
                <td class="muted col-email">{{ $email ?: '—' }}</td>
                <td>{{ $contact ?: '—' }}</td>
                <td>
                  <div class="actions" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
                    <a class="btn btn-ghost" href="{{ route('members.edit', $m) }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                           viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 15.25V19h3.75L18.81 7.94l-3.75-3.75L4 15.25zM20.71 7.04a1 1 0 000-1.41l-2.34-2.34a1 1 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                      </svg>
                      Edit
                    </a>

                    {{-- Delete using modal confirmation --}}
                    <form id="delete-form-{{ $m->id }}" method="POST" action="{{ route('members.destroy', $m) }}">
                      @csrf @method('DELETE')
                      <button type="button" class="btn btn-danger delete-btn"
                              data-form="delete-form-{{ $m->id }}"
                              data-title="{{ $name }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             viewBox="0 0 24 24" aria-hidden="true">
                          <path d="M9 3h6a1 1 0 011 1v1h4a1 1 0 010 2h-1v12a2 2 0 01-2 2H7a2 2 0 01-2-2V7H4a1 1 0 010-2h4V4a1 1 0 011-1zM7 7h10v12H7V7z"/>
                        </svg>
                        Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5">
                  <div class="empty" style="padding:32px;text-align:center;color:var(--muted)">
                    No members yet. Add your first member.
                    <div style="margin-top:12px">
                      <a class="btn btn-primary" href="{{ route('members.create') }}">Add member</a>
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
            Showing {{ $visible }} member(s)
            @if(method_exists($members, 'total')) of {{ $members->total() }} total @endif
          </div>
          <div class="pagination">
            @if(method_exists($members, 'links')) {{ $members->links() }} @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Confirm Modal -->
  <div id="confirmModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="confirmTitle">
    <div class="panel">
      <div class="hd" id="confirmTitle">Confirm deletion</div>
      <div class="bd">Are you sure you want to delete <strong id="confirmMemberName">this member</strong>? This action cannot be undone.</div>
      <div class="ft">
        <button id="cancelDelete" class="btn btn-ghost">Cancel</button>
        <button id="confirmDelete" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>

  <script>
    (function(){
      const $ = (sel, ctx=document)=>ctx.querySelector(sel);
      const $$ = (sel, ctx=document)=>Array.from(ctx.querySelectorAll(sel));

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

      /* Search & Filters */
      const q = $('#q');
      const segButtons = $$('.seg button');
      const rows = $$('#membersTable tbody tr');
      const normalize = s => (s||'').toString().trim().toLowerCase();
      let activeFilter = 'all';
      function applyFilters(){
        const needle = normalize(q?.value);
        rows.forEach(tr=>{
          const match = !needle ||
            tr.dataset.name.includes(needle) ||
            tr.dataset.email.includes(needle) ||
            tr.dataset.contact.includes(needle);

          const hasEmail = tr.dataset.hasemail === '1';
          const hasContact = tr.dataset.hascontact === '1';
          const filterMatch =
            activeFilter === 'all' ||
            (activeFilter === 'noemail' && !hasEmail) ||
            (activeFilter === 'nocontact' && !hasContact);

          tr.style.display = (match && filterMatch) ? '' : 'none';
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
      $$('#membersTable thead th.sortable').forEach(th=>{
        th.addEventListener('click', ()=>{
          const key = th.dataset.key;
          const type = th.dataset.type || 'text';
          sortDir = (sortKey === key) ? -sortDir : 1; sortKey = key;
          const tbody = $('#membersTable tbody');
          const visible = rows.slice().filter(tr=>tr.style.display !== 'none');
          visible.sort((a,b)=>{
            let va = a.dataset[key], vb = b.dataset[key];
            if(type === 'num'){ va = Number(va||0); vb = Number(vb||0); }
            else { va = (va||'').toString(); vb = (vb||'').toString(); }
            if(va < vb) return -1 * sortDir;
            if(va > vb) return  1 * sortDir;
            return 0;
          });
          visible.forEach(tr=>tbody.appendChild(tr));
        });
      });

      /* Export CSV (visible rows) */
      $('#exportCsvBtn')?.addEventListener('click', ()=>{
        const headers = $$('#membersTable thead th').map(th=>th.textContent.trim());
        const visibleRows = $$('#membersTable tbody tr').filter(tr=>tr.style.display !== 'none');
        if(!visibleRows.length){ alert('No rows to export.'); return; }
        const getText = td => td.textContent.replace(/\s+/g,' ').trim();
        const data = visibleRows.map(tr=>Array.from(tr.children).map(getText));
        const csv = [headers, ...data].map(row => row.map(c=>`"${(c||'').replace(/"/g,'""')}"`).join(',')).join('\r\n');
        const blob = new Blob([csv], {type:'text/csv;charset=utf-8;'}), url = URL.createObjectURL(blob);
        const a = document.createElement('a'); a.href = url;
        const ts = new Date().toISOString().slice(0,19).replace(/[:T]/g,'-');
        a.download = `members-export-${ts}.csv`; document.body.appendChild(a); a.click(); a.remove(); URL.revokeObjectURL(url);
      });

      /* Delete modal */
      const modal = $('#confirmModal'), nameEl = $('#confirmMemberName'), cancelBtn = $('#cancelDelete'), okBtn = $('#confirmDelete');
      let pendingFormId = null;
      $$('.delete-btn').forEach(btn=>{
        btn.addEventListener('click', ()=>{
          pendingFormId = btn.dataset.form; nameEl.textContent = btn.dataset.title || 'this member';
          modal.classList.add('show');
        });
      });
      cancelBtn?.addEventListener('click', ()=>{ modal.classList.remove('show'); pendingFormId=null; });
      okBtn?.addEventListener('click', ()=>{ if(pendingFormId){ document.getElementById(pendingFormId)?.submit(); } });
      modal?.addEventListener('click', (e)=>{ if(e.target === modal){ modal.classList.remove('show'); } });

      applyFilters();
    })();
  </script>
</div>
@endsection
