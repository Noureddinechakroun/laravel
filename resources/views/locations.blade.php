<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CarRental – Mes locations</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/locations.css') }}">
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
    <a href="{{ route('client.profile.edit') }}">
      <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M5.121 17.804A8 8 0 1118.879 17.8M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
      </svg>
      Mes informations
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

  @if(session('success'))
    <div class="alert success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert error">{{ session('error') }}</div>
  @endif

  @php
    $total     = $locations->count();
    $enCours   = $locations->where('statut', 'en_cours')->count();
    $totalPaye = $locations->where('statut', '!=', 'annulee')->sum('prix_total');
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
            <th>Actions</th>
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
            <td style="font-weight:700">
              {{ number_format($loc->statut === 'annulee' ? 0 : $loc->prix_total, 2) }} DT
            </td>
            <td>
              <span class="status-badge {{ $loc->statut }}">
                <span class="status-dot"></span>
                {{ ucfirst(str_replace('_', ' ', $loc->statut)) }}
              </span>
            </td>
            <td>
              <a href="{{ route('locations.facture', $loc->id) }}" class="facture-btn">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Voir
              </a>
            </td>
            <td>
              @if($loc->statut === 'en_cours')
                <div class="action-group">
                  <a href="{{ route('client.locations.edit', $loc->id) }}" class="edit-btn">Modifier</a>
                  <form method="POST" action="{{ route('client.locations.cancel', $loc->id) }}" onsubmit="return confirm('Annuler cette location ?')">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="cancel-btn">Annuler</button>
                  </form>
                </div>
              @else
                <span class="muted-action">Non disponible</span>
              @endif
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
