@extends('layouts.app')

@section('content')
<div class="lib-edit pro">
  <style>
    .lib-edit.pro{
      --bg:#f7f5f2; --ink:#0f172a; --muted:#6b7280;
      --brand:#2f855a; --brand-2:#38a169; --brand-3:#c7f9cc;
      --card:#ffffff; --ring: rgba(56,161,105,.35);
      --radius:18px; --shadow: 0 18px 50px rgba(16,24,40,.08);
      --table-border:#eef2f7; --danger:#dc2626; --amber:#b45309;
    }
    .lib-edit.pro .wrap{max-width:1100px;margin:clamp(12px,3vw,40px) auto;padding:clamp(8px,2vw,16px)}

    /* Hero */
    .lib-edit.pro .hero{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:18px}
    .lib-edit.pro .hero-left{display:flex;gap:12px;align-items:center}
    .lib-edit.pro .badge{width:56px;height:56px;border-radius:16px;display:grid;place-items:center;
      background:radial-gradient(120% 140% at 10% 10%, var(--brand-2) 0%, var(--brand) 60%, #1f6f4a 100%);
      box-shadow:0 10px 28px rgba(47,133,90,.35)}
    .lib-edit.pro .badge svg{width:30px;height:30px;color:#e8f5ee}
    .lib-edit.pro h1{margin:0;font-size:clamp(22px,2.4vw,28px);color:var(--ink);font-weight:800}
    .lib-edit.pro .sub{color:var(--muted);margin-top:2px;font-size:14px}

    /* Buttons */
    .lib-edit.pro .btn{
      appearance:none;border:0;padding:12px 16px;border-radius:12px;font-weight:700;cursor:pointer;
      font-size:14px;line-height:1;text-decoration:none;display:inline-flex;align-items:center;gap:8px;
      transition:transform .04s ease, box-shadow .2s ease, background .2s ease, color .2s ease
    }
    .lib-edit.pro .btn:active{transform:translateY(1px)}
    .lib-edit.pro .btn-primary{color:#fff;background:linear-gradient(180deg,var(--brand-2),var(--brand));box-shadow:0 12px 28px rgba(47,133,90,.25)}
    .lib-edit.pro .btn-ghost{background:#f1f5f9;color:#0f172a}
    .lib-edit.pro .btn-danger{background:#fee2e2;color:#7f1d1d;border:1px solid #fecaca}

    /* Cards & layout */
    .lib-edit.pro .grid{display:grid;gap:16px}
    @media(min-width:960px){.lib-edit.pro .grid{grid-template-columns:2fr 1fr}}
    .lib-edit.pro .card{background:var(--card);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden;border:1px solid var(--table-border)}
    .lib-edit.pro .card-head{padding:16px 20px;display:flex;align-items:center;justify-content:space-between;gap:12px;background:linear-gradient(180deg,rgba(47,133,90,.06),transparent 60%);border-bottom:1px solid var(--table-border)}
    .lib-edit.pro .card-body{padding:20px}
    .lib-edit.pro .side-muted{color:var(--muted);font-size:13px}

    /* Form */
    .lib-edit.pro .form-grid{display:grid;gap:16px}
    @media(min-width:700px){.lib-edit.pro .form-grid{grid-template-columns:1fr 1fr}.lib-edit.pro .span-2{grid-column:span 2}}
    .lib-edit.pro label{display:block;font-size:13px;color:#334155;margin:0 0 6px 2px;font-weight:600}
    .lib-edit.pro .req::after{content:" *";color:#dc2626;font-weight:900}
    .lib-edit.pro .input{width:100%;border:1px solid #e5e7eb;background:#fff;border-radius:12px;padding:12px 14px;font-size:15px;color:var(--ink);outline:none;transition:box-shadow .15s ease,border-color .15s ease}
    .lib-edit.pro .input:focus{border-color:var(--brand-2);box-shadow:0 0 0 6px var(--ring)}
    .lib-edit.pro .hint{margin-top:6px;color:#748096;font-size:12px}
    .lib-edit.pro .errors{background:#fff1f2;border:1px solid #fecdd3;color:#7f1d1d;padding:12px 14px;border-radius:12px;font-size:14px;margin-bottom:16px}

    /* Sticky action footer inside form card */
    .lib-edit.pro .actions{position:sticky;bottom:-1px;padding:14px 20px;display:flex;gap:10px;justify-content:flex-end;border-top:1px solid var(--table-border);background:linear-gradient(180deg,rgba(15,23,42,.02),#fff)}

    /* Preview / status */
    .lib-edit.pro .meter{height:10px;background:#eef2f7;border-radius:999px;overflow:hidden}
    .lib-edit.pro .bar{height:100%;background:linear-gradient(90deg,var(--brand-2),var(--brand))}
    .lib-edit.pro .meta{display:grid;gap:8px}
    .lib-edit.pro .meta .row{display:flex;justify-content:space-between;gap:8px}
    .lib-edit.pro .chip{font-size:12px;padding:4px 8px;border-radius:999px;border:1px solid #e5e7eb;background:#f8fafc;color:#334155}
    .lib-edit.pro .chip.low{border-color:#fef3c7;background:#fffbeb;color:var(--amber)}
    .lib-edit.pro .chip.out{border-color:#fecaca;background:#fee2e2;color:#7f1d1d}

    /* Danger zone */
    .lib-edit.pro .danger{margin-top:16px}
    .lib-edit.pro .danger .card-head{background:linear-gradient(180deg,rgba(220,38,38,.06),transparent 60%)}

    /* Modal */
    .lib-edit.pro .modal{position:fixed;inset:0;background:rgba(15,23,42,.45);display:none;align-items:center;justify-content:center;padding:20px}
    .lib-edit.pro .modal .panel{width:100%;max-width:440px;background:#fff;border-radius:16px;border:1px solid #e5e7eb;box-shadow:var(--shadow);overflow:hidden}
    .lib-edit.pro .modal .hd{padding:16px 18px;border-bottom:1px solid #e5e7eb;font-weight:800}
    .lib-edit.pro .modal .bd{padding:18px;color:#334155}
    .lib-edit.pro .modal .ft{padding:14px 18px;border-top:1px solid #e5e7eb;display:flex;justify-content:flex-end;gap:10px}
    .lib-edit.pro .modal.show{display:flex}
  </style>

  @php
    $title = old('title', $book->title);
    $author = old('author', $book->author);
    $isbn = old('isbn', $book->isbn);
    $year = old('published_year', $book->published_year);
    $total = (int) old('copies_total', $book->copies_total);
    $avail = (int) ($book->copies_available ?? 0);
    $pct = $total > 0 ? max(0, min(100, (int) round(($avail / $total) * 100))) : 0;
    $low = $avail > 0 && $avail <= 2;
    $out = $avail <= 0;
  @endphp

  <div class="wrap">
    <!-- HERO -->
    <div class="hero">
      <div class="hero-left">
        <div class="badge" aria-hidden="true">
          {{-- Pencil / book icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M3 5.25A2.25 2.25 0 015.25 3H18v16.5H5.25A2.25 2.25 0 013 17.25V5.25zM6 3v14.25M9 7.5h7.5M9 10.5h7.5"/>
          </svg>
        </div>
        <div>
          <h1>Edit Book</h1>
          <div class="sub">Update title details and catalog info.</div>
        </div>
      </div>
      <div class="hero-actions" style="display:flex;gap:10px;flex-wrap:wrap">
        <a class="btn btn-ghost" href="{{ route('books.index') }}">
          {{-- back icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M10 19l-7-7 7-7v4h8v6h-8v4z"/></svg>
          Back to list
        </a>
      </div>
    </div>

    {{-- Validation errors --}}
    @if ($errors->any())
      <div class="errors">
        <strong>Please fix the following:</strong>
        <ul style="margin:6px 0 0 18px">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="grid">
      <!-- LEFT: Edit form -->
      <div class="card">
        <div class="card-head">
          <strong>Edit details</strong>
          <span class="side-muted">Book ID: #{{ $book->id }}</span>
        </div>

        <form id="editForm" method="POST" action="{{ route('books.update', $book) }}" autocomplete="on">
          @csrf @method('PUT')

          <div class="card-body">
            <div class="form-grid">
              <div class="span-2">
                <label for="title" class="req">Title</label>
                <input id="title" name="title" class="input" required
                       placeholder="e.g., Clean Code"
                       value="{{ $title }}">
                <div class="hint">Use the exact title as it appears on the cover.</div>
              </div>

              <div>
                <label for="author">Author</label>
                <input id="author" name="author" class="input"
                       placeholder="e.g., Robert C. Martin"
                       value="{{ $author }}">
              </div>

              <div>
                <label for="isbn">ISBN</label>
                <input id="isbn" name="isbn" class="input"
                       placeholder="e.g., 9780132350884"
                       value="{{ $isbn }}">
                <div class="hint">13-digit preferred (no dashes required).</div>
              </div>

              <div>
                <label for="published_year">Published year</label>
                <input id="published_year" type="number" name="published_year" class="input"
                       placeholder="e.g., 2008" inputmode="numeric" min="1400" max="2100" step="1"
                       value="{{ $year }}">
              </div>

              <div>
                <label for="copies_total" class="req">Total copies</label>
                <input id="copies_total" type="number" name="copies_total" class="input"
                       min="1" step="1" required value="{{ $total }}">
                <div class="hint">How many physical copies your library owns.</div>
              </div>
            </div>
          </div>

          <div class="actions">
            <button type="reset" class="btn btn-ghost" id="resetBtn">Reset</button>
            <button type="submit" class="btn btn-primary" id="saveBtn">
              {{-- save icon --}}
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17 3H5a2 2 0 00-2 2v14l4-4h10a2 2 0 002-2V5a2 2 0 00-2-2z"/></svg>
              Update Book
            </button>
          </div>
        </form>
      </div>

      <!-- RIGHT: Preview & status -->
      <aside>
        <div class="card">
          <div class="card-head">
            <strong>Preview</strong>
            <span class="side-muted">Live as you type</span>
          </div>
          <div class="card-body">
            <div class="meta" id="preview">
              <div class="row"><span class="side-muted">Title</span><strong id="p-title">{{ $title ?: '—' }}</strong></div>
              <div class="row"><span class="side-muted">Author</span><span id="p-author">{{ $author ?: '—' }}</span></div>
              <div class="row"><span class="side-muted">ISBN</span><span id="p-isbn">{{ $isbn ?: '—' }}</span></div>
              <div class="row"><span class="side-muted">Published</span><span id="p-year">{{ $year ?: '—' }}</span></div>
              <hr style="border:none;border-top:1px solid var(--table-border);margin:8px 0">
              <div class="row" style="align-items:center;gap:10px">
                <span class="side-muted">Availability</span>
                <span>
                  @if($out)<span class="chip out">Out</span>
                  @elseif($low)<span class="chip low">Low</span>
                  @else <span class="chip">OK</span>@endif
                </span>
              </div>
              <div class="meter" title="{{ $pct }}%">
                <div class="bar" id="p-meter" style="width: {{ $pct }}%"></div>
              </div>
              <div class="row"><span class="side-muted">Copies</span>
                <span><strong id="p-total">{{ $total }}</strong> total • <strong id="p-avail">{{ $avail }}</strong> available</span>
              </div>
              <div class="hint">Available is computed from loans; it isn’t edited here.</div>
            </div>
          </div>
        </div>

        {{-- Optional: Danger zone for delete --}}
        <div class="card danger">
          <div class="card-head">
            <strong>Danger zone</strong>
          </div>
          <div class="card-body" style="display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap">
            <div class="side-muted">Permanently remove this book and its history.</div>
            <form id="delete-form" method="POST" action="{{ route('books.destroy', $book) }}">
              @csrf @method('DELETE')
              <button type="button" class="btn btn-danger" id="openDelete">
                {{-- trash icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 3h6a1 1 0 011 1v1h4a1 1 0 010 2h-1v12a2 2 0 01-2 2H7a2 2 0 01-2-2V7H4a1 1 0 010-2h4V4a1 1 0 011-1zM7 7h10v12H7V7z"/></svg>
                Delete book
              </button>
            </form>
          </div>
        </div>
      </aside>
    </div>
  </div>

  <!-- Delete Confirm Modal -->
  <div id="confirmModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="confirmTitle">
    <div class="panel">
      <div class="hd" id="confirmTitle">Confirm deletion</div>
      <div class="bd">Are you sure you want to delete <strong>{{ $title }}</strong>? This action cannot be undone.</div>
      <div class="ft">
        <button id="cancelDelete" class="btn btn-ghost">Cancel</button>
        <button id="confirmDelete" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>

  <script>
    (function(){
      const $ = (s, c=document)=>c.querySelector(s);
      const form = $('#editForm');
      const fields = ['title','author','isbn','published_year','copies_total'].map(id=>$('#'+id));
      const pTitle=$('#p-title'), pAuthor=$('#p-author'), pIsbn=$('#p-isbn'), pYear=$('#p-year'), pTotal=$('#p-total');
      const meter=$('#p-meter');
      const pAvail=$('#p-avail');

      // Live preview bindings
      $('#title')?.addEventListener('input', e=> pTitle.textContent = e.target.value || '—');
      $('#author')?.addEventListener('input', e=> pAuthor.textContent = e.target.value || '—');
      $('#isbn')?.addEventListener('input', e=> pIsbn.textContent = e.target.value || '—');
      $('#published_year')?.addEventListener('input', e=> pYear.textContent = e.target.value || '—');
      $('#copies_total')?.addEventListener('input', e=>{
        const total = Math.max(1, parseInt(e.target.value || 0,10));
        pTotal.textContent = total;
        // Recompute meter based on existing available count
        const avail = parseInt(pAvail.textContent || '0', 10);
        const pct = total>0 ? Math.max(0, Math.min(100, Math.round((avail/total)*100))) : 0;
        meter.style.width = pct + '%';
      });

      // Unsaved changes guard
      let dirty = false;
      fields.forEach(i => i && i.addEventListener('input', ()=> dirty = true));
      $('#resetBtn')?.addEventListener('click', ()=> dirty = false);
      window.addEventListener('beforeunload', (e)=>{
        if(dirty){ e.preventDefault(); e.returnValue=''; }
      });
      form?.addEventListener('submit', ()=> dirty = false);

      // Ctrl/Cmd+S to save
      window.addEventListener('keydown', (e)=>{
        if((e.ctrlKey || e.metaKey) && e.key.toLowerCase()==='s'){
          e.preventDefault();
          $('#saveBtn')?.click();
        }
      });

      // Delete modal
      const modal = $('#confirmModal');
      $('#openDelete')?.addEventListener('click', ()=> modal.classList.add('show'));
      $('#cancelDelete')?.addEventListener('click', ()=> modal.classList.remove('show'));
      $('#confirmDelete')?.addEventListener('click', ()=> $('#delete-form')?.submit());
      modal?.addEventListener('click', (e)=>{ if(e.target === modal){ modal.classList.remove('show'); } });
    })();
  </script>
</div>
@endsection
