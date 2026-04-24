<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vuexy | Verify Email</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #696cff;
            --primary-dark: #5558e6;
            --primary-light: #8a8dff;
            --text-primary: #2e3d52;
            --text-secondary: #5a6a85;
            --text-muted: #8a99af;
            --bg-surface: #ffffff;
            --bg-subtle: #f8f9fc;
            --border-color: #e4e6ef;
            --success: #71dd37;
            --error: #ff3e1d;
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
            padding: 20px;
            color: var(--text-primary);
            line-height: 1.6;
        }

        .login-container { width: 100%; max-width: 480px; }

        .brand-header {
            text-align: center;
            margin-bottom: 2.25rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .brand-logo-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(105, 108, 255, 0.35);
            margin: 0 auto 1rem;
        }

        .brand-name {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.03em;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-card {
            background: var(--bg-surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            padding: 2.5rem;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light), var(--primary));
            background-size: 200% 100%;
            animation: gradientShift 4s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .card-header { margin-bottom: 2rem; text-align: center; }
        
        .card-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }
        
        .card-header p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .info-message {
            background: linear-gradient(135deg, #f0f4ff, #e8eeff);
            border: 1px solid #c7d2fe;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .info-message i {
            color: var(--primary);
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .form-message {
            display: none;
            padding: 0.85rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-bottom: 1.25rem;
            align-items: center;
            gap: 0.6rem;
            font-weight: 500;
        }

        .form-message.show { display: flex; }
        .form-message.success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
        }
        .form-message i { font-size: 1.1rem; }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .btn {
            flex: 1;
            padding: 1rem;
            border: none;
            border-radius: 10px;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(105, 108, 255, 0.35);
        }

        .btn-secondary {
            background: var(--bg-subtle);
            color: var(--text-secondary);
            border: 2px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--bg-surface);
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn:disabled {
            opacity: 0.75;
            cursor: not-allowed;
            transform: none;
        }

        .btn .spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2.5px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.75s linear infinite;
        }

        .btn.loading .btn-text { display: none; }
        .btn.loading .spinner { display: inline-block; }

        @keyframes spin { to { transform: rotate(360deg); } }

        .card-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .card-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
        .card-footer a:hover { 
            color: var(--primary-dark);
            text-decoration: underline; 
        }

        @media (max-width: 520px) {
            .login-card { padding: 2rem 1.75rem; }
            .form-actions { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <main class="login-card">
            <div class="brand-header">
                <div class="brand-logo-icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <div class="brand-name">Vuexy</div>
            </div>

            <div class="card-header">
                <h1>Verify Email</h1>
                <p>Thanks for signing up! Please verify your email address</p>
            </div>

            <div class="info-message">
                <i class="fas fa-info-circle"></i>
                <span>Click on the link we just emailed to you. If you didn't receive the email, we will gladly send you another.</span>
            </div>

            @if (session('status') == 'verification-link-sent')
            <div class="form-message show success" role="alert">
                <i class="fas fa-circle-check"></i>
                <span>A new verification link has been sent to your email address</span>
            </div>
            @endif

            <div class="form-actions">
                <form method="POST" action="{{ route('verification.send') }}" style="flex: 1;">
                    @csrf
                    <button type="submit" class="btn btn-primary" id="resendBtn">
                        <span class="btn-text">Resend Verification Email</span>
                        <span class="spinner"></span>
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" style="flex: 1;">
                    @csrf
                    <button type="submit" class="btn btn-secondary">
                        <span>Log Out</span>
                    </button>
                </form>
            </div>

            <footer class="card-footer">
                <p>Already verified? <a href="{{ route('login') }}">Sign In</a></p>
            </footer>
        </main>
    </div>

    <script>
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.content || '';
        }

        document.getElementById('resendBtn')?.addEventListener('click', async function(e) {
            e.preventDefault();
            
            const btn = this;
            btn.classList.add('loading');
            btn.disabled = true;
            
            try {
                const formData = new FormData(btn.closest('form'));
                
                const response = await fetch(btn.closest('form').action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': getCsrfToken(),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    showMessage('✅ Verification email sent successfully!', 'success');
                } else {
                    showMessage(data.message || 'Failed to resend verification email', 'error');
                }
                
                btn.classList.remove('loading');
                btn.disabled = false;
                
            } catch (error) {
                showMessage('An unexpected error occurred. Please try again.', 'error');
                btn.classList.remove('loading');
                btn.disabled = false;
            }
        });

        function showMessage(text, type = 'success') {
            const msgEl = document.querySelector('.form-message.show') || createMessageElement();
            const msgText = msgEl.querySelector('span') || msgEl;
            
            if (msgText.tagName === 'SPAN') {
                msgText.textContent = text;
            } else {
                msgEl.innerHTML = '<i class="fas fa-circle-info"></i><span>' + text + '</span>';
            }
            msgEl.className = `form-message ${type} show`;
            
            if (type !== 'success') {
                setTimeout(() => {
                    msgEl.classList.remove('show');
                }, 6000);
            }
        }

        function createMessageElement() {
            const div = document.createElement('div');
            div.innerHTML = '<i class="fas fa-circle-info"></i><span></span>';
            document.querySelector('.card-header').insertAdjacentElement('afterend', div);
            return div;
        }
    </script>
</body>
</html>
