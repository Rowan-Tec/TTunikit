<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vuexy | Admin Dashboard Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Identity Services SDK -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
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

        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 0.75rem;
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
            position: relative;
            overflow: hidden;
        }

        .brand-logo-icon::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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

        .brand-tagline {
            color: var(--text-secondary);
            font-size: 0.95rem;
            font-weight: 500;
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

        .form-group { margin-bottom: 1.4rem; }

        .form-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.6rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-primary);
        }

        .form-label a {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: var(--transition);
        }
        .form-label a:hover { 
            color: var(--primary-dark);
            text-decoration: underline; 
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
            transition: var(--transition);
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

        .form-input:focus + .input-icon,
        .form-input:not(:placeholder-shown) + .input-icon {
            color: var(--primary);
        }

        .form-input::placeholder { color: var(--text-muted); opacity: 0.8; }

        .form-input.error {
            border-color: var(--error);
            box-shadow: 0 0 0 4px rgba(255, 62, 29, 0.1);
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 1.25rem 0 1.75rem;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .checkbox-group input {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
            cursor: pointer;
            border-radius: 4px;
        }

        .checkbox-group label {
            font-size: 0.9rem;
            color: var(--text-secondary);
            cursor: pointer;
            user-select: none;
            font-weight: 500;
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
            position: relative;
            overflow: hidden;
            letter-spacing: -0.01em;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-submit:hover::before { left: 100%; }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(105, 108, 255, 0.35);
        }

        .btn-submit:active { transform: translateY(0); }
        .btn-submit:disabled {
            opacity: 0.75;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
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

        .divider {
            display: flex;
            align-items: center;
            margin: 1.75rem 0;
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
        }
        .divider::before, .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }
        .divider span { padding: 0 1.25rem; }

        .google-signin-container {
            display: flex;
            justify-content: center;
            margin: 1rem 0 1.5rem;
        }

        .google-signin-container > div {
            width: 100%;
            max-width: 320px;
        }

        .google-signin-container .g_id_signin {
            width: 100% !important;
            border-radius: 10px !important;
            overflow: hidden;
        }

        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 0.85rem 1rem;
            background: linear-gradient(135deg, #f0f4ff, #e8eeff);
            border: 1px solid #c7d2fe;
            border-radius: 10px;
            margin-top: 1.25rem;
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .security-badge i { 
            color: var(--success); 
            font-size: 1.1rem;
        }

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
            transition: var(--transition);
        }
        .card-footer a:hover { 
            color: var(--primary-dark);
            text-decoration: underline; 
        }

        .compliance-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 1.25rem;
            font-size: 0.8rem;
        }
        .compliance-links a {
            color: var(--text-muted);
            text-decoration: none;
            transition: var(--transition);
        }
        .compliance-links a:hover {
            color: var(--text-secondary);
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
            animation: slideIn 0.3s ease;
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
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
        .form-message i { font-size: 1.1rem; flex-shrink: 0; }

        @media (max-width: 520px) {
            .login-card { padding: 2rem 1.75rem; }
            .form-options { flex-direction: column; align-items: flex-start; }
            .brand-name { font-size: 1.6rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        .sr-only {
            position: absolute;
            width: 1px; height: 1px;
            padding: 0; margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <main class="login-card">
            <div class="card-header">
                <h1>Welcome to Vuexy!</h1>
                <p>Sign in to access your admin panel & analytics</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
            <div class="form-message show success" role="alert">
                <i class="fas fa-circle-check"></i>
                <span>{{ session('status') }}</span>
            </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
            <div class="form-message show error" role="alert">
                <i class="fas fa-circle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            <!-- Laravel Login Form -->
            <form id="loginForm" method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">
                        Email Address
                        <a href="{{ route('password.request') }}">Need help?</a>
                    </label>
                    <div class="input-wrapper">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input @error('email') error @enderror" 
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                        >
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">
                        Password
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    </label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input @error('password') error @enderror" 
                            autocomplete="current-password"
                            required
                            minlength="8"
                        >
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>

                <div class="form-options">
                    <div class="checkbox-group">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Remember me</label>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="btn-text">Sign In to Vuexy</span>
                    <span class="spinner"></span>
                </button>
            </form>

            <!-- Security Badge -->
            <div class="security-badge">
                <i class="fas fa-shield-check"></i>
                <span>SSL Encrypted • SOC 2 Compliant • Secure Sign-In</span>
            </div>

            <!-- Footer -->
            <footer class="card-footer">
                <p>Don't have a Vuexy account? <a href="{{ route('register') }}">Sign Up</a></p>
                <div class="compliance-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Security</a>
                    <a href="#">Help Center</a>
                </div>
            </footer>
        </main>
    </div>

    <script>
        // CSRF Token Helper
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.content || '';
        }

        // Form Submission with AJAX
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = this;
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                showMessage('Please enter both email and password', 'error');
                return;
            }
            
            const btn = document.getElementById('submitBtn');
            btn.classList.add('loading');
            btn.disabled = true;
            
            try {
                const formData = new FormData(form);
                formData.append('remember', document.getElementById('remember').checked);
                
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': getCsrfToken(),
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    showMessage('✅ Welcome back! Redirecting...', 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect || '/dashboard';
                    }, 1200);
                } else {
                    if (data.errors) {
                        const firstError = Object.values(data.errors)[0][0];
                        showMessage(firstError, 'error');
                    } else {
                        showMessage(data.message || 'Invalid credentials', 'error');
                    }
                    btn.classList.remove('loading');
                    btn.disabled = false;
                }
                
            } catch (error) {
                console.error('Login error:', error);
                showMessage('An unexpected error occurred. Please try again.', 'error');
                btn.classList.remove('loading');
                btn.disabled = false;
            }
        });

        // Message Utilities
        function showMessage(text, type = 'error') {
            const msgEl = document.getElementById('formMessage') || createMessageElement();
            const msgText = msgEl.querySelector('span');
            
            msgText.textContent = text;
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
            document.querySelector('.login-card').insertBefore(div, document.getElementById('loginForm'));
            return div;
        }

        // Real-time Email Validation
        document.getElementById('email').addEventListener('blur', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.value && !emailRegex.test(this.value)) {
                this.classList.add('error');
            } else {
                this.classList.remove('error');
            }
        });
    </script>
</body>
</html>
