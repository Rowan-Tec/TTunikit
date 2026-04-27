<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Login Detected - Vuexy</title>
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
        .activity-info {
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
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }
        .detail-label {
            font-weight: bold;
            color: #5a6a85;
        }
        .detail-value {
            color: #2e3d52;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Vuexy</div>
            <h1>New Login Detected</h1>
        </div>
        
        <div class="content">
            <p>Hi {{ $user->full_names ?? $user->name }},</p>
            
            <div class="activity-info">
                <h3>🔓 Login Activity Detected</h3>
                <p>We detected a new login to your Vuexy account. Here are the details:</p>
            </div>
            
            @if(isset($loginActivity))
            <div class="activity-details">
                <h3>📍 Login Details</h3>
                <div class="detail-row">
                    <span class="detail-label">Time:</span>
                    <span class="detail-value">{{ $loginActivity->created_at->format('M d, Y H:i:s') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">IP Address:</span>
                    <span class="detail-value">{{ $loginActivity->ip_address }}</span>
                </div>
                @if($loginActivity->location)
                <div class="detail-row">
                    <span class="detail-label">Location:</span>
                    <span class="detail-value">{{ $loginActivity->location }}</span>
                </div>
                @endif
                @if($loginActivity->device)
                <div class="detail-row">
                    <span class="detail-label">Device:</span>
                    <span class="detail-value">{{ $loginActivity->device }}</span>
                </div>
                @endif
                @if($loginActivity->browser)
                <div class="detail-row">
                    <span class="detail-label">Browser:</span>
                    <span class="detail-value">{{ $loginActivity->browser }}</span>
                </div>
                @endif
                @if($loginActivity->platform)
                <div class="detail-row">
                    <span class="detail-label">Platform:</span>
                    <span class="detail-value">{{ $loginActivity->platform }}</span>
                </div>
                @endif
            </div>
            @endif
            
            <div class="security-info">
                <h3>🔐 Security Information</h3>
                <p>This email helps you keep track of login activity on your account. You can view your complete login history in your dashboard.</p>
            </div>
            
            <div class="warning">
                <h3>⚠️ If This Wasn't You</h3>
                <p>If you don't recognize this login activity, please take immediate action:</p>
                <ul>
                    <li>Change your password immediately</li>
                    <li>Review your account for any unauthorized activity</li>
                    <li>Contact our support team</li>
                    <li>Consider enabling two-factor authentication</li>
                </ul>
            </div>
            
            <p style="text-align: center;">
                <a href="{{ route('dashboard') }}" class="button">View Dashboard</a>
            </p>
            
            <p>You can manage your security settings and view your complete login activity history in your dashboard.</p>
        </div>
        
        <div class="footer">
            <p>This email was sent to {{ $user->email }} to notify you of login activity on your Vuexy account.</p>
            <p>&copy; {{ date('Y') }} Vuexy. All rights reserved.</p>
            <p>123 Business Street, Suite 100, City, State 12345</p>
        </div>
    </div>
</body>
</html>
