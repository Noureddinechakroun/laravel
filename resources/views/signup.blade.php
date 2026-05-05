<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>
<body>
<main class="auth-shell">
    <section class="auth-brand">
        <div class="brand-name">CarRental</div>
        <div class="brand-text">
            <h1>Create your rental account.</h1>
            <p>Join the platform and browse available cars with a simple client dashboard.</p>
            <div class="steps">
                <div class="step"><strong>Step 1</strong><span>Create your account.</span></div>
                <div class="step"><strong>Step 2</strong><span>Login as a client.</span></div>
                <div class="step"><strong>Step 3</strong><span>Choose a car for your location.</span></div>
            </div>
        </div>
    </section>
    <section class="auth-panel">
        <h1 class="form-title">Create account</h1>
        <p class="form-subtitle">Fill the form to become a client.</p>

        @if ($errors->any())
        <div class="notification error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('signup.store') }}">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="firstname">First name</label>
                    <input type="text" id="firstname" name="firstname" placeholder="John" value="{{ old('firstname') }}" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last name</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Doe" value="{{ old('lastname') }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="birthdate">Birth date</label>
                    <input type="date" id="birthdate" name="birthdate" max="{{ date('Y-m-d') }}" value="{{ old('birthdate') }}" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select gender</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Minimum 6 characters" minlength="6" required>
            </div>
            <div class="form-buttons">
                <button type="submit" class="btn-submit">Sign up</button>
                <a class="auth-link btn-back" href="{{ route('login') }}">Back to login</a>
            </div>
        </form>
    </section>
</main>
<script src="{{ asset('js/carrental.js') }}"></script>
</body>
</html>