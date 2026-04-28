<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .header p {
            color: #8b92a9;
            font-size: 16px;
        }

        .logout-btn {
            padding: 12px 24px;
            background: linear-gradient(135deg, #ef5350 0%, #e53935 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(239, 83, 80, 0.3);
        }

        .dashboard-content {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }

        .dashboard-content h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .welcome-message {
            color: #8b92a9;
            font-size: 16px;
            line-height: 1.6;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .feature-card {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            padding: 30px;
            border-radius: 15px;
            border-left: 4px solid #1976d2;
        }

        .feature-card h3 {
            color: #0d47a1;
            margin-bottom: 10px;
        }

        .feature-card p {
            color: #1565c0;
            font-size: 14px;
        }

        .admin-badge {
            display: inline-block;
            background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Admin Dashboard</h1>
                <p>Welcome to the administration panel</p>
            </div>
            <button class="logout-btn" onclick="logout()">Logout</button>
        </div>

        <div class="dashboard-content">
            <h2>Welcome to Admin Panel</h2>
            <p class="welcome-message">
                This is your admin dashboard. You have full access to manage users, settings, and all system configurations.
            </p>

            <div class="feature-grid">
                <div class="feature-card">
                    <h3>Manage Users</h3>
                    <p>View, edit, and manage all user accounts</p>
                </div>
                <div class="feature-card">
                    <h3>System Settings</h3>
                    <p>Configure and manage system-wide settings</p>
                </div>
                <div class="feature-card">
                    <h3>Reports</h3>
                    <p>View detailed analytics and reports</p>
                </div>
                <div class="feature-card">
                    <h3>Logs</h3>
                    <p>Monitor system logs and activities</p>
                </div>
            </div>

            <span class="admin-badge">Administrator Access</span>
        </div>
    </div>

    <script>
        function logout() {
            window.location.href = '/login';
        }
    </script>
</body>
</html>
