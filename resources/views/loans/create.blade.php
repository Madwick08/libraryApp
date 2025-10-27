@extends('layouts.app')

@section('content')
<div class="lib-loan-create pro">
  <style>
    .lib-loan-create.pro{
      --bg:#f7f5f2; --ink:#0f172a; --muted:#6b7280;
      --brand:#2f855a; --brand-2:#38a169; --brand-3:#c7f9cc;
      --card:#ffffff; --ring: rgba(56,161,105,.35);
      --radius:18px; --shadow: 0 18px 50px rgba(16,24,40,.08);
      --table-border:#eef2f7; --danger:#dc2626; --amber:#b45309;
    }
    .lib-loan-create.pro .wrap{max-width:1100px;margin:clamp(12px,3vw,40px) auto;padding:clamp(8px,2vw,16px)}

    /* Hero */
    .lib-loan-create.pro .hero{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:18px}
    .lib-loan-create.pro .hero-left{display:flex;gap:12px;align-items:center}
    .lib-loan-create.pro .badge{
      width:56px;height:56px;border-radius:16px;display:grid;place-items:center;
      background: radial-gradient(120% 140% at 10% 10%, var(--brand-2) 0%, var(--brand) 60%, #1f6f4a 100%);
      box-shadow:0 10px 28px rgba(47,133,90,.35)
    }
    .lib-loan-create.pro .badge svg{width:30px;height:30px;color:#e8f5ee}
    .lib-loan-create.pro h1{margin:0;font-size:clamp(22px,2.4vw,28px);color:var(--ink);font-weight:800}
    .lib-loan-create.pro .sub{color:var(--muted);margin-top:2px;font-size:14px}

    /* Section Tabs */
    .lib-loan-create.pro .topnav-wrap{position:sticky;top:8px;z-index:20;margin:10px 0 18px}
    .lib-loan-create.pro .topnav{
      position:relative;display:flex;gap:6px;align-items:center;background:var(--card);
      border:1px solid var(--table-border);border-radius:16px;padding:6px;box-shadow:var(--shadow)
    }
    .lib-loan-create.pro .topnav .indicator{
      position:absolute;inset:6px auto 6px 6px;width:0;border-radius:12px;
      background:linear-gradient(180deg,var(--brand-2),var(--brand));
      box-shadow:0 8px 22px rgba(47,133,90,.25);transition:left .25s,width .25s
    }
    .lib-loan-create.pro .topnav .tab{
      position:relative;z-index:1;display:flex;align-items:center;gap:8px;
      padding:10px 14px;border-radius:12px;text-decoration:none;font-weight:800;
      color:#0f172a;white-space:nowrap
    }
    .lib-loan-create.pro .topnav .tab .ico{width:20px;height:20px;display:grid;place-items:center;color:#0f172a}
    .lib-loan-create.pro .topnav .tab .badge{font-size:12px;padding:2px 8px;border-radius:999px;border:1px solid #e5e7eb;background:#f8fafc;color:#334155}
    .lib-loan-create.pro .topnav .tab.active{color:#fff}
    .lib-loan-create.pro .topnav .tab.active .ico{color:#fff}
    .lib-loan-create.pro .topnav .tab.active .badge{background:rgba(255,255,255,.18);border-color:transparent;color:#fff}

    /* Cards & layout */
    .lib-loan-create.pro .grid{display:grid;gap:16px}
    @media(min-width:960px){.lib-loan-create.pro .grid{grid-template-columns:2fr 1fr}}
    .lib-loan-create.pro .card{background:var(--card);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden;border:1px solid var(--table-border)}
    .lib-loan-create.pro .card-head{padding:16px 20px;display:flex;align-items:center;justify-content:space-between;gap:12px;background:linear-gradient(180deg,rgba(47,133,90,.06),transparent 60%);border-bottom:1px solid var(--table-border)}
    .lib-loan-create.pro .card-body{padding:20px}
    .lib-loan-create.pro .side-muted{color:var(--muted);font-size:13px}

    /* Form */
    .lib-loan-create.pro .form-grid{display:grid;gap:16px}
    @media(min-width:700px){.lib-loan-create.pro .form-grid{grid-template-columns:1fr 1fr}.lib-loan-create.pro .span-2{grid-column:span 2}}
    .lib-loan-create.pro label{display:block;font-size:13px;color:#334155;margin:0 0 6px 2px;font-weight:600}
    .lib-loan-create.pro .req::after{content:" *";color:#dc2626;font-weight:900}
    .lib-loan-create.pro .input, .lib-loan-create.pro select{
      width:100%;border:1px solid #e5e7eb;background:#fff;border-radius:12px;padding:12px 14px;font-size:15px;color:var(--ink);
      outline:none;transition:box-shadow .15s ease,border-color .15s ease;appearance:none
    }
    .lib-loan-create.pro .input:focus, .lib-loan-create.pro select:focus{border-color:var(--brand-2);box-shadow:0 0 0 6px var(--ring)}
    .lib-loan-create.pro .hint{margin-top:6px;color:#748096;font-size:12px}
    .lib-loan-create.pro .row-inline{display:flex;gap:10px;align-items:center;flex-wrap:wrap}
    .lib-loan-create.pro .mini{font-size:12px;color:#64748b}

    /* Quick picks */
    .lib-loan-create.pro .picks{display:flex;gap:8px;flex-wrap:wrap}
    .lib-loan-create.pro .pick{padding:8px 10px;border:1px solid #e5e7eb;background:#f8fafc;color:#0f172a;border-radius:10px;font-weight:700;cursor:pointer}
    .lib-loan-create.pro .pick:hover{background:#fff}

    /* Chips & meters */
    .lib-loan-create.pro .chip{font-size:12px;padding:4px 8px;border-radius:999px;border:1px solid #e5e7eb;background:#f8fafc;color:#334155}
    .lib-loan-create.pro .chip.low{border-color:#fef3c7;background:#fffbeb;color:var(--amber)}
    .lib-loan-create.pro .chip.out{border-color:#fecaca;background:#fee2e2;color:#7f1d1d}
    .lib-loan-create.pro .meter{height:10px;background:#eef2f7;border-radius:999px;overflow:hidden}
    .lib-loan-create.pro .bar{height:100%;background:linear-gradient(90deg,var(--brand-2),var(--brand))}

    /* Actions footer */
    .lib-loan-create.pro .actions{position:sticky;bottom:-1px;padding:14px 20px;display:flex;gap:10px;justify-content:flex-end;border-top:1px solid var(--table-border);background:linear-gradient(180deg,rgba(15,23,42,.02),#fff)}
    .lib-loan-create.pro .btn{
      appearance:none;border:0;padding:12px 16px;border-radius:12px;font-weight:700;cursor:pointer;font-size:14px;line-height:1;text-decoration:none;display:inline-flex;align-items:center;gap:8px;
      transition:transform .04s ease, box-shadow .2s ease, background .2s ease, color .2s ease
    }
    .lib-loan-create.pro .btn:active{transform:translateY(1px)}
    .lib-loan-create.pro .btn-primary{color:#fff;background:linear-gradient(180deg,var(--brand-2),var(--brand));box-shadow:0 12px 28px rgba(47,133,90,.25)}
    .lib-loan-create.pro .btn-ghost{background:#f1f5f9;color:#0f172a}
    .lib-loan-create.pro .btn-danger{background:#fee2e2;color:#7f1d1d;border:1px solid #fecaca}
    .lib-loan-create.pro .btn[disabled]{opacity:.65;cursor:not-allowed}

    /* Errors / Flash */
    .lib-loan-create.pro .errors{background:#fff1f2;border:1px solid #fecdd3;color:#7f1d1d;padding:12px 14px;border-radius:12px;font-size:14px;margin-bottom:16px}
    .lib-loan-create.pro .errors ul{margin:6px 0 0 18px}
    .lib-loan-create.pro .flash{background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0;border-radius:12px;padding:12px 14px;margin-bottom:14px}
  </style>

  @php
    // Totals for section tabs
    $booksTotal   = \App\Models\Book::count();
    $membersTotal = \App\Models\Member::count();
    $loansTotal   = \App\Models\Loan::count();

    $isBooks   = request()->routeIs('books.*');
    $isMembers = request()->routeIs('members.*');
    $isLoans   = request()->routeIs('loans.*');

    // Defaults / old values
    $oldMember = old('member_id');
    $oldBook   = old('book_id');
    $defaultDue = old('due_at', \Illuminate\Support\Carbon::now()->addDays(14)->format('Y-m-d'));
    $todayStr   = \Illuminate\Support\Carbon::now()->format('Y-m-d');
  @endphp

  <div class="wrap">
    <!-- HERO -->
    <div class="hero">
      <div class="hero-left">
        <div class="badge" aria-hidden="true">
          {{-- Loan icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M4 6h12M4 10h12M4 14h8M18 7l2 2-2 2"/>
          </svg>
        </div>
        <div>
          <h1>Borrow Book</h1>
          <div class="sub">Create a new loan for a member.</div>
        </div>
      </div>
      <div class="hero-actions" style="display:flex;gap:10px;flex-wrap:wrap">
        <a class="btn btn-ghost" href="{{ route('loans.index') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M10 19l-7-7 7-7v4h8v6h-8v4z"/></svg>
          Back to Loans
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

    {{-- Validation errors --}}
    @if ($errors->any())
      <div class="errors">
        <strong>Please fix the following:</strong>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('success'))
      <div class="flash">{{ session('success') }}</div>
    @endif

    <div class="grid">
      <!-- LEFT: Borrow form -->
      <div class="card">
        <div class="card-head">
          <strong>Borrow details</strong>
          <span class="side-muted">Fields marked * are required</span>
        </div>

        <form id="loanForm" method="POST" action="{{ route('loans.store') }}" autocomplete="on">
          @csrf
          <div class="card-body">
            <div class="form-grid">
              <!-- Member -->
              <div class="span-2">
                <label for="memberFilter">Member <span class="mini">(type to filter)</span></label>
                <div class="row-inline">
                  <input id="memberFilter" class="input" placeholder="Search member… (name/email/ID)">
                </div>
                <select id="member_id" name="member_id" required style="margin-top:8px">
                  @foreach($members as $m)
                    <option value="{{ $m->id }}"
                            {{ (string)$oldMember === (string)$m->id ? 'selected' : '' }}
                            data-text="{{ \Illuminate\Support\Str::lower(trim(($m->name ?? '').' '.($m->email ?? '').' '.$m->id)) }}">
                      #{{ $m->id }} — {{ $m->name }}{{ $m->email ? ' • '.$m->email : '' }}
                    </option>
                  @endforeach
                </select>
                <div class="hint">Choose the patron borrowing the book.</div>
              </div>

              <!-- Book -->
              <div class="span-2">
                <label for="bookFilter" class="req">Book <span class="mini">(type to filter)</span></label>
                <div class="row-inline">
                  <input id="bookFilter" class="input" placeholder="Search book… (title/author/ISBN)">
                </div>
                <select id="book_id" name="book_id" required style="margin-top:8px">
                  @foreach($books as $b)
                    @php
                      $total = (int)($b->copies_total ?? 0);
                      $avail = (int)($b->copies_available ?? 0);
                      $pct = $total > 0 ? max(0, min(100, (int) round(($avail / $total) * 100))) : 0;
                    @endphp
                    <option value="{{ $b->id }}"
                            {{ (string)$oldBook === (string)$b->id ? 'selected' : '' }}
                            data-avail="{{ $avail }}"
                            data-total="{{ $total }}"
                            data-pct="{{ $pct }}"
                            data-title="{{ $b->title }}"
                            data-author="{{ $b->author }}"
                            data-isbn="{{ $b->isbn }}"
                            data-text="{{ \Illuminate\Support\Str::lower(trim(($b->title ?? '').' '.($b->author ?? '').' '.($b->isbn ?? '').' '.$b->id)) }}"
                            {{ $avail <= 0 ? '' : '' }}>
                      #{{ $b->id }} — {{ $b->title }}{{ $b->author ? ' • '.$b->author : '' }} (avail: {{ $avail }})
                    </option>
                  @endforeach
                </select>
                <div class="hint">Availability updates automatically as loans are created/returned.</div>
              </div>

              <!-- Due date -->
              <div>
                <label for="due_at" class="req">Due date</label>
                <input id="due_at" type="date" name="due_at" class="input" required
                       min="{{ $todayStr }}" value="{{ $defaultDue }}">
                <div class="hint">Select a date or use quick picks.</div>
              </div>
              <div>
                <label>Quick picks</label>
                <div class="picks">
                  <button type="button" class="pick" data-days="7">+7 days</button>
                  <button type="button" class="pick" data-days="14">+14 days</button>
                  <button type="button" class="pick" data-days="21">+21 days</button>
                  <button type="button" class="pick" data-days="28">+28 days</button>
                </div>
                <div class="hint">Sets due date based on today.</div>
              </div>
            </div>
          </div>

          <div class="actions">
            <a class="btn btn-ghost" href="{{ route('loans.index') }}">Cancel</a>
            <button id="borrowBtn" class="btn btn-primary" type="submit">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 5a1 1 0 011 1v5h5a1 1 0 010 2h-5v5a1 1 0 01-2 0v-5H6a1 1 0 010-2h5V6a1 1 0 011-1z"/></svg>
              Borrow
            </button>
          </div>
        </form>
      </div>

      <!-- RIGHT: Loan ticket preview -->
      <aside>
        <div class="card">
          <div class="card-head">
            <strong>Loan ticket</strong>
            <span class="side-muted">Live preview</span>
          </div>
          <div class="card-body">
            <div style="display:grid;gap:10px" id="ticket">
              <div class="row-inline" style="justify-content:space-between">
                <span class="side-muted">Member</span>
                <strong id="t-member">—</strong>
              </div>
              <div class="row-inline" style="justify-content:space-between">
                <span class="side-muted">Book</span>
                <strong id="t-book">—</strong>
              </div>

              <div style="display:flex;align-items:center;gap:10px">
                <span class="side-muted">Availability</span>
                <span id="t-chip" class="chip">—</span>
              </div>
              <div class="meter" title="">
                <div class="bar" id="t-meter" style="width:0%"></div>
              </div>
              <div class="row-inline" style="justify-content:space-between">
                <span class="side-muted">Copies after loan</span>
                <span id="t-after">—</span>
              </div>

              <hr style="border:none;border-top:1px solid var(--table-border)">
              <div class="row-inline" style="justify-content:space-between">
                <span class="side-muted">Due date</span>
                <strong id="t-due">{{ $defaultDue }}</strong>
              </div>
              <div class="mini" id="t-due-human">—</div>

              <div id="t-warning" class="mini" style="color:#7f1d1d;display:none">
                Selected book is out of stock. Borrow is disabled.
              </div>
            </div>
          </div>
        </div>
      </aside>
    </div>
  </div>

  <!-- Scripts -->
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

      /* Elements */
      const memberFilter = $('#memberFilter');
      const bookFilter   = $('#bookFilter');
      const memberSel    = $('#member_id');
      const bookSel      = $('#book_id');
      const dueInput     = $('#due_at');
      const pickBtns     = $$('.pick');

      const borrowBtn    = $('#borrowBtn');
      const tMember = $('#t-member'), tBook = $('#t-book'), tChip = $('#t-chip'), tMeter = $('#t-meter'), tAfter = $('#t-after');
      const tDue = $('#t-due'), tDueHuman = $('#t-due-human'), tWarn = $('#t-warning');

      /* Filter selects (client-side) */
      function filterOptions(input, select){
        const needle = (input.value || '').trim().toLowerCase();
        Array.from(select.options).forEach(opt=>{
          const hay = opt.dataset.text || opt.textContent.toLowerCase();
          opt.hidden = !!needle && !hay.includes(needle);
        });
        // Ensure a visible option remains selected for accessibility
        const current = select.selectedOptions[0];
        if(current && current.hidden){
          const firstVisible = Array.from(select.options).find(o=>!o.hidden);
          if(firstVisible){ select.value = firstVisible.value; select.dispatchEvent(new Event('change')); }
        }
      }
      memberFilter?.addEventListener('input', ()=>filterOptions(memberFilter, memberSel));
      bookFilter?.addEventListener('input',   ()=>filterOptions(bookFilter,   bookSel));

      /* Due date quick picks */
      function fmtDate(d){
        const pad=n=>String(n).padStart(2,'0');
        return d.getFullYear()+'-'+pad(d.getMonth()+1)+'-'+pad(d.getDate());
      }
      pickBtns.forEach(btn=>{
        btn.addEventListener('click', ()=>{
          const days = parseInt(btn.dataset.days || '14', 10);
          const d = new Date(); d.setDate(d.getDate()+days);
          dueInput.value = fmtDate(d);
          updatePreview();
        });
      });

      /* Humanize due date */
      function humanize(dateStr){
        if(!dateStr) return '—';
        const d = new Date(dateStr);
        const today = new Date(); today.setHours(0,0,0,0);
        const diff = Math.round((d - today) / (1000*60*60*24));
        if(diff === 0) return 'Due today';
        if(diff === 1) return 'Due tomorrow';
        if(diff < 0) return Math.abs(diff) === 1 ? '1 day overdue' : Math.abs(diff)+' days overdue';
        return 'Due in ' + diff + ' days';
      }

      /* Preview update */
      function updatePreview(){
        const m = memberSel.selectedOptions[0];
        const b = bookSel.selectedOptions[0];
        tMember.textContent = m ? m.textContent.replace(/\s+/g,' ').trim() : '—';

        if(b){
          const avail = parseInt(b.dataset.avail||'0',10);
          const total = parseInt(b.dataset.total||'0',10);
          const pct   = total>0 ? Math.max(0, Math.min(100, Math.round((avail/total)*100))) : 0;
          const after = Math.max(0, avail-1);

          tBook.textContent = (b.dataset.title || '—') + (b.dataset.author ? (' • '+b.dataset.author) : '');
          tMeter.style.width = pct + '%';
          tAfter.textContent = `${after} / ${total}`;
          tChip.className = 'chip' + (avail<=0 ? ' out' : (avail<=2 ? ' low' : ''));
          tChip.textContent = avail<=0 ? 'Out' : (avail<=2 ? 'Low' : 'OK');

          // Disable submit if out of stock
          const out = avail <= 0;
          borrowBtn.disabled = out;
          tWarn.style.display = out ? '' : 'none';
        } else {
          tBook.textContent = '—';
          tMeter.style.width = '0%';
          tAfter.textContent = '—';
          tChip.className = 'chip';
          tChip.textContent = '—';
          borrowBtn.disabled = false;
          tWarn.style.display = 'none';
        }

        const d = dueInput.value;
        tDue.textContent = d || '—';
        tDueHuman.textContent = humanize(d);
      }

      memberSel?.addEventListener('change', updatePreview);
      bookSel?.addEventListener('change',   updatePreview);
      dueInput?.addEventListener('input',   updatePreview);

      // Init preview on load
      updatePreview();

      // Ctrl/Cmd+S to submit
      window.addEventListener('keydown', (e)=>{
        if((e.ctrlKey || e.metaKey) && e.key.toLowerCase()==='s'){
          e.preventDefault(); borrowBtn?.click();
        }
      });

      // Unsaved guard (optional)
      const form = $('#loanForm');
      let dirty = false;
      form?.addEventListener('input', ()=> dirty = true);
      form?.addEventListener('submit', ()=> dirty = false);
      window.addEventListener('beforeunload', (e)=>{
        if(dirty){ e.preventDefault(); e.returnValue=''; }
      });
    })();
  </script>
</div>
@endsection
