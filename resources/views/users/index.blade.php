<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Users</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<link rel="stylesheet" href="{{ asset('css/users/index.css') }}">
</head>
<body>
<aside class="sidebar">
    <div class="logo">CarRental</div>
    <a href="{{ route('admin') }}">Dashboard</a>
    <a href="{{ route('users.index') }}" class="active">Users</a>
    <a href="{{ route('voitures.index') }}">Voitures</a>
    <a href="{{ route('locations.index') }}">Locations</a>
</aside>
<main class="main">
    <div class="top">
        <h1>Users</h1>
        <a href="{{ route('users.create') }}" class="btn add">Add user</a>
    </div>
    @if(session('success'))
    <div class="message">{{ session('success') }}</div>
    @endif
    <div class="panel">
        <table>
            <tr>
                <th>Name</th>
                <th>Birth date</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                <td>{{ $user->datenaissance }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('users.edit',$user->id) }}" class="btn edit">Edit</a>
                    <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn delete">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No users yet.</td>
            </tr>
            @endforelse
        </table>
    </div>
</main>
<script src="{{ asset('js/carrental.js') }}"></script>
</body>
</html>
