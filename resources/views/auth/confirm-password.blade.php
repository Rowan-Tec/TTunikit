<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vuexy | Confirm Password</title>
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

        .form-group { margin-bottom: 1.4rem; }

        .form-label {
            display: block;
            margin-bottom: 0.6rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-primary);
        }

        .input-wrapper { position: relative; }

        .input-icon {
            position: absolute;
            left: 1.1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1rem;
            pointer-events: none;
            z-index: 2;
        }

        .form-input {
            width: 100%;
            padding: 0.95rem 1.1rem 0.95rem 2.9rem;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 0.95rem;
            background: var(--bg-subtle);
            transition: var(--transition);
            outline: none;
            color: var(--text-primary);
        }

        .form-input:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 5px rgba(105, 108, 255, 0.12);
        }

        .form-input::placeholder { color: var(--text-muted); opacity: 0.8; }

        .form-input.error {
            border-color: var(--error);
            box-shadow: 0 0 0 4px rgba(255, 62, 29, 0.1);
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
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
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(105, 108, 255, 0.35);
        }

        .btn-submit:disabled {
            opacity: 0.75;
            cursor: not-allowed;
            transform: none;
        }

        .btn-submit .spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2.5px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.75s linear infinite;
        }

        .btn-submit.loading .btn-text { display: none; }
        .btn-submit.loading .spinner { display: inline-block; }

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
        .form-message.error {
            background: #fff5f5;
            border: 1px solid #fecaca;
            color: #dc2626;
        }
        .form-message.success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
        }
        .form-message i { font-size: 1.1rem; }

        @media (max-width: 520px) {
            .login-card { padding: 2rem 1.75rem; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <main class="login-card">
            <div class="brand-header">
                <div class="brand-logo-icon">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <div class="brand-name">Vuexy</div>
            </div>

            <div class="card-header">
                <h1>Confirm Password</h1>
                <p>This is a secure area of the application</p>
            </div>

            <div class="info-message">
                <i class="fas fa-info-circle"></i>
                <span>Please confirm your password before continuing</span>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
            <div class="form-message show error" role="alert">
                <i class="fas fa-circle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            <form id="confirmForm" method="POST" action="{{ route('password.confirm') }}" novalidate>
                @csrf

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input @error('password') error @enderror" 
                            autocomplete="current-password"
                            required
                        >
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="btn-text">Confirm</span>
                    <span class="spinner"></span>
                </button>
            </form>

            <footer class="card-footer">
                <p>Need help? <a href="{{ route('password.request') }}">Reset Password</a></p>
            </footer>
        </main>
    </div>

    <script>
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.content || '';
        }

        document.getElementById('confirmForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const password = document.getElementById('password').value;
            
            // Client-side validation
            if (!password) {
                showMessage('Please enter your password', 'error');
                return;
            }
            
            const btn = document.getElementById('submitBtn');
            btn.classList.add('loading');
            btn.disabled = true;
            
            try {
                const formData = new FormData(this);
                
                const response = await fetch(this.action, {
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
                    showMessage('✅ Password confirmed successfully!', 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect || '/dashboard';
                    }, 1500);
                } else {
                    if (data.errors) {
                        const firstError = Object.values(data.errors)[0][0];
                        showMessage(firstError, 'error');
                    } else {
                        showMessage(data.message || 'Failed to confirm password', 'error');
                    }
                    btn.classList.remove('loading');
                    btn.disabled = false;
                }
                
            } catch (error) {
                showMessage('An unexpected error occurred. Please try again.', 'error');
                btn.classList.remove('loading');
                btn.disabled = false;
            }
        });

        function showMessage(text, type = 'error') {
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

        // Auto-remove error class on input for better UX
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('error');
                const msgDiv = document.querySelector('.form-message.show');
                if (msgDiv) msgDiv.classList.remove('show');
            });
        });
    </script>
</body>
</html>
