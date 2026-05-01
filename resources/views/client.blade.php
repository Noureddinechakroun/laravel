<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CarRental</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<link rel="stylesheet" href="{{ asset('css/client.css') }}">
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
