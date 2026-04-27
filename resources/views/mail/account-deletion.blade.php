<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Deletion Confirmation - Vuexy</title>
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
        .info {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .details {
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
            <h1>Account Deletion Confirmation</h1>
        </div>
        
        <div class="content">
            <p>Hi {{ $user->full_names ?? $user->name }},</p>
            
            <div class="warning">
                <h3>⚠️ Account Deletion Completed</h3>
                <p>Your Vuexy account has been permanently deleted as requested. All your personal data, login history, and account information have been removed from our systems.</p>
            </div>
            
            @if(isset($reason) && $reason)
            <div class="details">
                <h3>📋 Deletion Details</h3>
                <div class="detail-row">
                    <span class="detail-label">Reason provided:</span>
                    <span class="detail-value">{{ $reason }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email address:</span>
                    <span class="detail-value">{{ $user->email }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Username:</span>
                    <span class="detail-value">{{ $user->username }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Deletion date:</span>
                    <span class="detail-value">{{ now()->format('M d, Y H:i:s') }}</span>
                </div>
            </div>
            @endif
            
            <div class="info">
                <h3>🔒 Data Privacy</h3>
                <p>As per our privacy policy, all your personal data has been permanently deleted. We retain only anonymized usage statistics that cannot be traced back to your identity.</p>
            </div>
            
            <div class="warning">
                <h3>📧 Important Information</h3>
                <ul>
                    <li>This action is permanent and cannot be undone</li>
                    <li>You can no longer access your account or any associated services</li>
                    <li>Your email address has been removed from our mailing lists</li>
                    <li>If you change your mind, you'll need to create a new account</li>
                </ul>
            </div>
            
            <p>We're sorry to see you go. If you have any questions about your data or need assistance with anything else, please don't hesitate to contact our support team.</p>
            
            <p>Thank you for being part of the Vuexy community.</p>
        </div>
        
        <div class="footer">
            <p>This email was sent to {{ $user->email }} to confirm account deletion.</p>
            <p>&copy; {{ date('Y') }} Vuexy. All rights reserved.</p>
            <p>123 Business Street, Suite 100, City, State 12345</p>
            <p>If you have questions, please contact us at support@vuexy.com</p>
        </div>
    </div>
</body>
</html>
