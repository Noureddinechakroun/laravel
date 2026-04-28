<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            background: #fafbfc;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            padding: 50px;
            width: 100%;
            max-width: 500px;
            animation: slideUp 0.5s ease-out;
            border: 1px solid rgba(220, 224, 228, 0.5);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-title {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .form-subtitle {
            text-align: center;
            color: #8b92a9;
            margin-bottom: 40px;
            font-size: 14px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 25px;
            display: flex;
            flex-direction: column;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        label {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        select {
            padding: 12px 15px;
            border: 1px solid #dce0e4;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
            background-color: #f8fafb;
            color: #2c3e50;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="date"]:focus,
        select:focus {
            outline: none;
            border-color: #b8c5d6;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(184, 197, 214, 0.1);
        }

        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #c4cdd5;
        }

        select {
            cursor: pointer;
        }

        .form-buttons {
            display: flex;
            gap: 15px;
            margin-top: 35px;
        }

        button {
            flex: 1;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn-submit {
            background: linear-gradient(135deg, #b8c5d6 0%, #a8b5c9 100%);
            color: #2c3e50;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(184, 197, 214, 0.2);
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(184, 197, 214, 0.35);
            background: linear-gradient(135deg, #c4cfe0 0%, #b4bfd5 100%);
        }

        .btn-submit:active:not(:disabled) {
            transform: translateY(-1px);
        }

        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-submit.loading {
            pointer-events: none;
        }

        .btn-back {
            background: #e8ecf0;
            color: #2c3e50;
            border: 1px solid #dce0e4;
        }

        .btn-back:hover {
            background: #dce0e4;
        }

        .spinner {
            display: inline-block;
            width: 14px;
            height: 14px;
            margin-right: 8px;
            border: 2px solid rgba(44, 62, 80, 0.3);
            border-top-color: #2c3e50;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .success-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            animation: fadeIn 0.3s ease-out;
        }

        .success-modal {
            background: #ffffff;
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: popUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .success-checkmark {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, #81c784 0%, #66bb6a 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 48px;
            color: white;
            box-shadow: 0 8px 20px rgba(129, 199, 132, 0.4);
            animation: scaleIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s both;
        }

        .success-title {
            font-size: 32px;
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: 700;
            animation: slideDown 0.5s ease-out 0.3s both;
        }

        .success-message {
            font-size: 16px;
            color: #8b92a9;
            margin-bottom: 30px;
            animation: slideDown 0.5s ease-out 0.4s both;
        }

        .redirect-timer {
            font-size: 14px;
            color: #b8c5d6;
            font-weight: 600;
            animation: slideDown 0.5s ease-out 0.5s both;
        }

        .redirect-timer strong {
            color: #81c784;
            font-size: 18px;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 24px;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            font-weight: 600;
            z-index: 1000;
            animation: slideIn 0.4s ease-out;
        }

        .notification.success {
            background: #e8f5e9;
            color: #2e7d32;
            border-left: 4px solid #81c784;
        }

        .notification.error {
            background: #ffebee;
            color: #c62828;
            border-left: 4px solid #ef5350;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes popUp {
            from {
                opacity: 0;
                transform: scale(0.7);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 30px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .form-buttons {
                flex-direction: column;
            }

            .form-title {
                font-size: 24px;
            }

            .notification {
                left: 20px;
                right: 20px;
                bottom: auto;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">Create Account</h1>
        <p class="form-subtitle">Join us today</p>

        @if ($errors->any())
            <div class="notification error" style="position: static; margin-bottom: 20px; animation: none;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('signup.store') }}" onsubmit="handleSubmit(event)">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" placeholder="John" value="{{ old('firstname') }}" required>
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Doe" value="{{ old('lastname') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="birthdate">Birth Date</label>
                    <input type="date" id="birthdate" name="birthdate" max="{{ date('Y-m-d') }}" value="{{ old('birthdate') }}" required>
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password (min. 6 characters)" required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-submit">Sign Up</button>
                <button type="button" class="btn-back" onclick="window.location.href='/login'">Back</button>
            </div>
        </form>
    </div>

    <script>
        const form = document.querySelector('form');

        function validateForm() {
            const firstname = document.getElementById('firstname').value.trim();
            const lastname = document.getElementById('lastname').value.trim();
            const birthdate = document.getElementById('birthdate').value;
            const gender = document.getElementById('gender').value;
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            if (!firstname) {
                alert('Please enter your first name');
                return false;
            }
            if (!lastname) {
                alert('Please enter your last name');
                return false;
            }
            if (!birthdate) {
                alert('Please enter your birth date');
                return false;
            }
            if (!gender) {
                alert('Please select your gender');
                return false;
            }
            if (!email) {
                alert('Please enter your email');
                return false;
            }
            if (!password || password.length < 6) {
                alert('Password must be at least 6 characters');
                return false;
            }
            return true;
        }

        function handleSubmit(event) {
            event.preventDefault();

            if (!validateForm()) {
                return;
            }

            form.submit();
        }

        form.addEventListener('submit', handleSubmit);
    </script>
