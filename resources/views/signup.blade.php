<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins,Arial,sans-serif}
body{min-height:100vh;display:grid;place-items:center;padding:24px;background:#eaf0f7}
.auth-shell{width:min(1120px,100%);display:grid;grid-template-columns:420px 1fr;background:white;border:1px solid #dbe3ee;border-radius:8px;overflow:hidden;box-shadow:0 30px 80px rgba(15,23,42,.18)}
.auth-brand{background:linear-gradient(145deg,#08111f,#0f172a 58%,#059669);color:white;padding:44px;display:flex;flex-direction:column;justify-content:space-between}
.brand-name{font-size:30px;font-weight:800}
.brand-text h1{font-size:40px;line-height:1.12;margin-bottom:16px}
.brand-text p{color:#d1fae5;font-size:16px;line-height:1.7}
.steps{display:grid;gap:12px;margin-top:28px}
.step{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:14px}
.step strong{display:block;margin-bottom:4px}
.step span{font-size:13px;color:#d1fae5}
.auth-panel{padding:42px 48px}
.form-title{font-size:32px;font-weight:800;color:#0f172a;margin-bottom:8px}
.form-subtitle{color:#64748b;margin-bottom:26px}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.form-group{margin-bottom:16px}
label{display:block;font-size:13px;font-weight:700;color:#334155;margin-bottom:8px}
input,select{width:100%;height:48px;border:1px solid #d1d9e6;border-radius:8px;background:#f8fafc;padding:0 14px;font-size:14px;color:#0f172a}
input:focus,select:focus{outline:none;border-color:#2563eb;background:white;box-shadow:0 0 0 4px rgba(37,99,235,.12)}
.form-buttons{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:24px}
button,.auth-link{height:48px;border:none;border-radius:8px;font-weight:800;cursor:pointer;text-decoration:none;display:flex;align-items:center;justify-content:center}
.btn-submit{background:linear-gradient(135deg,#10b981,#059669);color:white}
.btn-back{background:#eef2f7;color:#0f172a;border:1px solid #dbe3ee}
.notification{padding:13px 14px;border-radius:8px;margin-bottom:18px;font-weight:700;font-size:14px}
.notification.error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca}
@media(max-width:900px){.auth-shell{grid-template-columns:1fr}.auth-brand{padding:30px}.auth-panel{padding:30px}}
@media(max-width:620px){body{padding:12px}.form-row,.form-buttons{grid-template-columns:1fr}.brand-text h1{font-size:32px}}
</style>
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