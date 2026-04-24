<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vuexy | Complete Registration - Admin Dashboard</title>
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

        .login-container { width: 100%; max-width: 620px; margin: 0 auto; }

        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 0.5rem;
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
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-tagline {
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .login-card {
            background: var(--bg-surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            padding: 2.2rem 2.2rem 2rem;
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

        .card-header { margin-bottom: 1.8rem; text-align: center; }
        
        .card-header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.3rem;
        }
        
        .card-header p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .form-row {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 0.2rem;
        }
        .form-row .form-group {
            flex: 1;
            min-width: 140px;
        }

        .form-group { margin-bottom: 1.3rem; }

        .form-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-primary);
        }

        .form-label a {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.8rem;
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
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.95rem;
            pointer-events: none;
            transition: var(--transition);
            z-index: 2;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.6rem;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 0.9rem;
            background: var(--bg-subtle);
            transition: var(--transition);
            outline: none;
            color: var(--text-primary);
        }

        select.form-input {
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="%238a99af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>');
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 14px;
            padding-right: 2.5rem;
        }

        .form-input:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(105, 108, 255, 0.12);
        }

        .form-input:focus + .input-icon,
        .form-input:not(:placeholder-shown) + .input-icon {
            color: var(--primary);
        }

        .form-input::placeholder { color: var(--text-muted); opacity: 0.7; }

        .form-input.error {
            border-color: var(--error);
            box-shadow: 0 0 0 3px rgba(255, 62, 29, 0.1);
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 0.5rem 0 1.5rem;
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
        }

        .checkbox-group label {
            font-size: 0.85rem;
            color: var(--text-secondary);
            cursor: pointer;
            user-select: none;
            font-weight: 500;
        }

        .btn-submit {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            position: relative;
            overflow: hidden;
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
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-submit .spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 2.5px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        .btn-submit.loading .btn-text { display: none; }
        .btn-submit.loading .spinner { display: inline-block; }

        @keyframes spin { to { transform: rotate(360deg); } }

        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 0.7rem 1rem;
            background: linear-gradient(135deg, #f0f4ff, #e8eeff);
            border: 1px solid #c7d2fe;
            border-radius: 10px;
            margin-top: 1.5rem;
            font-size: 0.8rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .security-badge i { 
            color: var(--success); 
            font-size: 1rem;
        }

        .card-footer {
            text-align: center;
            margin-top: 1.8rem;
            padding-top: 1.2rem;
            border-top: 1px solid var(--border-color);
            font-size: 0.85rem;
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
            gap: 1.2rem;
            margin-top: 1rem;
            font-size: 0.75rem;
        }
        .compliance-links a {
            color: var(--text-muted);
            text-decoration: none;
        }
        .compliance-links a:hover {
            color: var(--text-secondary);
            text-decoration: underline;
        }

        .form-message {
            display: none;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 1.3rem;
            align-items: center;
            gap: 0.6rem;
            font-weight: 500;
            animation: slideIn 0.25s ease;
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-8px); }
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
        .form-message i { font-size: 1rem; flex-shrink: 0; }

        @media (max-width: 560px) {
            .login-card { padding: 1.8rem; }
            .form-row { flex-direction: column; gap: 0; }
            .brand-name { font-size: 1.5rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <main class="login-card">
            <div class="card-header">
                <h1>Create Vuexy Account</h1>
                <p>Secure access to your admin panel & analytics</p>
            </div>

            @if (session('status'))
            <div class="form-message show success" role="alert">
                <i class="fas fa-circle-check"></i>
                <span>{{ session('status') }}</span>
            </div>
            @endif

            @if ($errors->any())
            <div class="form-message show error" role="alert">
                <i class="fas fa-circle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            <form id="registerForm" method="POST" action="{{ route('register') }}" novalidate>
                @csrf

                <!-- Full names & Surname in one row -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="full_names">Full Names</label>
                        <div class="input-wrapper">
                            <input type="text" id="full_names" name="full_names" class="form-input" 
                                   value="{{ old('full_names') }}" autocomplete="given-name" required>
                            <i class="fas fa-user input-icon"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="surname">Surname</label>
                        <div class="input-wrapper">
                            <input type="text" id="surname" name="surname" class="form-input" 
                                   value="{{ old('surname') }}" autocomplete="family-name" required>
                            <i class="fas fa-user-tag input-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Email address -->
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" class="form-input" 
                               value="{{ old('email') }}" autocomplete="email" required>
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                </div>

                <!-- Cellphone -->
                <div class="form-group">
                    <label class="form-label" for="cellphone">Cellphone Number</label>
                    <div class="input-wrapper">
                        <input type="tel" id="cellphone" name="cellphone" class="form-input" 
                               value="{{ old('cellphone') }}" autocomplete="tel" required>
                        <i class="fas fa-phone-alt input-icon"></i>
                    </div>
                </div>

                <!-- Gender + Date of Birth row -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="gender">Gender</label>
                        <div class="input-wrapper">
                            <select id="gender" name="gender" class="form-input" required>
                                <option value="" disabled selected>Select gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="non-binary">Non-binary</option>
                                <option value="prefer-not-say">Prefer not to say</option>
                            </select>
                            <i class="fas fa-venus-mars input-icon"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="dob">Date of Birth</label>
                        <div class="input-wrapper">
                            <input type="date" id="dob" name="date_of_birth" class="form-input" 
                                   value="{{ old('date_of_birth') }}" required>
                            <i class="fas fa-calendar-alt input-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Password fields -->
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" class="form-input" 
                               autocomplete="new-password" required minlength="8">
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" 
                               autocomplete="new-password" required>
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>

                <div class="form-options">
                    <div class="checkbox-group">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">I agree to the <a href="#" style="color: var(--primary);">Terms & Privacy</a></label>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="btn-text">Create Account</span>
                    <span class="spinner"></span>
                </button>
            </form>

            <div class="security-badge">
                <i class="fas fa-shield-check"></i>
                <span>SSL Encrypted • GDPR Ready • Secure Registration</span>
            </div>

            <footer class="card-footer">
                <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
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
        // Helper: get CSRF token
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.content || '';
        }

        // Show dynamic message
        function showMessage(text, type = 'error') {
            let msgEl = document.getElementById('formMessage');
            if (!msgEl) {
                const div = document.createElement('div');
                div.id = 'formMessage';
                div.innerHTML = '<i class="fas fa-circle-info"></i><span></span>';
                const form = document.getElementById('registerForm');
                document.querySelector('.login-card').insertBefore(div, form);
                msgEl = div;
            }
            const msgText = msgEl.querySelector('span');
            msgText.textContent = text;
            msgEl.className = `form-message ${type} show`;
            if (type !== 'success') {
                setTimeout(() => {
                    if (msgEl) msgEl.classList.remove('show');
                }, 6000);
            }
        }

        // validate age (must be >= 13 years old)
        function isValidAge(dateString) {
            if (!dateString) return false;
            const birthDate = new Date(dateString);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age >= 13 && age <= 120;
        }

        // Validate cellphone (simple international format: at least 8 digits)
        function isValidCellphone(phone) {
            const digits = phone.replace(/[\s\-+()]/g, '');
            return digits.length >= 8 && /^[0-9]+$/.test(digits);
        }

        // attach realtime validation blur for new fields
        document.getElementById('cellphone')?.addEventListener('blur', function() {
            if (this.value && !isValidCellphone(this.value)) {
                this.classList.add('error');
                showMessage('Please enter a valid cellphone number (min 8 digits)', 'error');
                setTimeout(() => {
                    const msg = document.getElementById('formMessage');
                    if (msg) msg.classList.remove('show');
                }, 3000);
            } else {
                this.classList.remove('error');
            }
        });

        document.getElementById('dob')?.addEventListener('blur', function() {
            if (this.value && !isValidAge(this.value)) {
                this.classList.add('error');
                showMessage('You must be at least 13 years old to register', 'error');
                setTimeout(() => {
                    const msg = document.getElementById('formMessage');
                    if (msg) msg.classList.remove('show');
                }, 3500);
            } else {
                this.classList.remove('error');
            }
        });

        document.getElementById('email')?.addEventListener('blur', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.value && !emailRegex.test(this.value)) {
                this.classList.add('error');
            } else {
                this.classList.remove('error');
            }
        });

        // Main form submission with extended validation
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Gather all new fields
            const fullNames = document.getElementById('full_names').value.trim();
            const surname = document.getElementById('surname').value.trim();
            const email = document.getElementById('email').value.trim();
            const cellphone = document.getElementById('cellphone').value.trim();
            const gender = document.getElementById('gender').value;
            const dob = document.getElementById('dob').value;
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            const terms = document.getElementById('terms').checked;

            // Validation checks
            if (!fullNames) {
                showMessage('Full names are required', 'error');
                return;
            }
            if (!surname) {
                showMessage('Surname is required', 'error');
                return;
            }
            if (!email) {
                showMessage('Email address is required', 'error');
                return;
            }
            if (!cellphone) {
                showMessage('Cellphone number is required', 'error');
                return;
            }
            if (!isValidCellphone(cellphone)) {
                showMessage('Please provide a valid cellphone number (at least 8 digits)', 'error');
                return;
            }
            if (!gender) {
                showMessage('Please select your gender', 'error');
                return;
            }
            if (!dob) {
                showMessage('Date of birth is required', 'error');
                return;
            }
            if (!isValidAge(dob)) {
                showMessage('You must be at least 13 years old to register', 'error');
                return;
            }
            if (!password || password.length < 8) {
                showMessage('Password must be at least 8 characters', 'error');
                return;
            }
            if (password !== passwordConfirmation) {
                showMessage('Passwords do not match', 'error');
                return;
            }
            if (!terms) {
                showMessage('You must agree to the Terms & Privacy policy', 'error');
                return;
            }

            const btn = document.getElementById('submitBtn');
            btn.classList.add('loading');
            btn.disabled = true;
            
            try {
                const formData = new FormData(this);
                // Append fields explicitly to ensure proper naming for backend (already named in HTML)
                // For Laravel backend you can adapt: full_names, surname, cellphone, gender, date_of_birth.
                
                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': getCsrfToken(),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });
                
                const contentType = response.headers.get('content-type') || '';
                let data = null;

                if (contentType.includes('application/json')) {
                    data = await response.json();
                } else {
                    const text = await response.text();
                    console.warn('Registration expected JSON but received HTML:', text);
                    throw new Error('Unexpected server response.');
                }

                if (response.ok) {
                    showMessage('🎉 Account created successfully! Redirecting to dashboard...', 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect || '{{ route("dashboard") }}';
                    }, 1500);
                } else {
                    if (data?.errors) {
                        const firstError = Object.values(data.errors)[0][0];
                        showMessage(firstError, 'error');
                    } else if (data?.message) {
                        showMessage(data.message, 'error');
                    } else {
                        showMessage('Registration failed. Please check your details.', 'error');
                    }
                    btn.classList.remove('loading');
                    btn.disabled = false;
                }
                
            } catch (error) {
                console.error('Registration error:', error);
                showMessage(error.message.includes('Unexpected server response') ? 'Server error: invalid response format.' : 'Network error. Please check your connection and try again.', 'error');
                btn.classList.remove('loading');
                btn.disabled = false;
            }
        });

        // Auto-remove error class on input for better UX
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('error');
                const msgDiv = document.getElementById('formMessage');
                if (msgDiv) msgDiv.classList.remove('show');
            });
        });
    </script>
</body>
</html>