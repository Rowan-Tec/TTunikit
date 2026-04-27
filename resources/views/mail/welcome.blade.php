<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Vuexy</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #696cff;
            margin-bottom: 10px;
        }
        .content {
            margin-bottom: 30px;
        }
        .button {
            display: inline-block;
            background: #696cff;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            color: #666;
            font-size: 12px;
            margin-top: 30px;
        }
        .security-info {
            background: #f8f9fc;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #696cff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Vuexy</div>
            <h1>Welcome to Your Account!</h1>
        </div>
        
        <div class="content">
            <p>Hi {{ $user->full_names ?? $user->name }},</p>
            
            <p>Thank you for registering with Vuexy! Your account has been successfully created and you're now part of our community.</p>
            
            <div class="security-info">
                <h3>🔐 Account Security</h3>
                <p>Your account is protected with industry-standard security measures. Please keep your login credentials safe and never share them with anyone.</p>
            </div>
            
            <p>You can now:</p>
            <ul>
                <li>Access your personalized dashboard</li>
                <li>Manage your profile information</li>
                <li>View your login activity logs</li>
                <li>Update your security settings</li>
            </ul>
            
            <p style="text-align: center;">
                <a href="{{ route('dashboard') }}" class="button">Access Your Dashboard</a>
            </p>
            
            <p>If you didn't create this account, please contact our support team immediately.</p>
        </div>
        
        <div class="footer">
            <p>This email was sent to {{ $user->email }} because you registered for a Vuexy account.</p>
            <p>&copy; {{ date('Y') }} Vuexy. All rights reserved.</p>
            <p>123 Business Street, Suite 100, City, State 12345</p>
        </div>
    </div>
</body>
</html>
