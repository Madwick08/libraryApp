@extends('layouts.app')

@section('content')
<div class="lib-loan-edit pro">
  <style>
    .lib-loan-edit.pro{
      --bg:#f7f5f2; --ink:#0f172a; --muted:#6b7280;
      --brand:#2f855a; --brand-2:#38a169; --brand-3:#c7f9cc;
      --card:#ffffff; --ring: rgba(56,161,105,.35);
      --radius:18px; --shadow: 0 18px 50px rgba(16,24,40,.08);
      --table-border:#eef2f7; --danger:#dc2626; --amber:#b45309; --blue:#2563eb;
    }
    .lib-loan-edit.pro .wrap{max-width:1100px;margin:clamp(12px,3vw,40px) auto;padding:clamp(8px,2vw,16px)}

    /* Hero */
    .lib-loan-edit.pro .hero{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:18px}
    .lib-loan-edit.pro .hero-left{display:flex;gap:12px;align-items:center}
    .lib-loan-edit.pro .badge{
      width:56px;height:56px;border-radius:16px;display:grid;place-items:center;
      background: radial-gradient(120% 140% at 10% 10%, var(--brand-2) 0%, var(--brand) 60%, #1f6f4a 100%);
      box-shadow:0 10px 28px rgba(47,133,90,.35)
    }
    .lib-loan-edit.pro .badge svg{width:30px;height:30px;color:#e8f5ee}
    .lib-loan-edit.pro h1{margin:0;font-size:clamp(22px,2.4vw,28px);color:var(--ink);font-weight:800}
    .lib-loan-edit.pro .sub{color:var(--muted);margin-top:2px;font-size:14px}

    /* Section Tabs */
    .lib-loan-edit.pro .topnav-wrap{position:sticky;top:8px;z-index:20;margin:10px 0 18px}
    .lib-loan-edit.pro .topnav{
      position:relative;display:flex;gap:6px;align-items:center;background:var(--card);
      border:1px solid var(--table-border);border-radius:16px;padding:6px;box-shadow:var(--shadow)
    }
    .lib-loan-edit.pro .topnav .indicator{
      position:absolute;inset:6px auto 6px 6px;width:0;border-radius:12px;
      background:linear-gradient(180deg,var(--brand-2),var(--brand));
      box-shadow:0 8px 22px rgba(47,133,90,.25);transition:left .25s,width .25s
    }
    .lib-loan-edit.pro .topnav .tab{
      position:relative;z-index:1;display:flex;align-items:center;gap:8px;
      padding:10px 14px;border-radius:12px;text-decoration:none;font-weight:800;
      color:#0f172a;white-space:nowrap
    }
    .lib-loan-edit.pro .topnav .tab .ico{width:20px;height:20px;display:grid;place-items:center;color:#0f172a}
    .lib-loan-edit.pro .topnav .tab .badge{font-size:12px;padding:2px 8px;border-radius:999px;border:1px solid #e5e7eb;background:#f8fafc;color:#334155}
    .lib-loan-edit.pro .topnav .tab.active{color:#fff}
    .lib-loan-edit.pro .topnav .tab.active .ico{color:#fff}
    .lib-loan-edit.pro .topnav .tab.active .badge{background:rgba(255,255,255,.18);border-color:transparent;color:#fff}

    /* Cards & layout */
    .lib-loan-edit.pro .grid{display:grid;gap:16px}
    @media(min-width:960px){.lib-loan-edit.pro .grid{grid-template-columns:2fr 1fr}}
    .lib-loan-edit.pro .card{background:var(--card);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden;border:1px solid var(--table-border)}
    .lib-loan-edit.pro .card-head{padding:16px 20px;display:flex;align-items:center;justify-content:space-between;gap:12px;background:linear-gradient(180deg,rgba(47,133,90,.06),transparent 60%);border-bottom:1px solid var(--table-border)}
    .lib-loan-edit.pro .card-body{padding:20px}
    .lib-loan-edit.pro .side-muted{color:var(--muted);font-size:13px}

    /* Form */
    .lib-loan-edit.pro .form-grid{display:grid;gap:16px}
    @media(min-width:700px){.lib-loan-edit.pro .form-grid{grid-template-columns:1fr 1fr}.lib-loan-edit.pro .span-2{grid-column:span 2}}
    .lib-loan-edit.pro label{display:block;font-size:13px;color:#334155;margin:0 0 6px 2px;font-weight:600}
    .lib-loan-edit.pro .req::after{content:" *";color:#dc2626;font-weight:900}
    .lib-loan-edit.pro .input, .lib-loan-edit.pro select{
      width:100%;border:1px solid #e5e7eb;background:#fff;border-radius:12px;padding:12px 14px;font-size:15px;color:var(--ink);
      outline:none;transition:box-shadow .15s ease,border-color .15s ease;appearance:none
    }
    .lib-loan-edit.pro .input:focus, .lib-loan-edit.pro select:focus{border-color:var(--brand-2);box-shadow:0 0 0 6px var(--ring)}
    .lib-loan-edit.pro .mini{font-size:12px;color:#64748b}
    .lib-loan-edit.pro .picks{display:flex;gap:8px;flex-wrap:wrap}
    .lib-loan-edit.pro .pick{padding:8px 10px;border:1px solid #e5e7eb;background:#f8fafc;color:#0f172a;border-radius:10px;font-weight:700;cursor:pointer}
    .lib-loan-edit.pro .pick:hover{background:#fff}

    /* Chips & meters */
    .lib-loan-edit.pro .chip{font-size:12px;padding:4px 8px;border-radius:999px;border:1px solid #e5e7eb;background:#f8fafc;color:#334155}
    .lib-loan-edit.pro .chip.borrowed{border-color:#bfdbfe;background:#eff6ff;color:#1e40af}
    .lib-loan-edit.pro .chip.returned{border-color:#bbf7d0;background:#ecfdf5;color:#065f46}
    .lib-loan-edit.pro .chip.overdue{border-color:#fecaca;background:#fee2e2;color:#7f1d1d}
    .lib-loan-edit.pro .chip.soon{border-color:#fef3c7;background:#fffbeb;color:var(--amber)}
    .lib-loan-edit.pro .chip.low{border-color:#fef3c7;background:#fffbeb;color:var(--amber)}
    .lib-loan-edit.pro .chip.out{border-color:#fecaca;background:#fee2e2;color:#7f1d1d}
    .lib-loan-edit.pro .meter{height:10px;background:#eef2f7;border-radius:999px;overflow:hidden}
    .lib-loan-edit.pro .bar{height:100%;background:linear-gradient(90deg,var(--brand-2),var(--brand))}

    /* Actions footer */
    .lib-loan-edit.pro .actions{position:sticky;bottom:-1px;padding:14px 20px;display:flex;gap:10px;justify-content:flex-end;border-top:1px solid var(--table-border);background:linear-gradient(180deg,rgba(15,23,42,.02),#fff)}
    .lib-loan-edit.pro .btn{
      appearance:none;border:0;padding:12px 16px;border-radius:12px;font-weight:700;cursor:pointer;font-size:14px;line-height:1;text-decoration:none;display:inline-flex;align-items:center;gap:8px;
      transition:transform .04s ease, box-shadow .2s ease, background .2s ease, color .2s ease
    }
    .lib-loan-edit.pro .btn:active{transform:translateY(1px)}
    .lib-loan-edit.pro .btn-primary{color:#fff;background:linear-gradient(180deg,var(--brand-2),var(--brand));box-shadow:0 12px 28px rgba(47,133,90,.25)}
    .lib-loan-edit.pro .btn-ghost{background:#f1f5f9;color:#0f172a}
    .lib-loan-edit.pro .btn-danger{background:#fee2e2;color:#7f1d1d;border:1px solid #fecaca}
    .lib-loan-edit.pro .btn-blue{background:#eff6ff;color:#1e40af;border:1px solid #dbeafe}

    /* Flash & Errors */
    .lib-loan-edit.pro .errors{background:#fff1f2;border:1px solid #fecdd3;color:#7f1d1d;padding:12px 14px;border-radius:12px;font-size:14px;margin-bottom:16px}
    .lib-loan-edit.pro .errors ul{margin:6px 0 0 18px}
  </style>

  @php
    use Illuminate\Support\Carbon;
    // Section totals for tabs
    $booksTotal   = \App\Models\Book::count();
    $membersTotal = \App\Models\Member::count();
    $loansTotal   = \App\Models\Loan::count();

    $isBooks   = request()->routeIs('books.*');
    $isMembers = request()->routeIs('members.*');
    $isLoans   = request()->routeIs('loans.*');

    $todayStr = Carbon::now()->format('Y-m-d');
    $borrowedAt = $loan->borrowed_at instanceof Carbon ? $loan->borrowed_at : Carbon::parse($loan->borrowed_at);
    $dueValue = old('due_at', optional($loan->due_at)->format('Y-m-d'));
    $statusValue = old('status', strtoupper((string)$loan->status));
  @endphp

  <div class="wrap">
    <!-- HERO -->
    <div class="hero">
      <div class="hero-left">
        <div class="badge" aria-hidden="true">
          {{-- Edit icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 15.25V19h3.75L18.8 7.94l-3.75-3.75L4 15.25z"/>
          </svg>
        </div>
        <div>
          <h1>Edit Loan</h1>
          <div class="sub">Adjust borrower, item, due date, or status.</div>
        </div>
      </div>
      <div class="hero-actions" style="display:flex;gap:10px;flex-wrap:wrap">
        <a class="btn btn-ghost" href="{{ route('loans.index') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M10 19l-7-7 7-7v4h8v6h-8v4z"/></svg>
          Back to Loans
        </a>
        @if(strtoupper($loan->status) === 'BORROWED')
          <form id="return-form" method="POST" action="{{ route('loans.return', $loan) }}">
            @csrf
            <button type="button" id="quickReturnBtn" class="btn btn-blue">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                   viewBox="0 0 24 24" aria-hidden="true"><path d="M10 19l-7-7 7-7v4h8v6h-8v4z"/></svg>
              Mark returned
            </button>
          </form>
        @endif
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

    {{-- Validation errors --}}
    @if ($errors->any())
      <div class="errors">
        <strong>Please fix the following:</strong>
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
      </div>
    @endif

    <div class="grid">
      <!-- LEFT: Edit form -->
      <div class="card">
        <div class="card-head">
          <strong>Loan details</strong>
          <span class="side-muted">Loan ID: #{{ $loan->id }}</span>
        </div>

        <form id="loanForm" method="POST" action="{{ route('loans.update', $loan) }}" autocomplete="on">
          @csrf @method('PUT')
          <div class="card-body">
            <div class="form-grid">
              <!-- Member -->
              <div class="span-2">
                <label for="memberFilter">Member <span class="mini">(type to filter)</span></label>
                <input id="memberFilter" class="input" placeholder="Search member… (name/email/ID)">
                <select id="member_id" name="member_id" required style="margin-top:8px">
                  @foreach($members as $m)
                    <option value="{{ $m->id }}"
                            @selected($m->id==$loan->member_id)
                            data-text="{{ \Illuminate\Support\Str::lower(trim(($m->name ?? '').' '.($m->email ?? '').' '.$m->id)) }}">
                      #{{ $m->id }} — {{ $m->name }}{{ $m->email ? ' • '.$m->email : '' }}
                    </option>
                  @endforeach
                </select>
              </div>

              <!-- Book -->
              <div class="span-2">
                <label for="bookFilter" class="req">Book <span class="mini">(type to filter)</span></label>
                <input id="bookFilter" class="input" placeholder="Search book… (title/author/ISBN)">
                <select id="book_id" name="book_id" required style="margin-top:8px">
                  @foreach($books as $b)
                    @php
                      $total = (int)($b->copies_total ?? 0);
                      $avail = (int)($b->copies_available ?? 0);
                      $pct   = $total > 0 ? max(0, min(100, (int) round(($avail / $total) * 100))) : 0;
                    @endphp
                    <option value="{{ $b->id }}"
                            @selected($b->id==$loan->book_id)
                            data-title="{{ $b->title }}" data-author="{{ $b->author }}" data-isbn="{{ $b->isbn }}"
                            data-total="{{ $total }}" data-avail="{{ $avail }}" data-pct="{{ $pct }}"
                            data-text="{{ \Illuminate\Support\Str::lower(trim(($b->title ?? '').' '.($b->author ?? '').' '.($b->isbn ?? '').' '.$b->id)) }}">
                      #{{ $b->id }} — {{ $b->title }}{{ $b->author ? ' • '.$b->author : '' }} (avail: {{ $avail }})
                    </option>
                  @endforeach
                </select>
              </div>

              <!-- Dates -->
              <div>
                <label>Borrowed on</label>
                <input class="input" value="{{ optional($borrowedAt)->format('Y-m-d') }}" disabled>
                <div class="mini">Recorded date when the item was borrowed.</div>
              </div>
              <div>
                <label for="due_at" class="req">Due date</label>
                <input id="due_at" type="date" name="due_at" class="input" required value="{{ $dueValue }}">
                <div class="mini">Pick a date or use quick picks.</div>
              </div>
              <div class="span-2">
                <label>Quick picks</label>
                <div class="picks">
                  <button type="button" class="pick" data-days="7">+7 days</button>
                  <button type="button" class="pick" data-days="14">+14 days</button>
                  <button type="button" class="pick" data-days="21">+21 days</button>
                  <button type="button" class="pick" data-days="28">+28 days</button>
                </div>
              </div>

              <!-- Status -->
              <div>
                <label for="status">Status</label>
                <select id="status" name="status" class="input">
                  <option value="BORROWED" @selected($statusValue==='BORROWED')>BORROWED</option>
                  <option value="RETURNED" @selected($statusValue==='RETURNED')>RETURNED</option>
                </select>
              </div>
            </div>
          </div>

          <div class="actions">
            <a class="btn btn-ghost" href="{{ route('loans.index') }}">Cancel</a>
            <button class="btn btn-primary" id="saveBtn" type="submit">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17 3H5a2 2 0 00-2 2v14l4-4h10a2 2 0 002-2V5a2 2 0 00-2-2z"/></svg>
              Update Loan
            </button>
          </div>
        </form>
      </div>

      <!-- RIGHT: Live summary -->
      <aside>
        <div class="card">
          <div class="card-head">
            <strong>Loan summary</strong>
            <span class="side-muted">Live preview</span>
          </div>
          <div class="card-body">
            <div style="display:grid;gap:10px">
              <div style="display:flex;justify-content:space-between">
                <span class="side-muted">Member</span>
                <strong id="s-member">—</strong>
              </div>
              <div style="display:flex;justify-content:space-between">
                <span class="side-muted">Book</span>
                <strong id="s-book">—</strong>
              </div>

              <div style="display:flex;align-items:center;gap:10px">
                <span class="side-muted">Availability</span>
                <span id="s-chip" class="chip">—</span>
              </div>
              <div class="meter"><div id="s-meter" class="bar" style="width:0%"></div></div>
              <div style="display:flex;justify-content:space-between">
                <span class="side-muted">Copies available</span>
                <span id="s-avail">—</span>
              </div>

              <hr style="border:none;border-top:1px solid var(--table-border)">

              <div style="display:flex;justify-content:space-between">
                <span class="side-muted">Borrowed</span>
                <span class="side-muted">{{ optional($borrowedAt)->format('Y-m-d') ?? '—' }}</span>
              </div>
              <div style="display:flex;justify-content:space-between">
                <span class="side-muted">Due</span>
                <strong id="s-due">{{ $dueValue ?: '—' }}</strong>
              </div>
              <div class="mini" id="s-due-human">—</div>

              <div style="display:flex;justify-content:space-between">
                <span class="side-muted">Status</span>
                <span id="s-status" class="chip borrowed">Borrowed</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Danger zone --}}
        <div class="card" style="margin-top:16px">
          <div class="card-head" style="background:linear-gradient(180deg,rgba(220,38,38,.06),transparent 60%)">
            <strong>Danger zone</strong>
          </div>
          <div class="card-body" style="display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap">
            <div class="side-muted">Permanently delete this loan record.</div>
            <form id="delete-form" method="POST" action="{{ route('loans.destroy', $loan) }}">
              @csrf @method('DELETE')
              <button type="button" class="btn btn-danger" id="openDelete">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 3h6a1 1 0 011 1v1h4a1 1 0 010 2h-1v12a2 2 0 01-2 2H7a2 2 0 01-2-2V7H4a1 1 0 010-2h4V4a1 1 0 011-1z"/></svg>
                Delete loan
              </button>
            </form>
          </div>
        </div>
      </aside>
    </div>
  </div>

  <!-- Return Confirm Modal -->
  <div id="returnModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="returnTitle">
    <div class="panel">
      <div class="hd" id="returnTitle">Confirm return</div>
      <div class="bd">Mark this loan as <strong>returned</strong>?</div>
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
      <div class="bd">Delete loan <strong>#{{ $loan->id }}</strong>? This action cannot be undone.</div>
      <div class="ft">
        <button id="cancelDelete" class="btn btn-ghost">Cancel</button>
        <button id="confirmDelete" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>

  <script>
    (function(){
      const $ = (s, c=document)=>c.querySelector(s);
      const $$ = (s, c=document)=>Array.from(c.querySelectorAll(s));

      /* Section tabs indicator */
      const topnav = $('.topnav');
      if(topnav){
        const indicator = topnav.querySelector('.indicator');
        const tabs = $$('.topnav .tab');
        const active = $('.topnav .tab.active') || tabs[0];
        function place(el){ if(!el || !indicator) return;
          const nr = topnav.getBoundingClientRect(), r = el.getBoundingClientRect();
          indicator.style.left = (r.left - nr.left) + 'px';
          indicator.style.width = r.width + 'px';
        }
        place(active);
        window.addEventListener('resize', ()=>place($('.topnav .tab.active') || tabs[0]));
        tabs.forEach(t=>t.addEventListener('mouseenter',()=>place(t)));
        topnav.addEventListener('mouseleave', ()=>place($('.topnav .tab.active') || tabs[0]));
      }

      /* Elements */
      const memberFilter = $('#memberFilter');
      const bookFilter   = $('#bookFilter');
      const memberSel    = $('#member_id');
      const bookSel      = $('#book_id');
      const dueInput     = $('#due_at');
      const pickBtns     = $$('.pick');
      const statusSel    = $('#status');

      const sMember = $('#s-member'), sBook = $('#s-book'), sChip = $('#s-chip'), sMeter = $('#s-meter'), sAvail = $('#s-avail');
      const sDue = $('#s-due'), sDueHuman = $('#s-due-human'), sStatus = $('#s-status');

      /* Filter selects */
      function filterOptions(input, select){
        const needle = (input.value || '').trim().toLowerCase();
        Array.from(select.options).forEach(opt=>{
          const hay = opt.dataset.text || opt.textContent.toLowerCase();
          opt.hidden = !!needle && !hay.includes(needle);
        });
        const current = select.selectedOptions[0];
        if(current && current.hidden){
          const firstVisible = Array.from(select.options).find(o=>!o.hidden);
          if(firstVisible){ select.value = firstVisible.value; select.dispatchEvent(new Event('change')); }
        }
      }
      memberFilter?.addEventListener('input', ()=>filterOptions(memberFilter, memberSel));
      bookFilter?.addEventListener('input',   ()=>filterOptions(bookFilter,   bookSel));

      /* Quick picks for due date */
      function fmtDate(d){const p=n=>String(n).padStart(2,'0');return d.getFullYear()+'-'+p(d.getMonth()+1)+'-'+p(d.getDate());}
      pickBtns.forEach(btn=>{
        btn.addEventListener('click', ()=>{
          const days = parseInt(btn.dataset.days || '14', 10);
          const d = new Date(); d.setDate(d.getDate()+days);
          dueInput.value = fmtDate(d); updatePreview();
        });
      });

      /* Humanize due */
      function humanize(dateStr){
        if(!dateStr) return '—';
        const d = new Date(dateStr);
        const today = new Date(); today.setHours(0,0,0,0);
        const other = new Date(d.getFullYear(), d.getMonth(), d.getDate());
        const diff = Math.round((other - today) / (1000*60*60*24));
        if(diff === 0) return 'Due today';
        if(diff === 1) return 'Due tomorrow';
        if(diff < 0) return Math.abs(diff) === 1 ? '1 day overdue' : Math.abs(diff)+' days overdue';
        return 'Due in ' + diff + ' days';
      }

      /* Update preview */
      function updatePreview(){
        const m = memberSel.selectedOptions[0];
        const b = bookSel.selectedOptions[0];

        sMember.textContent = m ? m.textContent.replace(/\s+/g,' ').trim() : '—';

        if(b){
          const title = b.dataset.title || '—';
          const author = b.dataset.author ? (' • ' + b.dataset.author) : '';
          const total = parseInt(b.dataset.total || '0',10);
          const avail = parseInt(b.dataset.avail || '0',10);
          const pct   = total>0 ? Math.max(0, Math.min(100, Math.round((avail/total)*100))) : 0;

          sBook.textContent = title + author;
          sMeter.style.width = pct + '%';
          sAvail.textContent = `${avail} / ${total}`;
          sChip.className = 'chip' + (avail<=0 ? ' out' : (avail<=2 ? ' low' : ''));
          sChip.textContent = avail<=0 ? 'Out' : (avail<=2 ? 'Low' : 'OK');
        } else {
          sBook.textContent = '—';
          sMeter.style.width = '0%';
          sAvail.textContent = '—';
          sChip.className = 'chip';
          sChip.textContent = '—';
        }

        const d = dueInput.value;
        sDue.textContent = d || '—';
        sDueHuman.textContent = humanize(d);

        const val = (statusSel.value || '').toUpperCase();
        let cls = 'borrowed', txt = 'Borrowed';
        if(val === 'RETURNED'){ cls = 'returned'; txt = 'Returned'; }
        else if(sDueHuman.textContent.includes('overdue')){ cls = 'overdue'; txt = 'Overdue'; }
        else if(sDueHuman.textContent.includes('Due in') && parseInt(sDueHuman.textContent.replace(/[^0-9]/g,''),10) <= 3){ cls = 'soon'; txt = 'Due soon'; }
        sStatus.className = 'chip ' + cls; sStatus.textContent = txt;
      }

      memberSel?.addEventListener('change', updatePreview);
      bookSel?.addEventListener('change',   updatePreview);
      dueInput?.addEventListener('input',   updatePreview);
      statusSel?.addEventListener('change', updatePreview);
      updatePreview();

      /* Ctrl/Cmd+S to save */
      window.addEventListener('keydown', (e)=>{
        if((e.ctrlKey || e.metaKey) && e.key.toLowerCase()==='s'){ e.preventDefault(); $('#saveBtn')?.click(); }
      });

      /* Unsaved changes guard (optional) */
      const form = $('#loanForm'); let dirty = false;
      form?.addEventListener('input', ()=> dirty = true);
      form?.addEventListener('submit', ()=> dirty = false);
      window.addEventListener('beforeunload', (e)=>{ if(dirty){ e.preventDefault(); e.returnValue=''; } });

      /* Return modal */
      const rModal = $('#returnModal'), rCancel = $('#cancelReturn'), rOK = $('#confirmReturn');
      $('#quickReturnBtn')?.addEventListener('click', ()=> rModal.classList.add('show'));
      rCancel?.addEventListener('click', ()=> rModal.classList.remove('show'));
      rOK?.addEventListener('click', ()=> $('#return-form')?.submit());

      /* Delete modal */
      const dModal = $('#confirmModal');
      $('#openDelete')?.addEventListener('click', ()=> dModal.classList.add('show'));
      $('#cancelDelete')?.addEventListener('click', ()=> dModal.classList.remove('show'));
      $('#confirmDelete')?.addEventListener('click', ()=> $('#delete-form')?.submit());
    })();
  </script>
</div>
@endsection
