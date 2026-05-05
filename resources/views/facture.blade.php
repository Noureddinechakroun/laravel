<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Facture #{{ $location->id }} – CarRental</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/facture.css') }}">
</head>
<body>

<div class="topnav">
  <a href="{{ route('locations.client') }}" class="back-btn">
    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
    Retour
  </a>
  <button class="print-btn" onclick="window.print()">
    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm1-4h4v4H10v-4z"/></svg>
    Imprimer
  </button>
</div>

<div class="invoice">
  <div class="inv-header">
    <div class="inv-brand">
      <div class="logo">Car<span>Rental</span></div>
      <p>Location de véhicules</p>
    </div>
    <div class="inv-id">
      <div class="label">Facture</div>
      <div class="num">#{{ str_pad($location->id, 4, '0', STR_PAD_LEFT) }}</div>
      <div class="inv-date">{{ now()->format('d/m/Y') }}</div>
    </div>
  </div>
  <div class="inv-status {{ $location->statut }}">
    <span class="status-dot"></span>
    {{ ucfirst(str_replace('_', ' ', $location->statut)) }}
  </div>
  <div class="inv-body">
    <div class="info-grid">
      <div class="info-block">
        <div class="block-label">Client</div>
        <div class="block-val">
          {{ $location->user->firstname }} {{ $location->user->lastname }}
          <div class="sub">{{ $location->user->email }}</div>
        </div>
      </div>
      <div class="info-block">
        <div class="block-label">Période de location</div>
        <div class="block-val">
          Du {{ \Carbon\Carbon::parse($location->date_debut)->format('d/m/Y') }}
          <div class="sub">Au {{ \Carbon\Carbon::parse($location->date_fin)->format('d/m/Y') }}</div>
        </div>
      </div>
    </div>
    <div class="car-row">
      @if($location->voiture->path_image)
        <img class="car-img" src="{{ $location->voiture->path_image }}" alt="">
      @endif
      <div class="car-info">
        <strong>{{ $location->voiture->marque }} {{ $location->voiture->modele }}</strong>
        <span>{{ $location->voiture->annee }} · {{ $location->voiture->couleur }} · {{ $location->voiture->prix_jour }} DT/jour</span>
      </div>
    </div>
    @php
      $dateDebut = \Carbon\Carbon::parse($location->date_debut);
      $dateFin   = \Carbon\Carbon::parse($location->date_fin);
      $jours     = $dateDebut->diffInDays($dateFin) + 1;
    @endphp

    <table class="lines">
      <tr>
        <th>Description</th>
        <th class="right">Qté</th>
        <th class="right">P.U.</th>
        <th class="right">Montant</th>
      </tr>
      <tr>
        <td>{{ $location->voiture->marque }} {{ $location->voiture->modele }} – location</td>
        <td class="right">{{ $jours }} j</td>
        <td class="right">{{ number_format($location->voiture->prix_jour, 2) }} DT</td>
        <td class="right">{{ number_format($location->prix_total, 2) }} DT</td>
      </tr>
    </table>
    <div class="total-row">
      <div class="total-label">Montant total TTC</div>
      <div class="total-amount">{{ number_format($location->prix_total, 2) }} DT</div>
    </div>

  </div>

  <div class="inv-footer">
    Merci de votre confiance · CarRental – Tous droits réservés
  </div>

</div>

</body>
</html>