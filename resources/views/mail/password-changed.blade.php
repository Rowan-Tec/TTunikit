<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Changed - Vuexy</title>
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
        .success-info {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .security-info {
            background: #fef3c7;
            border: 1px solid #fcd34d;
            color: #d97706;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .warning {
            background: #fff5f5;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .activity-details {
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
            <h1>Password Successfully Changed</h1>
        </div>
        
        <div class="content">
            <p>Hi {{ $user->full_names ?? $user->name }},</p>
            
            <div class="success-info">
                <h3>✅ Password Update Confirmation</h3>
                <p>Your password for your Vuexy account has been successfully changed.</p>
            </div>
            
            @if(isset($loginActivity))
            <div class="activity-details">
                <h3>📍 Activity Details</h3>
                <p><strong>IP Address:</strong> {{ $loginActivity->ip_address }}</p>
                <p><strong>Location:</strong> {{ $loginActivity->location ?? 'Unknown' }}</p>
                <p><strong>Device:</strong> {{ $loginActivity->device ?? 'Unknown' }}</p>
                <p><strong>Time:</strong> {{ $loginActivity->created_at->format('M d, Y H:i:s') }}</p>
            </div>
            @endif
            
            <div class="security-info">
                <h3>🔐 Security Recommendations</h3>
                <ul>
                    <li>Ensure your new password is strong and unique</li>
                    <li>Don't reuse passwords from other accounts</li>
                    <li>Consider enabling two-factor authentication</li>
                    <li>Regularly update your passwords</li>
                </ul>
            </div>
            
            <div class="warning">
                <h3>⚠️ Important Security Notice</h3>
                <p>If you didn't change your password, please take immediate action:</p>
                <ul>
                    <li>Contact our support team immediately</li>
                    <li>Review your account for any unauthorized activity</li>
                    <li>Consider changing your password again</li>
                </ul>
            </div>
            
            <p style="text-align: center;">
                <a href="{{ route('dashboard') }}" class="button">Go to Dashboard</a>
            </p>
            
            <p>If you have any questions or concerns about your account security, please don't hesitate to contact our support team.</p>
        </div>
        
        <div class="footer">
            <p>This email was sent to {{ $user->email }} to confirm a password change for your Vuexy account.</p>
            <p>&copy; {{ date('Y') }} Vuexy. All rights reserved.</p>
            <p>123 Business Street, Suite 100, City, State 12345</p>
        </div>
    </div>
</body>
</html>
