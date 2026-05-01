<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Voitures</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<link rel="stylesheet" href="{{ asset('css/voitures/index.css') }}">
</head>
<body>
<aside class="sidebar">
    <div class="logo">CarRental</div>
    <a href="{{ route('admin') }}">Dashboard</a>
    <a href="{{ route('users.index') }}">Users</a>
    <a href="{{ route('voitures.index') }}" class="active">Voitures</a>
    <a href="{{ route('locations.index') }}">Locations</a>
</aside>
<main class="main">
    <div class="top">
        <div>
            <h1>Voitures</h1>
            <p>{{ $voitures->count() }} voiture(s) dans le parc</p>
        </div>
        <a href="{{ route('voitures.create') }}" class="btn add">Add voiture</a>
    </div>
    @if(session('success'))
    <div class="message">{{ session('success') }}</div>
    @endif
    <div class="grid">
        @forelse($voitures as $voiture)
        <div class="car">
            <div class="photo">
                <img src="{{ $voiture->path_image }}" alt="{{ $voiture->marque }} {{ $voiture->modele }}">
            </div>
            <div class="body">
                <h2>{{ $voiture->marque }} {{ $voiture->modele }}</h2>
                <div class="facts">
                    <span class="fact">{{ $voiture->annee }}</span>
                    <span class="fact">{{ $voiture->couleur }}</span>
                    <span class="fact">{{ number_format($voiture->kilometrage, 0) }} km</span>
                </div>
                <p class="price">{{ number_format($voiture->prix_jour, 2) }} DT / day</p>
                <span class="status">{{ $voiture->statut }}</span>
                <div class="actions">
                    <a href="{{ route('voitures.edit',$voiture->id) }}" class="btn edit">Edit</a>
                    <form action="{{ route('voitures.destroy',$voiture->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn delete">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="empty">No cars yet. Add your first voiture to start building the rental catalog.</p>
        @endforelse
    </div>
</main>
<script src="{{ asset('js/carrental.js') }}"></script>
</body>
</html>
