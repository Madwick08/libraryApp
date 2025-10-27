<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','Library TPS')</title>

  <style>
    /* ===== Design tokens (shared across pages) ===== */
    :root{
      --bg:#f7f5f2;
      --ink:#0f172a;
      --muted:#6b7280;
      --brand:#2f855a;
      --brand-2:#38a169;
      --brand-3:#c7f9cc;
      --card:#ffffff;
      --ring: rgba(56,161,105,.35);
      --radius:18px;
      --shadow: 0 18px 50px rgba(16,24,40,.08);
      --border:#eef2f7;
      --danger:#dc2626;
      --amber:#b45309;
      --blue:#2563eb;
    }

    /* ===== Base ===== */
    html,body{height:100%}
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
      color:var(--ink);
      background: radial-gradient(140% 100% at 0% 0%, #f3faf5 0%, var(--bg) 40%, var(--bg) 100%);
    }
    a{color:inherit;text-decoration:none}
    a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible{
      outline: 2px solid transparent;
      box-shadow: 0 0 0 6px var(--ring);
      border-radius: 12px;
    }

    .wrap{max-width:1280px;margin:clamp(12px,3vw,40px) auto;padding:clamp(8px,2vw,16px)}
    .content{margin-top:16px}

    /* ===== Topbar ===== */
    .topbar{
      position:sticky; top:0; z-index:50;
      background:var(--card);
      border-bottom:1px solid var(--border);
      box-shadow: 0 10px 30px rgba(16,24,40,.06);
      backdrop-filter: saturate(120%) blur(4px);
    }
    .topbar .inner{
      display:flex; align-items:center; justify-content:space-between; gap:16px;
      height:64px;
    }
    .brand{display:flex; align-items:center; gap:10px; font-weight:800}
    .brand .badge{
      width:42px;height:42px;border-radius:12px;display:grid;place-items:center;
      background: radial-gradient(120% 140% at 10% 10%, var(--brand-2) 0%, var(--brand) 60%, #1f6f4a 100%);
      box-shadow:0 10px 28px rgba(47,133,90,.35)
    }
    .brand .badge svg{width:22px;height:22px;color:#e8f5ee}
    .brand small{display:block;color:var(--muted);font-weight:600;margin-top:2px}

    /* ===== Section Tabs (Books / Members / Loans) ===== */
    .topnav{
      position:relative; display:flex; align-items:center; gap:6px;
      background:var(--card); border:1px solid var(--border); border-radius:16px; padding:6px;
      box-shadow:var(--shadow); overflow:auto; max-width:100%;
    }
    .topnav::-webkit-scrollbar{height:0}
    .topnav .indicator{
      position:absolute; inset:6px auto 6px 6px; width:0; border-radius:12px;
      background:linear-gradient(180deg,var(--brand-2),var(--brand));
      box-shadow:0 8px 22px rgba(47,133,90,.25);
      transition:left .25s,width .25s;
      pointer-events:none;
    }
    .topnav .tab{
      position:relative; z-index:1;
      display:inline-flex; align-items:center; gap:8px;
      padding:10px 14px; border-radius:12px; font-weight:800; white-space:nowrap; color:#0f172a;
      /* make sure the tab never “disappears” due to hover/focus styles */
      visibility:visible;
    }
    .topnav .tab .ico{width:18px;height:18px;display:grid;place-items:center}
    .topnav .tab .badge{font-size:12px;padding:2px 8px;border-radius:999px;border:1px solid #e5e7eb;background:#f8fafc;color:#334155}
    .topnav .tab.active{color:#fff}
    .topnav .tab.active .ico{color:#fff}
    .topnav .tab.active .badge{background:rgba(255,255,255,.18);border-color:transparent;color:#fff}

    /* ===== Buttons (shared) ===== */
    .btn{
      appearance:none; border:0; padding:10px 14px; border-radius:12px; font-weight:700; cursor:pointer;
      font-size:14px; line-height:1; text-decoration:none; display:inline-flex; align-items:center; gap:8px;
      transition: transform .04s ease, box-shadow .2s ease, background .2s ease, color .2s ease;
    }
    .btn:active{ transform: translateY(1px) }
    .btn-primary{ color:#fff; background:linear-gradient(180deg,var(--brand-2),var(--brand)); box-shadow:0 12px 28px rgba(47,133,90,.25) }
    .btn-ghost{ background:#f1f5f9; color:#0f172a }
    .btn-danger{ background:#fee2e2; color:#7f1d1d; border:1px solid #fecaca }
    .btn-blue{ background:#eff6ff; color:#1e40af; border:1px solid #dbeafe }

    /* ===== Cards & Tables (shared) ===== */
    .card{ background:var(--card); border-radius:var(--radius); border:1px solid var(--border); box-shadow:var(--shadow); overflow:hidden }
    .card-head{ padding:16px 20px; display:flex; align-items:center; justify-content:space-between; gap:12px;
      background:linear-gradient(180deg,rgba(47,133,90,.06),transparent 60%); border-bottom:1px solid var(--border) }
    .card-body{ padding:20px }

    .table-wrap{ overflow-x:auto }
    table.table{ width:100%; border-collapse:separate; border-spacing:0; min-width:900px }
    .table thead th{
      text-align:left; font-size:12px; letter-spacing:.08em; text-transform:uppercase; color:#475569;
      background:#f8fafc; border-bottom:1px solid var(--border); padding:12px 14px; position:sticky; top:0; z-index:1;
    }
    .table tbody td{ padding:14px; border-bottom:1px solid var(--border); color:#0f172a; vertical-align:middle }
    .table tbody tr:hover{ background:rgba(16,185,129,.06) }

    /* ===== Flash / Errors ===== */
    .flash{ background:#ecfdf5; color:#065f46; border:1px solid #a7f3d0; border-radius:12px; padding:12px 14px; margin:14px 0 }
    .errors{ background:#fff1f2; border:1px solid #fecdd3; color:#7f1d1d; border-radius:12px; padding:12px 14px; margin:14px 0 }

    /* ===== Footer ===== */
    .site-footer{ color:var(--muted); font-size:12px; padding:20px 0; border-top:1px solid var(--border); margin-top:24px }
  </style>

  @stack('styles')
</head>
<body>
  @php
    // Active states & counts (safe if models/tables exist)
    $isBooks   = request()->routeIs('books.*');
    $isMembers = request()->routeIs('members.*');
    $isLoans   = request()->routeIs('loans.*');

    try {
      $booksTotal   = \App\Models\Book::count();
      $membersTotal = \App\Models\Member::count();
      $loansTotal   = \App\Models\Loan::count();
    } catch (\Throwable $e) {
      $booksTotal = $membersTotal = $loansTotal = null;
    }
  @endphp

  <!-- ===== TOPBAR ===== -->
  <header class="topbar">
    <div class="wrap inner">
      <div class="brand">
        <div class="badge" aria-hidden="true">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M3 5.25A2.25 2.25 0 015.25 3H18v16.5H5.25A2.25 2.25 0 013 17.25V5.25zM6 3v14.25M9 7.5h7.5M9 10.5h7.5"/>
          </svg>
        </div>
        <div>
          <div>Library TPS</div>
          <small>Clean & modern dashboard</small>
        </div>
      </div>

      <!-- PERSISTENT TABS -->
      <nav class="topnav" role="tablist" aria-label="Sections">
        <div class="indicator" aria-hidden="true"></div>

        <a href="{{ route('books.index') }}" class="tab {{ $isBooks ? 'active' : '' }}" role="tab" aria-selected="{{ $isBooks ? 'true' : 'false' }}">
          <span class="ico">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M6 3h12v16H6a3 3 0 01-3-3V6a3 3 0 013-3zm0 2a1 1 0 00-1 1v11a1 1 0 001 1h10V5H6z"/></svg>
          </span>
          <span>Books</span>
          @if(!is_null($booksTotal)) <span class="badge">{{ $booksTotal }}</span> @endif
        </a>

        <a href="{{ route('members.index') }}" class="tab {{ $isMembers ? 'active' : '' }}" role="tab" aria-selected="{{ $isMembers ? 'true' : 'false' }}">
          <span class="ico">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11a4 4 0 10-8 0 4 4 0 008 0zm-9 6a6 6 0 1110 0v1H7v-1z"/></svg>
          </span>
          <span>Members</span>
          @if(!is_null($membersTotal)) <span class="badge">{{ $membersTotal }}</span> @endif
        </a>

        <a href="{{ route('loans.index') }}" class="tab {{ $isLoans ? 'active' : '' }}" role="tab" aria-selected="{{ $isLoans ? 'true' : 'false' }}">
          <span class="ico">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M6 3h12v18l-2-1-2 1-2-1-2 1-2-1-2 1V3zm2 4h8v2H8V7zm0 4h8v2H8v-2zm0 4h5v2H8v-2z"/></svg>
          </span>
          <span>Loans</span>
          @if(!is_null($loansTotal)) <span class="badge">{{ $loansTotal }}</span> @endif
        </a>
      </nav>
    </div>
  </header>

  <!-- ===== MAIN ===== -->
  <main class="wrap content">
    @if(session('success'))
      <div class="flash">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="errors">
        <strong>Please fix the following:</strong>
        <div>{{ $errors->first() }}</div>
      </div>
    @endif

    @yield('content')

    <footer class="site-footer">
      © {{ date('Y') }} Library TPS · Crafted with care.
    </footer>
  </main>

  <script>
    // Robust indicator + optimistic active so clicked tab stays visible even before navigation completes
    (function(){
      const topnav = document.querySelector('.topnav');
      if(!topnav) return;
      const indicator = topnav.querySelector('.indicator');
      const tabs = Array.from(topnav.querySelectorAll('.tab'));

      const getActive = () => topnav.querySelector('.tab.active') || tabs[0];

      function place(el){
        if(!el || !indicator) return;
        // use layout box + scroll position so it doesn't jump when nav scrolls
        const nr = topnav.getBoundingClientRect();
        const r  = el.getBoundingClientRect();
        indicator.style.left  = (r.left - nr.left + topnav.scrollLeft) + 'px';
        indicator.style.width = r.width + 'px';
      }

      // Initial (after fonts/layout)
      requestAnimationFrame(()=>place(getActive()));

      // Re-position on resize/scroll/back-forward cache restore
      window.addEventListener('resize', ()=>place(getActive()));
      window.addEventListener('pageshow', ()=>place(getActive()));
      topnav.addEventListener('scroll', ()=>place(getActive()));

      // Hover/focus preview
      tabs.forEach(t=>{
        t.addEventListener('mouseenter', ()=>place(t));
        t.addEventListener('focus', ()=>place(t));
        // Optimistic active: keep the clicked tab highlighted until next page renders
        t.addEventListener('click', ()=>{
          tabs.forEach(x=>x.classList.remove('active'));
          t.classList.add('active');
          place(t);
          // allow navigation to proceed
        });
      });

      // When leaving hover, snap back to true active (server-rendered on next page)
      topnav.addEventListener('mouseleave', ()=>place(getActive()));
    })();
  </script>

  @stack('scripts')
</body>
</html>
