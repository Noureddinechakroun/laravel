<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Facture #{{ $location->id }} – CarRental</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins,sans-serif}
:root{
  --blue:#2563eb;--blue-dark:#1d4ed8;--green:#10b981;
  --text:#0f172a;--muted:#64748b;--border:#e2e8f0;
  --bg:#f1f5f9;--white:#fff;
}
body{background:var(--bg);min-height:100vh;display:flex;flex-direction:column;align-items:center;padding:32px 16px}

/* Top nav */
.topnav{
  width:100%;max-width:680px;
  display:flex;align-items:center;justify-content:space-between;
  margin-bottom:24px;
}
.back-btn{
  display:inline-flex;align-items:center;gap:8px;
  color:var(--muted);text-decoration:none;font-size:14px;font-weight:600;
  padding:8px 14px;border-radius:8px;border:1px solid var(--border);background:var(--white);
  transition:all .2s;
}
.back-btn:hover{color:var(--text);border-color:#94a3b8}
.print-btn{
  display:inline-flex;align-items:center;gap:8px;
  background:var(--blue);color:#fff;text-decoration:none;
  padding:9px 18px;border-radius:8px;font-size:14px;font-weight:700;
  border:none;cursor:pointer;transition:background .2s;
}
.print-btn:hover{background:var(--blue-dark)}

/* Invoice card */
.invoice{
  width:100%;max-width:680px;background:var(--white);
  border-radius:16px;overflow:hidden;
  box-shadow:0 8px 40px rgba(15,23,42,.1);
}

/* Invoice header */
.inv-header{
  background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 100%);
  padding:36px 40px;
  display:flex;justify-content:space-between;align-items:flex-start;
  flex-wrap:wrap;gap:20px;
}
.inv-brand .logo{font-size:24px;font-weight:800;color:#fff;letter-spacing:-.5px}
.inv-brand .logo span{color:#60a5fa}
.inv-brand p{color:#94a3b8;font-size:13px;margin-top:4px}
.inv-id{text-align:right}
.inv-id .label{font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:.5px}
.inv-id .num{font-size:28px;font-weight:800;color:#fff;margin-top:4px}
.inv-date{font-size:13px;color:#94a3b8;margin-top:4px}

/* Status banner */
.inv-status{
  padding:12px 40px;
  display:flex;align-items:center;gap:8px;
  font-size:13px;font-weight:700;
}
.inv-status.en_cours{background:#dbeafe;color:#1d4ed8}
.inv-status.terminee{background:#d1fae5;color:#065f46}
.inv-status.annulee{background:#fee2e2;color:#991b1b}
.status-dot{width:8px;height:8px;border-radius:50%;background:currentColor}

/* Invoice body */
.inv-body{padding:36px 40px}

/* Info grid */
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:32px}
.info-block .block-label{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--muted);margin-bottom:10px}
.info-block .block-val{font-size:15px;font-weight:600;color:var(--text);line-height:1.6}
.info-block .sub{font-size:13px;color:var(--muted);font-weight:400}

/* Car preview */
.car-row{
  display:flex;align-items:center;gap:16px;
  background:#f8fafc;border-radius:10px;padding:16px;margin-bottom:32px;
}
.car-img{width:80px;height:56px;border-radius:8px;object-fit:cover;background:#e2e8f0}
.car-info strong{font-size:16px;font-weight:700}
.car-info span{font-size:13px;color:var(--muted);display:block;margin-top:2px}

/* Lines table */
.lines{width:100%;border-collapse:collapse;margin-bottom:24px}
.lines th{font-size:12px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;padding:0 0 10px;border-bottom:1px solid var(--border);text-align:left}
.lines td{padding:12px 0;font-size:14px;border-bottom:1px solid var(--border)}
.lines tr:last-child td{border-bottom:none}
.lines .right{text-align:right;font-weight:600}

/* Total */
.total-row{
  display:flex;align-items:center;justify-content:space-between;
  background:linear-gradient(135deg,var(--blue),var(--blue-dark));
  border-radius:10px;padding:18px 22px;color:#fff;
}
.total-row .total-label{font-size:14px;font-weight:600;opacity:.85}
.total-row .total-amount{font-size:26px;font-weight:800}

/* Footer note */
.inv-footer{
  border-top:1px solid var(--border);padding:20px 40px;
  font-size:12px;color:var(--muted);text-align:center;
}

@media print{
  body{padding:0;background:white}
  .topnav{display:none}
  .invoice{box-shadow:none;border-radius:0}
}
@media(max-width:600px){
  .inv-header,.inv-body,.inv-footer{padding:24px 20px}
  .inv-status{padding:10px 20px}
  .info-grid{grid-template-columns:1fr}
}
</style>
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

  <!-- Header -->
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

  <!-- Status -->
  <div class="inv-status {{ $location->statut }}">
    <span class="status-dot"></span>
    {{ ucfirst(str_replace('_', ' ', $location->statut)) }}
  </div>

  <!-- Body -->
  <div class="inv-body">

    <!-- Client / Dates -->
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

    <!-- Car -->
    <div class="car-row">
      @if($location->voiture->path_image)
        <img class="car-img" src="{{ $location->voiture->path_image }}" alt="">
      @endif
      <div class="car-info">
        <strong>{{ $location->voiture->marque }} {{ $location->voiture->modele }}</strong>
        <span>{{ $location->voiture->annee }} · {{ $location->voiture->couleur }} · {{ $location->voiture->prix_jour }} DT/jour</span>
      </div>
    </div>

    <!-- Lines -->
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

    <!-- Total -->
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