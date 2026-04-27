<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request - Vuexy</title>
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
        .warning {
            background: #fff5f5;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .security-info {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .expiry-info {
            background: #fef3c7;
            border: 1px solid #fcd34d;
            color: #d97706;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Vuexy</div>
            <h1>Password Reset Request</h1>
        </div>
        
        <div class="content">
            <p>Hi {{ $user->full_names ?? $user->name }},</p>
            
            <p>We received a request to reset your password for your Vuexy account. If you made this request, please click the button below to reset your password:</p>
            
            <p style="text-align: center;">
                <a href="{{ route('password.reset', $token) }}" class="button">Reset Password</a>
            </p>
            
            <div class="expiry-info">
                <h3>⏰ Link Expiry</h3>
                <p>This password reset link will expire in {{ config('auth.passwords.users.expire') }} minutes for security reasons.</p>
            </div>
            
            <div class="security-info">
                <h3>🔐 Security Notice</h3>
                <p>If you didn't request a password reset, please ignore this email. Your password will remain unchanged.</p>
            </div>
            
            <div class="warning">
                <h3>⚠️ Important Security Information</h3>
                <ul>
                    <li>Never share this password reset link with anyone</li>
                    <li>Always check that you're on the official Vuexy website</li>
                    <li>Create a strong, unique password</li>
                    <li>Enable two-factor authentication if available</li>
                </ul>
            </div>
            
            <p>If the button above doesn't work, you can copy and paste this link into your browser:</p>
            <p style="word-break: break-all; background: #f8f9fc; padding: 10px; border-radius: 5px;">
                {{ route('password.reset', $token) }}
            </p>
            
            <p>If you continue to have problems, please contact our support team.</p>
        </div>
        
        <div class="footer">
            <p>This email was sent to {{ $user->email }} because a password reset was requested for this account.</p>
            <p>&copy; {{ date('Y') }} Vuexy. All rights reserved.</p>
            <p>123 Business Street, Suite 100, City, State 12345</p>
        </div>
    </div>
</body>
</html>
