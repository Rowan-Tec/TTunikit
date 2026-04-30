<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Required</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #696cff;
            --primary-dark: #5558e6;
            --primary-light: #8a8dff;
            --secondary: #3e4a62;
            --accent: #696cff;
            --text-primary: #2e3d52;
            --text-secondary: #5a6a85;
            --text-muted: #8a99af;
            --bg-surface: #ffffff;
            --bg-subtle: #f8f9fc;
            --border-color: #e4e6ef;
            --success: #71dd37;
            --error: #ff3e1d;
            --warning: #ffab00;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.1);
            --shadow-lg: 0 12px 32px rgba(105, 108, 255, 0.15);
            --radius: 12px;
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Public Sans', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #f5f7ff 0%, #e8ecff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            color: var(--text-primary);
            line-height: 1.5;
        }

        .verify-container { 
            width: 100%; 
            max-width: 500px; 
            margin: 0 auto; 
            background: var(--bg-surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .verify-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .verify-header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .verify-header p {
            opacity: 0.9;
            font-size: 1rem;
        }

        .verify-body {
            padding: 2.5rem;
        }

        .verify-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
            box-shadow: var(--shadow-md);
        }

        .verify-message {
            text-align: center;
            margin-bottom: 2rem;
        }

        .verify-message h2 {
            color: var(--text-primary);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .verify-message p {
            color: var(--text-secondary);
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .verify-email {
            background: var(--bg-subtle);
            padding: 1rem;
            border-radius: var(--radius);
            font-family: monospace;
            font-size: 1.1rem;
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }

        .resend-link {
            text-align: center;
            margin-top: 2rem;
        }

        .resend-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .resend-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .verify-container { margin: 20px; }
            .verify-header { padding: 1.5rem; }
            .verify-body { padding: 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="verify-container">
        <div class="verify-header">
            <h1>Email Verification Required</h1>
            <p>Please verify your email to continue</p>
        </div>

        <div class="verify-body">
            <div class="verify-icon">
                <i class="fas fa-envelope"></i>
            </div>

            <div class="verify-message">
                <h2>Account Created - Verification Required</h2>
                <p>Your account has been created but is not yet active. Please check your email inbox and click on the verification link to activate your account.</p>
                <p><strong>Important:</strong> Your account must be verified before you can login. Please complete the email verification process to activate your account.</p>
                <p>If you don't see the email within a few minutes, please check your spam folder.</p>
            </div>

            <div class="action-links">
                <div class="back-link">
                    <a href="{{ route('register') }}" class="back-button">
                        <i class="fas fa-arrow-left"></i>
                        Back to Registration
                    </a>
                </div>
                
                <div class="resend-link">
                    <p>Didn't receive the email? <a href="#" id="resendLink" onclick="resendVerificationEmail(event)">Resend verification email</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function resendVerificationEmail(event) {
            event.preventDefault();
            
            // Show loading state
            const resendLink = document.getElementById('resendLink');
            const originalText = resendLink.textContent;
            resendLink.textContent = 'Sending...';
            resendLink.style.pointerEvents = 'none';
            
            // Simulate sending email (replace with actual API call)
            setTimeout(() => {
                // Show popup message
                showPopupMessage('Verification email has been sent to your email address. Please check your inbox and spam folder.');
                
                // Reset link
                resendLink.textContent = originalText;
                resendLink.style.pointerEvents = 'auto';
            }, 1500);
        }
        
        function showPopupMessage(message) {
            // Create popup element
            const popup = document.createElement('div');
            popup.className = 'popup-message';
            popup.innerHTML = `
                <div class="popup-content">
                    <div class="popup-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <p>${message}</p>
                    <button onclick="closePopupMessage()" class="popup-close">OK</button>
                </div>
            `;
            
            // Add popup to page
            document.body.appendChild(popup);
            
            // Auto-close after 5 seconds
            setTimeout(() => {
                closePopupMessage();
            }, 5000);
        }
        
        function closePopupMessage() {
            const popup = document.querySelector('.popup-message');
            if (popup) {
                popup.remove();
            }
        }
    </script>
    
    <style>
        /* Accessibility improvements for colorblind users */
        :root {
            --primary: #0066cc;
            --primary-dark: #0052a3;
            --success: #2d7d32;
            --error: #d32f2f;
            --warning: #f57c00;
        }
        
        /* High contrast for better visibility */
        .verify-container {
            border: 2px solid var(--primary);
        }
        
        .verify-header {
            background: var(--primary);
            color: white;
        }
        
        .verify-icon {
            background: var(--primary);
            color: white;
        }
        
        /* Popup message styles */
        .popup-message {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        
        .popup-content {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            max-width: 400px;
            text-align: center;
            border: 2px solid var(--primary);
        }
        
        .popup-icon {
            font-size: 2rem;
            color: var(--success);
            margin-bottom: 1rem;
        }
        
        .popup-close {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 1rem;
        }
        
        .popup-close:hover {
            background: var(--primary-dark);
        }
        
        /* Focus indicators for keyboard navigation */
        button:focus,
        a:focus,
        input:focus {
            outline: 3px solid var(--primary);
            outline-offset: 2px;
        }
        
        /* High contrast text */
        .verify-message h2 {
            color: #000;
            font-weight: bold;
        }
        
        .verify-message p {
            color: #333;
            line-height: 1.6;
        }
        
        /* Action links styling */
        .action-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .back-link {
            flex: 1;
        }
        
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #6c757d;
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .back-button:hover {
            background: #5a6268;
            transform: translateY(-1px);
        }
        
        .back-button:focus {
            outline: 3px solid var(--primary);
            outline-offset: 2px;
        }
        
        .resend-link {
            flex: 1;
            text-align: right;
        }
        
        /* Clear link styling */
        .resend-link a {
            color: var(--primary);
            text-decoration: underline;
            font-weight: bold;
        }
        
        .resend-link a:hover {
            color: var(--primary-dark);
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .action-links {
                flex-direction: column;
                text-align: center;
            }
            
            .resend-link {
                text-align: center;
            }
            
            .back-button {
                justify-content: center;
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</body>
</html>
