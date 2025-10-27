@extends('layouts.app')

@section('content')
<div class="lib-member-edit pro">
  <style>
    .lib-member-edit.pro{
      --bg:#f7f5f2; --ink:#0f172a; --muted:#6b7280;
      --brand:#2f855a; --brand-2:#38a169; --brand-3:#c7f9cc;
      --card:#ffffff; --ring: rgba(56,161,105,.35);
      --radius:18px; --shadow: 0 18px 50px rgba(16,24,40,.08);
      --table-border:#eef2f7; --danger:#dc2626; --amber:#b45309;
    }
    .lib-member-edit.pro .wrap{max-width:1100px;margin:clamp(12px,3vw,40px) auto;padding:clamp(8px,2vw,16px)}

    /* Hero */
    .lib-member-edit.pro .hero{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:18px}
    .lib-member-edit.pro .hero-left{display:flex;gap:12px;align-items:center}
    .lib-member-edit.pro .badge{
      width:56px;height:56px;border-radius:16px;display:grid;place-items:center;
      background: radial-gradient(120% 140% at 10% 10%, var(--brand-2) 0%, var(--brand) 60%, #1f6f4a 100%);
      box-shadow:0 10px 28px rgba(47,133,90,.35)
    }
    .lib-member-edit.pro .badge svg{width:30px;height:30px;color:#e8f5ee}
    .lib-member-edit.pro h1{margin:0;font-size:clamp(22px,2.4vw,28px);color:var(--ink);font-weight:800}
    .lib-member-edit.pro .sub{color:var(--muted);margin-top:2px;font-size:14px}

    /* Buttons */
    .lib-member-edit.pro .btn{
      appearance:none;border:0;padding:12px 16px;border-radius:12px;font-weight:700;cursor:pointer;
      font-size:14px;line-height:1;text-decoration:none;display:inline-flex;align-items:center;gap:8px;
      transition:transform .04s ease, box-shadow .2s ease, background .2s ease, color .2s ease
    }
    .lib-member-edit.pro .btn:active{transform:translateY(1px)}
    .lib-member-edit.pro .btn-primary{color:#fff;background:linear-gradient(180deg,var(--brand-2),var(--brand));box-shadow:0 12px 28px rgba(47,133,90,.25)}
    .lib-member-edit.pro .btn-ghost{background:#f1f5f9;color:#0f172a}
    .lib-member-edit.pro .btn-danger{background:#fee2e2;color:#7f1d1d;border:1px solid #fecaca}

    /* Cards & layout */
    .lib-member-edit.pro .grid{display:grid;gap:16px}
    @media(min-width:960px){.lib-member-edit.pro .grid{grid-template-columns:2fr 1fr}}
    .lib-member-edit.pro .card{background:var(--card);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden;border:1px solid var(--table-border)}
    .lib-member-edit.pro .card-head{padding:16px 20px;display:flex;align-items:center;justify-content:space-between;gap:12px;background:linear-gradient(180deg,rgba(47,133,90,.06),transparent 60%);border-bottom:1px solid var(--table-border)}
    .lib-member-edit.pro .card-body{padding:20px}
    .lib-member-edit.pro .side-muted{color:var(--muted);font-size:13px}

    /* Form */
    .lib-member-edit.pro .form-grid{display:grid;gap:16px}
    @media(min-width:700px){.lib-member-edit.pro .form-grid{grid-template-columns:1fr 1fr}.lib-member-edit.pro .span-2{grid-column:span 2}}
    .lib-member-edit.pro label{display:block;font-size:13px;color:#334155;margin:0 0 6px 2px;font-weight:600}
    .lib-member-edit.pro .req::after{content:" *";color:#dc2626;font-weight:900}
    .lib-member-edit.pro .input{width:100%;border:1px solid #e5e7eb;background:#fff;border-radius:12px;padding:12px 14px;font-size:15px;color:var(--ink);outline:none;transition:box-shadow .15s ease,border-color .15s ease}
    .lib-member-edit.pro .input:focus{border-color:var(--brand-2);box-shadow:0 0 0 6px var(--ring)}
    .lib-member-edit.pro .hint{margin-top:6px;color:#748096;font-size:12px}

    /* Sticky action footer inside form card */
    .lib-member-edit.pro .actions{position:sticky;bottom:-1px;padding:14px 20px;display:flex;gap:10px;justify-content:flex-end;border-top:1px solid var(--table-border);background:linear-gradient(180deg,rgba(15,23,42,.02),#fff)}

    /* Preview & status */
    .lib-member-edit.pro .avatar{
      width:56px;height:56px;border-radius:50%;display:grid;place-items:center;font-weight:800;
      background:linear-gradient(180deg,var(--brand-3),#e6f7eb);color:#0f172a;border:1px solid #e5e7eb
    }
    .lib-member-edit.pro .meter{height:10px;background:#eef2f7;border-radius:999px;overflow:hidden}
    .lib-member-edit.pro .bar{height:100%;background:linear-gradient(90deg,var(--brand-2),var(--brand))}
    .lib-member-edit.pro .meta{display:grid;gap:8px}
    .lib-member-edit.pro .meta .row{display:flex;justify-content:space-between;gap:8px}
    .lib-member-edit.pro .chip{font-size:12px;padding:4px 8px;border-radius:999px;border:1px solid #e5e7eb;background:#f8fafc;color:#334155}
    .lib-member-edit.pro .chip.warn{border-color:#fef3c7;background:#fffbeb;color:var(--amber)}

    /* Errors */
    .lib-member-edit.pro .errors{background:#fff1f2;border:1px solid #fecdd3;color:#7f1d1d;padding:12px 14px;border-radius:12px;font-size:14px;margin-bottom:16px}
    .lib-member-edit.pro .errors ul{margin:6px 0 0 18px}

    /* Modal */
    .lib-member-edit.pro .modal{position:fixed;inset:0;background:rgba(15,23,42,.45);display:none;align-items:center;justify-content:center;padding:20px}
    .lib-member-edit.pro .modal .panel{width:100%;max-width:440px;background:#fff;border-radius:16px;border:1px solid #e5e7eb;box-shadow:var(--shadow);overflow:hidden}
    .lib-member-edit.pro .modal .hd{padding:16px 18px;border-bottom:1px solid #e5e7eb;font-weight:800}
    .lib-member-edit.pro .modal .bd{padding:18px;color:#334155}
    .lib-member-edit.pro .modal .ft{padding:14px 18px;border-top:1px solid #e5e7eb;display:flex;justify-content:flex-end;gap:10px}
    .lib-member-edit.pro .modal.show{display:flex}
  </style>

  @php
    $name = old('name', $member->name);
    $email = old('email', $member->email);
    $contact = old('contact', $member->contact);

    // Profile completeness: name + (email/contact each count)
    $fieldsPresent = (!!trim($name) ? 1 : 0) + (!!trim($email) ? 1 : 0) + (!!trim($contact) ? 1 : 0);
    $completePct = (int) round(($fieldsPresent / 3) * 100);

    // Initials for avatar
    $initials = '—';
    if($name){
      $parts = preg_split('/\s+/', trim($name));
      $initials = strtoupper(mb_substr($parts[0] ?? '', 0, 1) . mb_substr($parts[1] ?? '', 0, 1));
    }

    // Optional: basic loan stats if your relations exist
    try {
      $totalLoans  = method_exists($member,'loans') ? $member->loans()->count() : null;
      $activeLoans = method_exists($member,'loans') ? $member->loans()->whereNull('returned_at')->count() : null;
    } catch (\Throwable $e) {
      $totalLoans = $activeLoans = null;
    }
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
          <h1>Edit Member</h1>
          <div class="sub">Update patron details and contact info.</div>
        </div>
      </div>
      <div class="hero-actions" style="display:flex;gap:10px;flex-wrap:wrap">
        <a class="btn btn-ghost" href="{{ route('members.index') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M10 19l-7-7 7-7v4h8v6h-8v4z"/></svg>
          Back to list
        </a>
      </div>
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

    <div class="grid">
      <!-- LEFT: Edit form -->
      <div class="card">
        <div class="card-head">
          <strong>Member details</strong>
          <span class="side-muted">Member ID: #{{ $member->id }}</span>
        </div>

        <form id="editForm" method="POST" action="{{ route('members.update', $member) }}" autocomplete="on">
          @csrf @method('PUT')

          <div class="card-body">
            <div class="form-grid">
              <div class="span-2">
                <label for="name" class="req">Full name</label>
                <input id="name" name="name" class="input" required
                       placeholder="e.g., Juan Dela Cruz"
                       value="{{ $name }}">
                <div class="hint">Display name used on notices and receipts.</div>
              </div>

              <div>
                <label for="email">Email</label>
                <input id="email" name="email" type="email" class="input"
                       placeholder="e.g., juan@example.com"
                       value="{{ $email }}">
                <div class="hint">For due-date reminders and announcements.</div>
              </div>

              <div>
                <label for="contact">Contact number</label>
                <input id="contact" name="contact" class="input"
                       placeholder="e.g., 0917 123 4567"
                       value="{{ $contact }}">
                <div class="hint">Mobile or landline.</div>
              </div>
            </div>
          </div>

          <div class="actions">
            <button type="reset" class="btn btn-ghost" id="resetBtn">Reset</button>
            <button type="submit" class="btn btn-primary" id="saveBtn">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17 3H5a2 2 0 00-2 2v14l4-4h10a2 2 0 002-2V5a2 2 0 00-2-2z"/></svg>
              Update Member
            </button>
          </div>
        </form>
      </div>

      <!-- RIGHT: Preview & status -->
      <aside>
        <div class="card">
          <div class="card-head">
            <strong>Profile preview</strong>
            <span class="side-muted">Live as you type</span>
          </div>
          <div class="card-body">
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px">
              <div class="avatar" id="p-avatar">{{ $initials }}</div>
              <div>
                <div style="font-weight:800" id="p-name">{{ $name ?: '—' }}</div>
                <div class="side-muted" id="p-email">{{ $email ?: '—' }}</div>
              </div>
            </div>

            <div class="meta">
              <div class="row"><span class="side-muted">Contact</span><span id="p-contact">{{ $contact ?: '—' }}</span></div>
              <div class="row" style="align-items:center;gap:10px">
                <span class="side-muted">Completeness</span>
                <span style="min-width:44px;text-align:right" id="p-pct">{{ $completePct }}%</span>
              </div>
              <div class="meter" title="{{ $completePct }}%">
                <div class="bar" id="p-meter" style="width: {{ $completePct }}%"></div>
              </div>

              @if(!trim($email) || !trim($contact))
                <div class="row" style="margin-top:6px">
                  <span class="chip warn">
                    @if(!trim($email) && !trim($contact)) Missing email & contact
                    @elseif(!trim($email)) Missing email
                    @else Missing contact @endif
                  </span>
                </div>
              @endif

              @if(!is_null($totalLoans))
                <hr style="border:none;border-top:1px solid var(--table-border);margin:10px 0">
                <div class="row"><span class="side-muted">Active loans</span><strong>{{ $activeLoans }}</strong></div>
                <div class="row"><span class="side-muted">Total loans</span><span>{{ $totalLoans }}</span></div>
              @endif
            </div>
          </div>
        </div>

        {{-- Optional: Danger zone for delete --}}
        <div class="card" style="margin-top:16px">
          <div class="card-head" style="background:linear-gradient(180deg,rgba(220,38,38,.06),transparent 60%)">
            <strong>Danger zone</strong>
          </div>
          <div class="card-body" style="display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap">
            <div class="side-muted">Permanently remove this member and their history.</div>
            <form id="delete-form" method="POST" action="{{ route('members.destroy', $member) }}">
              @csrf @method('DELETE')
              <button type="button" class="btn btn-danger" id="openDelete">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 3h6a1 1 0 011 1v1h4a1 1 0 010 2h-1v12a2 2 0 01-2 2H7a2 2 0 01-2-2V7H4a1 1 0 010-2h4V4a1 1 0 011-1zM7 7h10v12H7V7z"/></svg>
                Delete member
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
      <div class="bd">Are you sure you want to delete <strong>{{ $name ?: 'this member' }}</strong>? This action cannot be undone.</div>
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
      const fields = ['name','email','contact'].map(id=>$('#'+id));
      const pName=$('#p-name'), pEmail=$('#p-email'), pContact=$('#p-contact');
      const pMeter=$('#p-meter'), pPct=$('#p-pct'), pAvatar=$('#p-avatar');

      function initialsFrom(name){
        if(!name){ return '—'; }
        const parts = name.trim().split(/\s+/).filter(Boolean);
        return (parts[0]?.[0]||'').toUpperCase() + (parts[1]?.[0]||'').toUpperCase();
      }
      function updateCompleteness(){
        const name = ($('#name')?.value||'').trim();
        const email = ($('#email')?.value||'').trim();
        const contact = ($('#contact')?.value||'').trim();
        const count = (name?1:0) + (email?1:0) + (contact?1:0);
        const pct = Math.round((count/3)*100);
        pMeter.style.width = pct + '%';
        pPct.textContent = pct + '%';
      }

      // Live preview bindings
      $('#name')?.addEventListener('input', e=>{ pName.textContent = e.target.value || '—'; pAvatar.textContent = initialsFrom(e.target.value); updateCompleteness(); });
      $('#email')?.addEventListener('input', e=>{ pEmail.textContent = e.target.value || '—'; updateCompleteness(); });
      $('#contact')?.addEventListener('input', e=>{ pContact.textContent = e.target.value || '—'; updateCompleteness(); });

      // Unsaved changes guard
      let dirty = false;
      fields.forEach(i => i && i.addEventListener('input', ()=> dirty = true));
      $('#resetBtn')?.addEventListener('click', ()=> { dirty = false; updateCompleteness(); });
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
