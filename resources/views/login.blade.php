<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
<main class="auth-shell">
    <section class="auth-brand">
        <div class="brand-name">CarRental</div>
        <div class="brand-text">
            <h1>Manage your rental space with confidence.</h1>
            <p>Login to access the dashboard, manage cars, clients, and locations from one clean place.</p>
        </div>
        <div class="brand-stats">
            <div class="brand-stat"><strong>24/7</strong><span>Access</span></div>
            <div class="brand-stat"><strong>Fast</strong><span>Admin tools</span></div>
            <div class="brand-stat"><strong>Simple</strong><span>Rental flow</span></div>
        </div>
    </section>
    <section class="auth-panel">
        <h1 class="form-title">Welcome back</h1>
        <p class="form-subtitle">Enter your account details to continue.</p>

        @if (session('success'))
        <div class="notification success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
        <div class="notification error">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
        <div class="notification error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('verif_login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" placeholder="admin@gmail.com" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-buttons">
                <button type="submit" class="btn-submit">Login</button>
                <a class="auth-link btn-reset" href="{{ route('signup') }}">Create account</a>
            </div>
        </form>
    </section>
</main>
<script src="{{ asset('js/carrental.js') }}"></script>
</body>
</html>