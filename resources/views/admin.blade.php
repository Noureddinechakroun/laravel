<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin CarRental</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins,Arial,sans-serif}
body{display:flex;background:#f4f6f9;color:#111827}
.sidebar{width:250px;min-height:100vh;background:#111827;color:white;padding:24px;position:fixed}
.logo{font-size:24px;font-weight:700;margin-bottom:30px}
.sidebar a{display:block;color:#cbd5e1;text-decoration:none;padding:12px;border-radius:8px;margin-bottom:8px}
.sidebar a:hover,.sidebar a.active{background:#2563eb;color:white}
.main{margin-left:250px;width:calc(100% - 250px);padding:28px}
.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px}
.top h1{font-size:28px}
.logout{background:#ef4444;color:white;text-decoration:none;border:none;border-radius:8px;padding:10px 16px}
.cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:18px;margin-bottom:28px}
.card{background:white;border-radius:8px;padding:20px;box-shadow:0 6px 18px rgba(15,23,42,.08)}
.card span{color:#64748b;font-size:14px}
.card strong{display:block;font-size:28px;margin-top:8px}
.actions{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px;margin-bottom:28px}
.action{background:white;border-radius:8px;padding:20px;text-decoration:none;color:#111827;box-shadow:0 6px 18px rgba(15,23,42,.08);border-left:5px solid #2563eb}
.action h3{margin-bottom:8px}
.action p{color:#64748b;font-size:14px}
.panel{background:white;border-radius:8px;padding:20px;box-shadow:0 6px 18px rgba(15,23,42,.08)}
table{width:100%;border-collapse:collapse;margin-top:12px}
th,td{text-align:left;padding:12px;border-bottom:1px solid #e5e7eb}
th{background:#f8fafc;color:#475569}
.status{padding:5px 9px;border-radius:999px;background:#dbeafe;color:#1d4ed8;font-size:13px}
@media(max-width:760px){.sidebar{position:static;width:100%;min-height:auto}.main{margin-left:0;width:100%;padding:18px}body{display:block}.top{align-items:flex-start;gap:12px;flex-direction:column}}
</style>
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