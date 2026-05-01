<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin CarRental</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<aside class="sidebar">
    <div class="logo">CarRental</div>
    <a href="{{ route('admin') }}" class="active">Dashboard</a>
    <a href="{{ route('users.index') }}">Users</a>
    <a href="{{ route('voitures.index') }}">Voitures</a>
    <a href="{{ route('locations.index') }}">Locations</a>
</aside>
<main class="main">
    <div class="top">
        <div>
            <h1>Dashboard admin</h1>
            <p>Gestion simple des utilisateurs, voitures et locations.</p>
        </div>
        <a class="logout" href="{{ route('login') }}">Logout</a>
    </div>
    <section class="cards">
        <div class="card"><span>Total users</span><strong>{{ $totalUsers }}</strong></div>
        <div class="card"><span>Total voitures</span><strong>{{ $totalVoitures }}</strong></div>
        <div class="card"><span>Total locations</span><strong>{{ $totalLocations }}</strong></div>
        <div class="card"><span>Revenue</span><strong>{{ number_format($totalRevenue, 2) }} DT</strong></div>
    </section>
    <section class="actions">
        <a class="action" href="{{ route('users.create') }}"><h3>Add user</h3><p>Create client or admin accounts.</p></a>
        <a class="action" href="{{ route('voitures.create') }}"><h3>Add voiture</h3><p>Add a car with image URL and price.</p></a>
        <a class="action" href="{{ route('locations.create') }}"><h3>Add location</h3><p>Connect a user with a car and dates.</p></a>
    </section>
    <section class="panel">
        <h2>Latest locations</h2>
        <table>
            <tr>
                <th>Client</th>
                <th>Voiture</th>
                <th>Dates</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
            @forelse($latestLocations as $location)
            <tr>
                <td>{{ $location->user->firstname }} {{ $location->user->lastname }}</td>
                <td>{{ $location->voiture->marque }} {{ $location->voiture->modele }}</td>
                <td>{{ $location->date_debut->format('Y-m-d') }} / {{ $location->date_fin->format('Y-m-d') }}</td>
                <td>{{ number_format($location->prix_total, 2) }} DT</td>
                <td><span class="status">{{ $location->statut }}</span></td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No locations yet.</td>
            </tr>
            @endforelse
        </table>
    </section>
</main>
<script src="{{ asset('js/carrental.js') }}"></script>
</body>
</html>
