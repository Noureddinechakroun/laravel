<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CarRental</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins,Arial,sans-serif}
body{background:#f4f6f9;color:#111827}
.header{background:#111827;color:white;padding:24px}
.nav{max-width:1180px;margin:auto;display:flex;justify-content:space-between;align-items:center}
.brand{font-size:24px;font-weight:700}
.nav a{color:white;text-decoration:none;background:#ef4444;padding:10px 14px;border-radius:8px}
.hero{max-width:1180px;margin:28px auto;padding:0 18px}
.hero h1{font-size:34px;margin-bottom:8px}
.hero p{color:#64748b}
.grid{max-width:1180px;margin:0 auto 30px;padding:0 18px;display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:18px}
.car{background:white;border-radius:8px;overflow:hidden;box-shadow:0 6px 18px rgba(15,23,42,.08)}
.car img{width:100%;height:190px;object-fit:cover;background:#e5e7eb}
.body{padding:16px}
.meta{color:#64748b;margin:8px 0}
.price{font-size:22px;font-weight:700;margin:10px 0}
.btn{display:inline-block;background:#2563eb;color:white;text-decoration:none;border-radius:8px;padding:10px 14px}
.empty{max-width:1180px;margin:auto;padding:20px;background:white;border-radius:8px}
</style>
</head>
<body>
<header class="header">
    <div class="nav">
        <div class="brand">CarRental</div>
        <a href="{{ route('login') }}">Logout</a>
    </div>
</header>
<section class="hero">
    <h1>Available cars</h1>
    <p>Choose a car and contact the admin to create your location.</p>
</section>
@if($voitures->count())
<section class="grid">
    @foreach($voitures as $voiture)
    <div class="car">
        <img src="{{ $voiture->path_image }}" alt="{{ $voiture->marque }} {{ $voiture->modele }}">
        <div class="body">
            <h2>{{ $voiture->marque }} {{ $voiture->modele }}</h2>
            <p class="meta">{{ $voiture->annee }} | {{ $voiture->couleur }} | {{ number_format($voiture->kilometrage, 0) }} km</p>
            <p class="price">{{ number_format($voiture->prix_jour, 2) }} DT / day</p>
            <a class="btn" href="{{ route('login') }}">Ask for location</a>
        </div>
    </div>
    @endforeach
</section>
@else
<div class="empty">No available cars yet.</div>
@endif
</body>
</html>
