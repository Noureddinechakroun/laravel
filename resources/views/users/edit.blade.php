<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit User</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<link rel="stylesheet" href="{{ asset('css/users/edit.css') }}">
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Edit user</h1>
        @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
        @endif
        <form action="{{ route('users.update',$user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label>First name</label>
            <input type="text" name="firstname" value="{{ old('firstname',$user->firstname) }}">
            <label>Last name</label>
            <input type="text" name="lastname" value="{{ old('lastname',$user->lastname) }}">
            <label>Birth date</label>
            <input type="date" name="datenaissance" value="{{ old('datenaissance',$user->datenaissance) }}">
            <label>Gender</label>
            <select name="gender">
                <option value="male" {{ old('gender',$user->gender) == 'male' ? 'selected' : '' }}>Homme</option>
                <option value="female" {{ old('gender',$user->gender) == 'female' ? 'selected' : '' }}>Femme</option>
            </select>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email',$user->email) }}">
            <label>Role</label>
            <select name="role">
                <option value="client" {{ old('role',$user->role) == 'client' ? 'selected' : '' }}>Client</option>
                <option value="admin" {{ old('role',$user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            <div class="actions">
                <button>Save</button>
                <a class="btn" href="{{ route('users.index') }}">Back</a>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/carrental.js') }}"></script>
</body>
</html>
