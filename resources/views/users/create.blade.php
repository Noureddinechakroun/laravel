<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add User</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<style>
*{box-sizing:border-box;font-family:Poppins,Arial,sans-serif}
body{background:#f4f6f9;color:#111827;padding:24px}
.container{max-width:680px;margin:auto}
.card{background:white;border-radius:8px;padding:24px;box-shadow:0 6px 18px rgba(15,23,42,.08)}
h1{margin-top:0}
label{display:block;margin-top:12px;font-weight:600}
input,select{width:100%;padding:11px;margin-top:6px;border-radius:8px;border:1px solid #d1d5db}
.actions{display:flex;gap:10px;margin-top:18px}
button,.btn{border:none;border-radius:8px;padding:10px 14px;color:white;text-decoration:none;cursor:pointer}
button{background:#10b981}.btn{background:#64748b}
.error{background:#fee2e2;color:#991b1b;padding:10px;border-radius:8px;margin-bottom:12px}
</style>
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