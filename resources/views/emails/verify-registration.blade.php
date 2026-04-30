<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email Address</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #0066cc;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 8px 8px;
            border: 1px solid #ddd;
        }
        .button {
            display: inline-block;
            background: #0066cc;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .button:hover {
            background: #0052a3;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Verify Your Email Address</h1>
    </div>
    
    <div class="content">
        <p>Hello {{ $pendingRegistration->full_names }},</p>
        
        <p>Thank you for starting your registration. Please click the button below to verify your email address and complete your account creation.</p>
        
        <p><strong>Important:</strong> Your account will only be created and saved to our system after you verify your email address.</p>
        
        <div style="text-align: center;">
            <a href="{{ $verificationUrl }}" class="button">Verify Email Address</a>
        </div>
        
        <p>This verification link will expire in 24 hours.</p>
        
        <p>If you did not start this registration, you can safely ignore this email.</p>
        
        <p>If the button above doesn't work, you can copy and paste this link into your browser:</p>
        <p>{{ $verificationUrl }}</p>
    </div>
    
    <div class="footer">
        <p>Thank you for choosing our service!</p>
        <p>This is an automated message, please do not reply to this email.</p>
    </div>
</body>
</html>
