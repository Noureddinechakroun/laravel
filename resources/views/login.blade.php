<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            max-width: 450px;
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

        input[type="email"],
        input[type="password"] {
            padding: 12px 15px;
            border: 1px solid #dce0e4;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
            background-color: #f8fafb;
            color: #2c3e50;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #b8c5d6;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(184, 197, 214, 0.1);
        }

        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #c4cdd5;
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

        .btn-reset {
            background: #e8ecf0;
            color: #2c3e50;
            border: 1px solid #dce0e4;
        }

        .btn-reset:hover {
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
        <h1 class="form-title">Welcome Back</h1>
        <p class="form-subtitle">Sign in to your account</p>

        <form method="POST" action="#" onsubmit="handleSubmit(event)">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-submit">Login</button>
                <button type="reset" class="btn-reset">Clear</button>
            </div>
        </form>
    </div>

    <script>
        const form = document.querySelector('form');
        const submitBtn = document.querySelector('.btn-submit');
        let isSubmitting = false;

        function validateForm() {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            if (!email || !isValidEmail(email)) {
                showNotification('Please enter a valid email address', 'error');
                return false;
            }
            if (!password || password.length < 1) {
                showNotification('Please enter your password', 'error');
                return false;
            }
            return true;
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.4s ease-out';
                setTimeout(() => notification.remove(), 400);
            }, 4000);
        }

        function toggleLoadingState(isLoading) {
            isSubmitting = isLoading;
            submitBtn.disabled = isLoading;
            
            if (isLoading) {
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = '<span class="spinner"></span>Logging in...';
            } else {
                submitBtn.classList.remove('loading');
                submitBtn.innerHTML = 'Login';
            }
        }

        function handleSubmit(event) {
            event.preventDefault();

            if (isSubmitting) return;

            if (!validateForm()) {
                return;
            }

            toggleLoadingState(true);

            setTimeout(() => {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                
                const data = {
                    email: email,
                    password: password
                };
                
                console.log('Login Data:', data);
                
                showNotification('Login successful! Redirecting...', 'success');
                
                setTimeout(() => {
                    toggleLoadingState(false);
                    form.reset();
                }, 2000);
            }, 2000);
        }

        form.addEventListener('submit', handleSubmit);

        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideOut {
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
