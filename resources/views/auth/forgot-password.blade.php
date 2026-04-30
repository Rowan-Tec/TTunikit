<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vuexy | Reset Password</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #0066cc;
            --primary-dark: #0052a3;
            --primary-light: #1a75ff;
            --text-primary: #000000;
            --text-secondary: #333333;
            --text-muted: #666666;
            --bg-surface: #ffffff;
            --bg-subtle: #ffffff;
            --border-color: #cccccc;
            --success: #71dd37;
            --error: #ff3e1d;
            --shadow-lg: 0 12px 32px rgba(0, 102, 204, 0.15);
            --radius: 12px;
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Public Sans', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #ffffff;
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
                <div class="brand-name" style="color: #000000; font-weight: 700;">TIRELO CAPITAL</div>
            </div>

            <div class="card-header">
                <img src="{{ asset('image.png') }}" 
                     alt="TIRELO CAPITAL Forgot Password" 
                     class="login-header-image">
                <p style="color: #000000; font-weight: 600;">Enter your email and we'll send you a reset link</p>
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

            <form id="forgotForm" method="POST" action="{{ route('password.email') }}" novalidate>
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
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

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="btn-text">Send Reset Link</span>
                    <span class="spinner"></span>
                </button>
            </form>

            <footer class="card-footer">
                <p>Remember your password? <a href="{{ route('login') }}">Sign In</a></p>
            </footer>
        </main>
    </div>

    <script>
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.content || '';
        }

        document.getElementById('forgotForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value.trim();
            
            // Validation check - highlight specific field
            if (!email) {
                const field = document.getElementById('email');
                field.classList.add('field-error');
                const wrapper = field.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                showFieldError(field, 'email', 'Email address is required');
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
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    showMessage('✅ Password reset link sent! Check your email.', 'success');
                    btn.classList.remove('loading');
                    btn.disabled = false;
                } else {
                    if (data.errors) {
                        const firstError = Object.values(data.errors)[0][0];
                        showMessage(firstError, 'error');
                    } else {
                        showMessage(data.message || 'Failed to send reset link', 'error');
                    }
                    btn.classList.remove('loading');
                    btn.disabled = false;
                }
                
            } catch (error) {
                showMessage('An unexpected error occurred.', 'error');
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
            document.querySelector('.login-card').insertBefore(div, document.getElementById('forgotForm'));
            return div;
        }
        
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
        const input = document.getElementById('email');
        input.addEventListener('input', function() {
            this.classList.remove('field-error');
            const wrapper = this.closest('.input-wrapper');
            if (wrapper) {
                wrapper.classList.remove('field-error');
            }
            // Hide error message
            hideFieldError(this, 'email');
        });
    </script>
</body>
</html>
