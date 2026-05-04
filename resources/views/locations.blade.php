{{-- resources/views/locations.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CarRental – Mes locations</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins,sans-serif}
:root{
  --sidebar-bg:#0f172a;--sidebar-accent:#2563eb;--sidebar-text:#94a3b8;
  --body-bg:#f1f5f9;--white:#ffffff;--text:#0f172a;--muted:#64748b;
  --border:#e2e8f0;--card-shadow:0 4px 24px rgba(15,23,42,.08);
  --blue:#2563eb;--blue-dark:#1d4ed8;--green:#10b981;--orange:#f59e0b;--red:#ef4444;
  --radius:12px;
}
body{display:flex;min-height:100vh;background:var(--body-bg);color:var(--text)}
.sidebar{width:260px;min-height:100vh;background:var(--sidebar-bg);display:flex;flex-direction:column;position:fixed;top:0;left:0;z-index:100}
.sidebar-header{padding:28px 24px 20px;border-bottom:1px solid rgba(255,255,255,.06)}
.logo{font-size:22px;font-weight:800;color:#fff;letter-spacing:-.5px}
.logo span{color:var(--sidebar-accent)}
.sidebar-user{padding:20px 24px;border-bottom:1px solid rgba(255,255,255,.06)}
.user-avatar{width:44px;height:44px;border-radius:50%;background:var(--sidebar-accent);display:flex;align-items:center;justify-content:center;font-weight:700;color:#fff;font-size:16px;margin-bottom:10px}
.user-name{color:#fff;font-weight:600;font-size:14px}
.user-role{color:var(--sidebar-text);font-size:12px;margin-top:2px}
nav{flex:1;padding:16px 12px}
nav a{display:flex;align-items:center;gap:12px;color:var(--sidebar-text);text-decoration:none;padding:11px 14px;border-radius:8px;margin-bottom:4px;font-size:14px;font-weight:500;transition:all .2s}
nav a:hover{background:rgba(255,255,255,.06);color:#fff}
nav a.active{background:var(--sidebar-accent);color:#fff}
nav a .icon{width:20px;height:20px;flex-shrink:0;opacity:.8}
.sidebar-footer{padding:16px 12px 24px}
.logout-btn{display:flex;align-items:center;gap:12px;color:#f87171;background:none;border:none;cursor:pointer;padding:11px 14px;border-radius:8px;font-size:14px;font-weight:500;font-family:Poppins,sans-serif;transition:background .2s;width:100%}
.logout-btn:hover{background:rgba(248,113,113,.1)}
.main{margin-left:260px;flex:1;padding:32px}
.page-header{margin-bottom:32px}
.page-header h1{font-size:28px;font-weight:800}
.page-header p{color:var(--muted);margin-top:4px}
.stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;margin-bottom:28px}
.stat{background:var(--white);border-radius:var(--radius);padding:18px 20px;box-shadow:var(--card-shadow)}
.stat-label{font-size:12px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px}
.stat-value{font-size:26px;font-weight:800;color:var(--text)}
.stat-value.blue{color:var(--blue)}
.stat-value.green{color:var(--green)}
.table-card{background:var(--white);border-radius:var(--radius);box-shadow:var(--card-shadow);overflow:hidden}
.table-header{padding:20px 24px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
.table-header h2{font-size:17px;font-weight:700}
.count-badge{background:#eff6ff;color:var(--blue);font-size:13px;font-weight:700;padding:4px 10px;border-radius:999px}
table{width:100%;border-collapse:collapse}
thead{background:#f8fafc}
th{padding:13px 20px;text-align:left;font-size:12px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;border-bottom:1px solid var(--border)}
td{padding:14px 20px;font-size:14px;border-bottom:1px solid var(--border)}
tr:last-child td{border-bottom:none}
tr:hover td{background:#f8fafc}
.car-cell{display:flex;align-items:center;gap:12px}
.car-thumb{width:52px;height:38px;border-radius:6px;object-fit:cover;background:#e2e8f0;flex-shrink:0}
.car-thumb-placeholder{width:52px;height:38px;border-radius:6px;background:#e2e8f0;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
.car-cell strong{font-weight:600;font-size:14px}
.car-cell span{font-size:12px;color:var(--muted)}
.status-badge{display:inline-flex;align-items:center;gap:5px;padding:5px 10px;border-radius:999px;font-size:12px;font-weight:700}
.status-badge.en_cours{background:#dbeafe;color:#1d4ed8}
.status-badge.terminee{background:#d1fae5;color:#065f46}
.status-badge.annulee{background:#fee2e2;color:#991b1b}
.status-dot{width:6px;height:6px;border-radius:50%;background:currentColor}
.facture-btn{display:inline-flex;align-items:center;gap:6px;background:var(--blue);color:#fff;text-decoration:none;padding:7px 14px;border-radius:7px;font-size:12px;font-weight:700;transition:background .2s}
.facture-btn:hover{background:var(--blue-dark)}
.empty{text-align:center;padding:60px 24px;color:var(--muted)}
.empty-icon{font-size:48px;margin-bottom:12px}
.empty h3{font-size:18px;font-weight:700;color:var(--text);margin-bottom:8px}
.cta-btn{display:inline-flex;align-items:center;gap:6px;background:var(--blue);color:#fff;text-decoration:none;padding:10px 20px;border-radius:8px;font-size:14px;font-weight:700;margin-top:16px}
@media(max-width:900px){
  .sidebar{position:static;width:100%;min-height:auto}
  .sidebar-user{display:none}
  nav{display:flex;flex-direction:row;gap:4px;padding:8px}
  nav a{padding:8px 12px;margin-bottom:0}
  .sidebar-footer{padding:8px}
  .main{margin-left:0;padding:20px}
  body{flex-direction:column}
  th,td{padding:10px 12px}
}
</style>
</head>
<body>

<aside class="sidebar">
  <div class="sidebar-header">
    <div class="logo">Car<span>Rental</span></div>
  </div>
  <div class="sidebar-user">
    <div class="user-avatar">{{ strtoupper(substr(auth()->user()->firstname ?? 'U', 0, 1)) }}</div>
    <div class="user-name">{{ auth()->user()->firstname ?? '' }} {{ auth()->user()->lastname ?? '' }}</div>
    <div class="user-role">Client</div>
  </div>
  <nav>
    <a href="{{ route('client') }}">
      <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
      </svg>
      Accueil
    </a>
    <a href="{{ route('locations.client') }}" class="active">
      <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
      </svg>
      Mes locations
    </a>
    <a href="{{ route('facture.derniere') }}">
    <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
    </svg>
    Factures
    </a>
  </nav>
  <div class="sidebar-footer">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-btn">
          <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
        </svg>
        logout
      </button>
    </form>
  </div>
</aside>

<main class="main">
  <div class="page-header">
    <h1>Mes locations</h1>
    <p>Historique de toutes vos réservations.</p>
  </div>

  @php
    $total     = $locations->count();
    $enCours   = $locations->where('statut', 'en_cours')->count();
    $totalPaye = $locations->sum('prix_total');
  @endphp

  <div class="stats">
    <div class="stat">
      <div class="stat-label">Total locations</div>
      <div class="stat-value">{{ $total }}</div>
    </div>
    <div class="stat">
      <div class="stat-label">En cours</div>
      <div class="stat-value blue">{{ $enCours }}</div>
    </div>
    <div class="stat">
      <div class="stat-label">Total payé</div>
      <div class="stat-value green">{{ number_format($totalPaye, 2) }} DT</div>
    </div>
  </div>

  <div class="table-card">
    <div class="table-header">
      <h2>Historique</h2>
      <span class="count-badge">{{ $total }} location{{ $total > 1 ? 's' : '' }}</span>
    </div>

    @if($locations->count())
    <div style="overflow-x:auto">
      <table>
        <thead>
          <tr>
            <th>Voiture</th>
            <th>Début</th>
            <th>Fin</th>
            <th>Total</th>
            <th>Statut</th>
            <th>Facture</th>
          </tr>
        </thead>
        <tbody>
          @foreach($locations as $loc)
          <tr>
            <td>
              <div class="car-cell">
                @if($loc->voiture->path_image)
                  <img class="car-thumb" src="{{ $loc->voiture->path_image }}" alt="">
                @else
                  <div class="car-thumb-placeholder">🚗</div>
                @endif
                <div>
                  <strong>{{ $loc->voiture->marque }} {{ $loc->voiture->modele }}</strong><br>
                  <span>{{ $loc->voiture->annee }} · {{ $loc->voiture->couleur }}</span>
                </div>
              </div>
            </td>
            <td>{{ \Carbon\Carbon::parse($loc->date_debut)->format('d/m/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($loc->date_fin)->format('d/m/Y') }}</td>
            <td style="font-weight:700">{{ number_format($loc->prix_total, 2) }} DT</td>
            <td>
              <span class="status-badge {{ $loc->statut }}">
                <span class="status-dot"></span>
                {{ ucfirst(str_replace('_', ' ', $loc->statut)) }}
              </span>
            </td>
            <td>
              {{-- ✅ NOM CORRECT : locations.facture --}}
              <a href="{{ route('locations.facture', $loc->id) }}" class="facture-btn">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Voir
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @else
    <div class="empty">
      <div class="empty-icon">📋</div>
      <h3>Aucune location</h3>
      <p>Vous n'avez pas encore effectué de réservation.</p>
      <a href="{{ route('client') }}" class="cta-btn">Parcourir les voitures →</a>
    </div>
    @endif
  </div>
</main>

</body>
</html>