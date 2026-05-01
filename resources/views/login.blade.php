<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins,Arial,sans-serif}
body{min-height:100vh;display:grid;place-items:center;padding:24px;background:#eaf0f7}
.auth-shell{width:min(1040px,100%);display:grid;grid-template-columns:1fr 440px;background:white;border:1px solid #dbe3ee;border-radius:8px;overflow:hidden;box-shadow:0 30px 80px rgba(15,23,42,.18)}
.auth-brand{background:linear-gradient(145deg,#08111f,#0f172a 55%,#1d4ed8);color:white;padding:46px;display:flex;flex-direction:column;justify-content:space-between;min-height:620px}
.brand-name{font-size:30px;font-weight:800}
.brand-text h1{font-size:44px;line-height:1.1;margin-bottom:16px}
.brand-text p{color:#cbd5e1;font-size:16px;line-height:1.7;max-width:440px}
.brand-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}
.brand-stat{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:16px}
.brand-stat strong{display:block;font-size:22px}
.brand-stat span{color:#cbd5e1;font-size:12px}
.auth-panel{padding:48px;display:flex;flex-direction:column;justify-content:center}
.form-title{font-size:32px;font-weight:800;color:#0f172a;margin-bottom:8px}
.form-subtitle{color:#64748b;margin-bottom:30px}
.form-group{margin-bottom:18px}
label{display:block;font-size:13px;font-weight:700;color:#334155;margin-bottom:8px}
input{width:100%;height:48px;border:1px solid #d1d9e6;border-radius:8px;background:#f8fafc;padding:0 14px;font-size:14px;color:#0f172a}
input:focus{outline:none;border-color:#2563eb;background:white;box-shadow:0 0 0 4px rgba(37,99,235,.12)}
.form-buttons{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:26px}
button,.auth-link{height:48px;border:none;border-radius:8px;font-weight:800;cursor:pointer;text-decoration:none;display:flex;align-items:center;justify-content:center}
.btn-submit{background:linear-gradient(135deg,#2563eb,#1d4ed8);color:white}
.btn-reset{background:#eef2f7;color:#0f172a;border:1px solid #dbe3ee}
.notification{padding:13px 14px;border-radius:8px;margin-bottom:18px;font-weight:700;font-size:14px}
.notification.success{background:#ecfdf5;color:#166534;border:1px solid #bbf7d0}
.notification.error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca}
@media(max-width:860px){.auth-shell{grid-template-columns:1fr}.auth-brand{min-height:auto;padding:30px}.brand-stats{margin-top:28px}.auth-panel{padding:30px}}
@media(max-width:560px){body{padding:12px}.brand-text h1{font-size:34px}.brand-stats{grid-template-columns:1fr}.form-buttons{grid-template-columns:1fr}}
</style>
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
