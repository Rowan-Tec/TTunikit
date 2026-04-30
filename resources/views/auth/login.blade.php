<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vuexy| Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="redirect-url" content="{{ route('dashboard') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Light mode colors */
            --primary: #0066cc;
            --primary-dark: #0052a3;
            --primary-light: #1a75ff;
            --secondary: #000000;
            --accent: #0066cc;
            --text-primary: #000000;
            --text-secondary: #333333;
            --text-muted: #666666;
            --bg-surface: #ffffff;
            --bg-subtle: #ffffff;
            --border-color: #cccccc;
            --card-bg: #ffffff;
            --success: #71dd37;
            --error: #ff3e1d;
            --warning: #ffab00;
            --shadow-lg: 0 12px 32px rgba(0, 102, 204, 0.15);
            --radius: 12px;
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="dark"] {
            /* Dark mode colors */
            --primary: #4d94ff;
            --primary-dark: #1a75ff;
            --primary-light: #66a3ff;
            --secondary: #ffffff;
            --accent: #4d94ff;
            --text-primary: #ffffff;
            --text-secondary: #e0e0e0;
            --text-muted: #a0a0a0;
            --bg-surface: #1a1a1a;
            --bg-subtle: #2d2d2d;
            --border-color: #404040;
            --card-bg: #2d2d2d;
            --success: #32d74b;
            --error: #ff453a;
            --warning: #ff9f0a;
            --shadow-lg: 0 12px 32px rgba(0, 0, 0, 0.5);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Public Sans', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: var(--bg-surface);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--text-primary);
            line-height: 1.6;
            transition: var(--transition);
        }

        .back-to-home {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: var(--transition);
            margin-top: 1rem;
        }

        .back-to-home:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .back-to-home i {
            font-size: 12px;
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

        .login-header-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 20px;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 24px rgba(0, 102, 204, 0.15);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0px); }
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
            border: 3px solid var(--border-color);
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
        }

        .form-input::placeholder { color: var(--text-muted); opacity: 0.8; }

        .form-input.error {
            border-color: var(--error);
            box-shadow: 0 0 0 4px rgba(255, 62, 29, 0.1);
        }
        
        /* Field error highlighting */
        .field-error {
            border-color: #dc3545 !important;
            background-color: #fff5f5 !important;
            box-shadow: 0 0 0 2px rgba(220, 53, 69, 0.25) !important;
        }
        
        .field-error:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.3) !important;
        }
        
        .input-wrapper.field-error {
            position: relative;
        }
        
        .input-wrapper.field-error::after {
            content: '!';
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: #dc3545;
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            z-index: 1;
        }
        
        /* Field error message styling */
        .field-error-message {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.75rem;
            color: #dc3545;
            font-weight: 500;
            line-height: 1.4;
            animation: fadeIn 0.3s ease-in-out;
        }
        
        .field-error-message:before {
            content: '';
            display: inline-block;
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 4px solid #dc3545;
            margin-right: 0.25rem;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
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

        /* Enhanced select dropdown styling for visibility */
        .form-input {
            background: var(--bg-surface);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .form-input:focus {
            border-color: var(--primary);
            background: var(--bg-surface);
        }

        /* Light mode select styling */
        select.form-input {
            background: white;
            color: #333;
            border-color: #ddd;
        }

        select.form-input:focus {
            border-color: var(--primary);
            background: white;
        }

        select.form-input option {
            background: white;
            color: #333;
        }

        select.form-input option:hover {
            background: var(--primary);
            color: white;
        }

        /* Dark mode input field styling */
        [data-theme="dark"] .form-input {
            background: var(--bg-surface) !important;
            color: var(--text-primary) !important;
            border-color: var(--border-color) !important;
        }

        [data-theme="dark"] .form-input:focus {
            border-color: var(--primary) !important;
            background: var(--bg-surface) !important;
        }

        [data-theme="dark"] .form-label {
            color: var(--text-primary);
        }

        [data-theme="dark"] .form-input::placeholder {
            color: var(--text-muted);
        }

        /* Dark mode for all select dropdowns */
        [data-theme="dark"] select.form-input {
            background: var(--bg-surface) !important;
            color: var(--text-primary) !important;
            border-color: var(--border-color) !important;
        }

        [data-theme="dark"] select.form-input:focus {
            border-color: var(--primary) !important;
            background: var(--bg-surface) !important;
        }

        [data-theme="dark"] select.form-input option {
            background: var(--bg-surface) !important;
            color: var(--text-primary) !important;
        }

        [data-theme="dark"] select.form-input option:hover {
            background: var(--primary) !important;
            color: white !important;
        }

        [data-theme="dark"] select.form-input option:checked {
            background: var(--primary) !important;
            color: white !important;
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
                <img src="{{ asset('image.png') }}" 
                     alt="TIRELO CAPITAL Login" 
                     class="login-header-image">
                <p style="color: #000000; font-weight: 600;">Sign in to access your admin panel & analytics</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
            <div id="formMessage" class="form-message show success" role="alert" aria-live="polite">
                <i class="fas fa-circle-check"></i>
                <span>{{ session('status') }}</span>
            </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
            <div id="formMessage" class="form-message show error" role="alert" aria-live="polite">
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
                            aria-describedby="email-help"
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
                            aria-describedby="password-help"
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

                <button type="submit" class="btn-submit" id="submitBtn" aria-describedby="formMessage">
                    <span class="btn-text">Sign In to Vuexy</span>
                    <span class="spinner"></span>
                </button>
                
                <div style="text-align: center;">
                    <a href="{{ route('home') }}" class="back-to-home">
                        <i class="fas fa-arrow-left"></i>
                        Back to Home
                    </a>
                </div>
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
                    <a href="{{ url('/privacy') }}">Privacy Policy</a>
                    <a href="{{ url('/terms') }}">Terms of Service</a>
                    <a href="{{ url('/security') }}">Security</a>
                    <a href="{{ url('/help') }}">Help Center</a>
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
            
            // Validation checks - highlight specific fields
            let hasError = false;
            
            if (!email) {
                const field = document.getElementById('email');
                field.classList.add('field-error');
                const wrapper = field.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                showFieldError(field, 'email', 'Email address is required');
                hasError = true;
            }
            
            if (!password) {
                const field = document.getElementById('password');
                field.classList.add('field-error');
                const wrapper = field.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                showFieldError(field, 'password', 'Password is required');
                hasError = true;
            }
            
            // If there are any validation errors, stop submission
            if (hasError) {
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
                
                // Validate response structure before accessing properties
                if (!response.ok) {
                    if (data && typeof data === 'object') {
                        if (data.errors && typeof data.errors === 'object') {
                            const firstError = Object.values(data.errors)[0];
                            if (Array.isArray(firstError) && firstError.length > 0) {
                                showMessage(firstError[0], 'error');
                            } else {
                                showMessage('Validation error occurred.', 'error');
                            }
                        } else if (data.message && typeof data.message === 'string') {
                            showMessage(data.message, 'error');
                        } else {
                            showMessage('Invalid credentials.', 'error');
                        }
                    } else {
                        showMessage('Server error occurred.', 'error');
                    }
                    btn.classList.remove('loading');
                    btn.disabled = false;
                    return;
                }
                
                // Success case - validate response structure
                if (data && typeof data === 'object') {
                    showMessage('✅ Welcome back! Redirecting...', 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect || document.querySelector('meta[name="redirect-url"]')?.content || '/dashboard';
                    }, 1200);
                } else {
                    showMessage('Login successful but invalid response format.', 'error');
                    btn.classList.remove('loading');
                    btn.disabled = false;
                }
                
            } catch (error) {
                console.error('Login error:', error);
                
                // Handle different types of errors
                if (error.name === 'TypeError' && error.message.includes('fetch')) {
                    showMessage('Network error. Please check your internet connection.', 'error');
                } else if (error.name === 'SyntaxError') {
                    showMessage('Server response error. Please try again.', 'error');
                } else {
                    showMessage('An unexpected error occurred. Please try again.', 'error');
                }
                
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
        
        // Function to show error message under field
        function showFieldError(field, fieldName, message) {
            // Remove existing error message
            hideFieldError(field, fieldName);
            
            // Create error message element
            const errorDiv = document.createElement('div');
            errorDiv.className = 'field-error-message';
            errorDiv.textContent = message;
            errorDiv.id = `error-${fieldName}`;
            
            // Insert after the field wrapper
            const wrapper = field.closest('.input-wrapper');
            if (wrapper) {
                wrapper.parentNode.insertBefore(errorDiv, wrapper.nextSibling);
            }
        }
        
        // Function to hide error message under field
        function hideFieldError(field, fieldName) {
            const errorDiv = document.getElementById(`error-${fieldName}`);
            if (errorDiv) {
                errorDiv.remove();
            }
        }
        
        // Auto-remove error class on input for better UX
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) {
                    wrapper.classList.remove('field-error');
                }
                // Hide error message
                hideFieldError(this, this.name);
            });
        });

        // Apply theme from home page if available
        function applyThemeFromHome() {
            const theme = sessionStorage.getItem('theme') || localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
            // Clear sessionStorage to avoid conflicts
            sessionStorage.removeItem('theme');
        }

        // Initialize theme on page load
        document.addEventListener('DOMContentLoaded', applyThemeFromHome);
    </script>
</body>
</html>
