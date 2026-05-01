<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Locations</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<link rel="stylesheet" href="{{ asset('css/locations/index.css') }}">
</head>
<body>
<aside class="sidebar">
    <div class="logo">CarRental</div>
    <a href="{{ route('admin') }}">Dashboard</a>
    <a href="{{ route('users.index') }}">Users</a>
    <a href="{{ route('voitures.index') }}">Voitures</a>
    <a href="{{ route('locations.index') }}" class="active">Locations</a>
</aside>
<main class="main">
    <div class="top">
        <h1>Locations</h1>
        <a href="{{ route('locations.create') }}" class="btn add">Add location</a>
    </div>
    @if(session('success'))
    <div class="message">{{ session('success') }}</div>
    @endif
    <div class="panel">
        <table>
            <tr>
                <th>Client</th>
                <th>Voiture</th>
                <th>Start</th>
                <th>End</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            @forelse($locations as $location)
            <tr>
                <td>{{ $location->user->firstname }} {{ $location->user->lastname }}</td>
                <td>{{ $location->voiture->marque }} {{ $location->voiture->modele }}</td>
                <td>{{ $location->date_debut->format('Y-m-d') }}</td>
                <td>{{ $location->date_fin->format('Y-m-d') }}</td>
                <td>{{ number_format($location->prix_total, 2) }} DT</td>
                <td><span class="status">{{ $location->statut }}</span></td>
                <td>
                    <a href="{{ route('locations.edit',$location->id) }}" class="btn edit">Edit</a>
                    <form action="{{ route('locations.destroy',$location->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn delete">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">No locations yet.</td>
            </tr>
            @endforelse
        </table>
    </div>
</main>
<script src="{{ asset('js/carrental.js') }}"></script>
</body>
</html>
