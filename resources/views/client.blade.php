<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CarRental – Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/client.css') }}">
</head>
<body>

<aside class="sidebar">
  <div class="sidebar-header">
    <div class="logo">Car<span>Rental</span></div>
  </div>

  <div class="sidebar-user">
    <div class="user-avatar">
      {{ strtoupper(substr(auth()->user()->firstname ?? 'U', 0, 1)) }}
    </div>
    <div class="user-name">{{ auth()->user()->firstname ?? '' }} {{ auth()->user()->lastname ?? '' }}</div>
    <div class="user-role">Client</div>
  </div>

  <nav>
    <a href="{{ route('client') }}" class="active">
      <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
      Acceuil
    </a>
    <a href="{{ route('locations.client') }}">
      <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
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
    <a href="{{ route('login') }}" class="logout-btn">
      logout
    </a>
  </div>
</aside>

<!-- MAIN -->
<main class="main">

  <div class="page-header">
    <h1>Voitures disponibles</h1>
    <p>Choisissez votre véhicule et réservez en quelques clics.</p>
  </div>

  <div class="filter-bar">
    <div class="search-wrap">
      <svg class="search-icon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
      <input type="text" id="searchInput" placeholder="Rechercher une voiture...">
    </div>
  </div>

  @if($voitures->count())
  <div class="cars-grid" id="carsGrid">
    @foreach($voitures as $voiture)
    <div class="car-card" data-name="{{ strtolower($voiture->marque.' '.$voiture->modele) }}">
      <div class="car-img">
        <img src="{{ $voiture->path_image }}" alt="{{ $voiture->marque }} {{ $voiture->modele }}" loading="lazy">
        <span class="car-badge">Disponible</span>
      </div>
      <div class="car-body">
        <div class="car-title">{{ $voiture->marque }} {{ $voiture->modele }}</div>
        <div class="car-meta">
          <span>📅 {{ $voiture->annee }}</span>
          <span>🎨 {{ $voiture->couleur }}</span>
          <span>📍 {{ number_format($voiture->kilometrage, 0, ',', ' ') }} km</span>
        </div>
        <div class="car-footer">
          <div class="car-price">
            {{ number_format($voiture->prix_jour, 2) }} DT
            <sub>/ jour</sub>
          </div>
          <a href="{{ route('client.locations.create', $voiture->id) }}" class="rent-btn">
            Louer
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @else
  <div class="empty">
    <div class="empty-icon">🚗</div>
    <h3>Aucune voiture disponible</h3>
    <p>Revenez bientôt, de nouveaux véhicules seront ajoutés.</p>
  </div>
  @endif

</main>

<script>
const input = document.getElementById('searchInput');
if(input){
  input.addEventListener('input', () => {
    const q = input.value.toLowerCase();
    document.querySelectorAll('.car-card').forEach(card => {
      card.style.display = card.dataset.name.includes(q) ? '' : 'none';
    });
  });
}
</script>
</body>
</html>
