<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add User</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<link rel="stylesheet" href="{{ asset('css/users/create.css') }}">
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Add user</h1>
        @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
        @endif
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <label>First name</label>
            <input type="text" name="firstname" value="{{ old('firstname') }}">
            <label>Last name</label>
            <input type="text" name="lastname" value="{{ old('lastname') }}">
            <label>Birth date</label>
            <input type="date" name="datenaissance" value="{{ old('datenaissance') }}">
            <label>Gender</label>
            <select name="gender">
                <option value="male">Homme</option>
                <option value="female">Femme</option>
            </select>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
            <label>Password</label>
            <input type="password" name="password">
            <label>Role</label>
            <select name="role">
                <option value="client">Client</option>
                <option value="admin">Admin</option>
            </select>
            <div class="actions">
                <button>Add</button>
                <a class="btn" href="{{ route('users.index') }}">Back</a>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/carrental.js') }}"></script>
</body>
</html>
