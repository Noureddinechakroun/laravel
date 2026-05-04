<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Locations</title>
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
.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px}
.btn{display:inline-block;border:none;border-radius:8px;padding:9px 13px;color:white;text-decoration:none;cursor:pointer;font-size:14px}
.add{background:#10b981}.edit{background:#2563eb}.delete{background:#ef4444}
.message{background:#dcfce7;color:#166534;padding:12px;border-radius:8px;margin-bottom:15px}
.panel{background:white;border-radius:8px;padding:20px;box-shadow:0 6px 18px rgba(15,23,42,.08);overflow-x:auto}
table{width:100%;border-collapse:collapse}
th,td{text-align:left;padding:12px;border-bottom:1px solid #e5e7eb}
th{background:#f8fafc;color:#475569}
.status{display:inline-block;padding:5px 9px;border-radius:999px;background:#dbeafe;color:#1d4ed8;font-size:13px}
form{display:inline}
@media(max-width:760px){.sidebar{position:static;width:100%;min-height:auto}.main{margin-left:0;width:100%;padding:18px}body{display:block}.top{align-items:flex-start;gap:12px;flex-direction:column}}
</style>
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