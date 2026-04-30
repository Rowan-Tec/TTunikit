<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vuexy</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            --success: #28a745;
            --error: #dc3545;
            --warning: #ffab00;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.1);
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
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.4);
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

        .date-of-birth-container {
            display: flex;
            gap: 10px;
            align-items: center;
            position: relative;
        }

        .date-select-wrapper {
            flex: 1;
            position: relative;
        }

        .date-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding-right: 30px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23696c6e'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 20px;
        }

        @media (max-width: 560px) {
            .date-of-birth-container {
                flex-direction: column;
                gap: 8px;
            }
            
            .date-select-wrapper {
                width: 100%;
            }
        }

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

        /* Hide input icons when typing or focused */
        .form-input:focus ~ .input-icon,
        .form-input:not(:placeholder-shown):not(:placeholder-shown) ~ .input-icon {
            opacity: 0;
            visibility: hidden;
        }

        .form-input:focus .input-icon,
        .form-input:not(:placeholder-shown):not(:placeholder-shown) .input-icon {
            opacity: 0;
            visibility: hidden;
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
        
        /* Helper text styling */
        .field-helper {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.75rem;
            color: #666;
            line-height: 1.4;
            font-style: italic;
        }
        
        .field-helper:before {
            content: '';
            margin-right: 0.25rem;
            color: #0066cc;
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
        
        /* Success popup styling */
        .success-popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .success-popup-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        
        .success-popup {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            max-width: 400px;
            width: 90%;
            text-align: center;
            transform: scale(0.8);
            transition: transform 0.3s ease;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        
        .success-popup-overlay.show .success-popup {
            transform: scale(1);
        }
        
        .success-animation {
            margin-bottom: 1.5rem;
        }
        
        .success-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #28a745, #20c997);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            animation: successPulse 2s infinite;
        }
        
        @keyframes successPulse {
            0% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
            }
            70% {
                box-shadow: 0 0 0 20px rgba(40, 167, 69, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
            }
        }
        
        .success-checkmark {
            color: white;
            font-size: 2rem;
            animation: checkmarkPop 0.6s ease-out;
        }
        
        @keyframes checkmarkPop {
            0% {
                transform: scale(0) rotate(-45deg);
            }
            50% {
                transform: scale(1.2) rotate(10deg);
            }
            100% {
                transform: scale(1) rotate(0deg);
            }
        }
        
        .success-content h3 {
            color: #28a745;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .success-content p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        
        .success-ok-btn {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .success-ok-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
        }
        
        .success-ok-btn:focus {
            outline: 3px solid #28a745;
            outline-offset: 2px;
        }

        /* Dark mode input field styling */
        [data-theme="dark"] .form-input {
            background: var(--bg-surface);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        [data-theme="dark"] .form-input:focus {
            border-color: var(--primary);
            background: var(--bg-surface);
        }

        [data-theme="dark"] .form-label {
            color: var(--text-primary);
        }

        [data-theme="dark"] .form-input::placeholder {
            color: var(--text-muted);
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

        /* Dark mode styling for date select dropdowns */
        [data-theme="dark"] .date-select {
            background: var(--bg-surface) !important;
            color: var(--text-primary) !important;
            border-color: var(--border-color) !important;
        }

        [data-theme="dark"] .date-select:focus {
            border-color: var(--primary) !important;
            background: var(--bg-surface) !important;
        }

        [data-theme="dark"] .date-select option {
            background: var(--bg-surface) !important;
            color: var(--text-primary) !important;
        }

        [data-theme="dark"] .date-select option:hover {
            background: var(--primary) !important;
            color: white !important;
        }

        [data-theme="dark"] .date-select option:checked {
            background: var(--primary) !important;
            color: white !important;
        }

        /* UNIVERSAL FIX: All select dropdowns MUST show selected values */
        select, .form-input, .date-select {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background: white !important;
            color: #000000 !important;
            border: 2px solid #333 !important;
            font-size: 16px !important;
            font-weight: 700 !important;
            padding: 8px 12px !important;
        }

        select:focus, .form-input:focus, .date-select:focus {
            outline: 2px solid var(--primary) !important;
            border-color: var(--primary) !important;
            box-shadow: 0 0 5px rgba(0, 102, 204, 0.3) !important;
        }

        select option, .form-input option, .date-select option {
            background: white !important;
            color: #000000 !important;
            padding: 8px 12px !important;
            font-weight: 700 !important;
        }

        select option:checked, .form-input option:checked, .date-select option:checked {
            background: var(--primary) !important;
            color: white !important;
            font-weight: 700 !important;
        }

        select option:hover, .form-input option:hover, .date-select option:hover {
            background: #f0f0f0 !important;
            color: white !important;
        }

        /* Dark mode universal select styling */
        [data-theme="dark"] select, [data-theme="dark"] .form-input, [data-theme="dark"] .date-select {
            background: #1a1a1a !important;
            color: #ffffff !important;
            border-color: #4a5568 !important;
        }

        [data-theme="dark"] select:focus, [data-theme="dark"] .form-input:focus, [data-theme="dark"] .date-select:focus {
            outline: 2px solid var(--primary) !important;
            border-color: var(--primary) !important;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.3) !important;
        }

        [data-theme="dark"] select option, [data-theme="dark"] .form-input option, [data-theme="dark"] .date-select option {
            background: #1a1a1a !important;
            color: #ffffff !important;
            padding: 8px 12px !important;
            font-weight: 700 !important;
        }

        [data-theme="dark"] select option:checked, [data-theme="dark"] .form-input option:checked, [data-theme="dark"] .date-select option:checked {
            background: var(--primary) !important;
            color: white !important;
            font-weight: 700 !important;
        }

        [data-theme="dark"] select option:hover, [data-theme="dark"] .form-input option:hover, [data-theme="dark"] .date-select option:hover {
            background: var(--primary) !important;
            color: white !important;
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
    </style>
</head>
<body>
    <div class="login-container">
        <main class="login-card">
            <div class="card-header">
                <img src="{{ asset('image.png') }}" 
                     alt="TIRELO CAPITAL Register" 
                     class="login-header-image">
                <p style="color: #000000; font-weight: 600;">Secure access to your admin panel & analytics</p>
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
                        <label class="form-label">Date of Birth</label>
                        <div class="date-of-birth-container">
                            <div class="date-select-wrapper">
                                <select name="day" id="day" class="form-input date-select" required>
                                    <option value="">Day</option>
                                    @for($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="date-select-wrapper">
                                <select name="month" id="month" class="form-input date-select" required>
                                    <option value="">Month</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="date-select-wrapper">
                                <select name="year" id="year" class="form-input date-select" required>
                                    <option value="">Year</option>
                                    @for($i = date('Y') - 13; $i >= date('Y') - 100; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <input type="hidden" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
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

                
                <div class="form-options">
                    <div class="checkbox-group">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">I agree to the <a href="#" style="color: var(--primary);">Terms of Service</a> and <a href="#" style="color: var(--primary);">Privacy Policy</a></label>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="btn-text">Create Account</span>
                    <span class="spinner"></span>
                </button>
                
                <div style="text-align: center;">
                    <a href="{{ route('home') }}" class="back-to-home">
                        <i class="fas fa-arrow-left"></i>
                        Back to Home
                    </a>
                </div>
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
                this.classList.add('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                showMessage('Please enter a valid cellphone number (min 8 digits)', 'error');
                setTimeout(() => {
                    const msg = document.getElementById('formMessage');
                    if (msg) msg.classList.remove('show');
                }, 3000);
            } else {
                this.classList.remove('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) wrapper.classList.remove('field-error');
            }
        });

        // Date of birth validation and combination
        function updateDateOfBirth() {
            const day = document.getElementById('day').value;
            const month = document.getElementById('month').value;
            const year = document.getElementById('year').value;
            const hiddenField = document.getElementById('date_of_birth');
            
            if (day && month && year) {
                const dateOfBirth = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
                hiddenField.value = dateOfBirth;
                
                // Validate age
                if (!isValidAge(dateOfBirth)) {
                    document.getElementById('day').classList.add('field-error');
                    document.getElementById('month').classList.add('field-error');
                    document.getElementById('year').classList.add('field-error');
                    showMessage('You must be at least 13 years old to register', 'error');
                    setTimeout(() => {
                        const msg = document.getElementById('formMessage');
                        if (msg) msg.classList.remove('show');
                    }, 3000);
                } else {
                    document.getElementById('day').classList.remove('field-error');
                    document.getElementById('month').classList.remove('field-error');
                    document.getElementById('year').classList.remove('field-error');
                }
            } else {
                hiddenField.value = '';
            }
        }

        // Add event listeners to date dropdowns
        document.getElementById('day')?.addEventListener('change', updateDateOfBirth);
        document.getElementById('month')?.addEventListener('change', updateDateOfBirth);
        document.getElementById('year')?.addEventListener('change', updateDateOfBirth);

        document.getElementById('email')?.addEventListener('blur', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.value && !emailRegex.test(this.value)) {
                this.classList.add('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
            } else {
                this.classList.remove('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) wrapper.classList.remove('field-error');
            }
        });
        
        // Add validation for required fields on blur
        document.getElementById('full_names')?.addEventListener('blur', function() {
            if (!this.value || this.value.trim() === '') {
                this.classList.add('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                // Show error message under field
                showFieldError(this, 'full_names', 'Full names are required');
            } else {
                this.classList.remove('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) wrapper.classList.remove('field-error');
                // Hide error message
                hideFieldError(this, 'full_names');
            }
        });
        
        document.getElementById('surname')?.addEventListener('blur', function() {
            if (!this.value || this.value.trim() === '') {
                this.classList.add('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                // Show error message under field
                showFieldError(this, 'surname', 'Surname is required');
            } else {
                this.classList.remove('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) wrapper.classList.remove('field-error');
                // Hide error message
                hideFieldError(this, 'surname');
            }
        });
        
        document.getElementById('gender')?.addEventListener('blur', function() {
            if (!this.value || this.value.trim() === '') {
                this.classList.add('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                // Show error message under field
                showFieldError(this, 'gender', 'Please select your gender');
            } else {
                this.classList.remove('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) wrapper.classList.remove('field-error');
                // Hide error message
                hideFieldError(this, 'gender');
            }
        });
        
        document.getElementById('password')?.addEventListener('blur', function() {
            if (!this.value || this.value.trim() === '') {
                this.classList.add('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                // Show error message under field
                showFieldError(this, 'password', 'Password is required');
            } else {
                this.classList.remove('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) wrapper.classList.remove('field-error');
                // Hide error message
                hideFieldError(this, 'password');
            }
        });
        
        document.getElementById('terms')?.addEventListener('blur', function() {
            if (!this.checked) {
                this.classList.add('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                // Show error message under field
                showFieldError(this, 'terms', 'You must agree to the terms');
            } else {
                this.classList.remove('field-error');
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) wrapper.classList.remove('field-error');
                // Hide error message
                hideFieldError(this, 'terms');
            }
        });

        // Main form submission with extended validation
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Gather all new fields
            const fullNames = document.getElementById('full_names')?.value.trim() || '';
            const surname = document.getElementById('surname')?.value.trim() || '';
            const email = document.getElementById('email')?.value.trim() || '';
            const cellphone = document.getElementById('cellphone')?.value.trim() || '';
            const gender = document.getElementById('gender')?.value || '';
            const dob = document.getElementById('dob')?.value || '';
            const password = document.getElementById('password').value;
            const terms = document.getElementById('terms').checked;

            // Validation checks - highlight specific fields
            let hasError = false;
            
            if (!fullNames) {
                const field = document.getElementById('full_names');
                field.classList.add('field-error');
                const wrapper = field.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                showFieldError(field, 'full_names', 'Full names are required');
                hasError = true;
            }
            
            if (!surname) {
                const field = document.getElementById('surname');
                field.classList.add('field-error');
                const wrapper = field.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                showFieldError(field, 'surname', 'Surname is required');
                hasError = true;
            }
            
            if (!email) {
                const field = document.getElementById('email');
                field.classList.add('field-error');
                const wrapper = field.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                showFieldError(field, 'email', 'Email address is required');
                hasError = true;
            }
            
            if (!cellphone) {
                const field = document.getElementById('cellphone');
                field.classList.add('field-error');
                const wrapper = field.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                showFieldError(field, 'cellphone', 'Cellphone number is required');
                hasError = true;
            } else if (!isValidCellphone(cellphone)) {
                const field = document.getElementById('cellphone');
                field.classList.add('field-error');
                const wrapper = field.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                showFieldError(field, 'cellphone', 'Please provide a valid cellphone number (at least 8 digits)');
                hasError = true;
            }
            
            if (!gender) {
                const field = document.getElementById('gender');
                field.classList.add('field-error');
                const wrapper = field.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                showFieldError(field, 'gender', 'Please select your gender');
                hasError = true;
            }
            
            // Validate date of birth
            const day = document.getElementById('day').value;
            const month = document.getElementById('month').value;
            const year = document.getElementById('year').value;
            
            if (!day || !month || !year) {
                document.getElementById('day').classList.add('field-error');
                document.getElementById('month').classList.add('field-error');
                document.getElementById('year').classList.add('field-error');
                showFieldError(document.getElementById('day'), 'date_of_birth', 'Please select your complete date of birth');
                hasError = true;
            } else {
                const dateOfBirth = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
                if (!isValidAge(dateOfBirth)) {
                    document.getElementById('day').classList.add('field-error');
                    document.getElementById('month').classList.add('field-error');
                    document.getElementById('year').classList.add('field-error');
                    showFieldError(document.getElementById('day'), 'date_of_birth', 'You must be at least 13 years old to register');
                    hasError = true;
                }
            }
            
            if (!password || password.length < 8) {
                const field = document.getElementById('password');
                field.classList.add('field-error');
                const wrapper = field.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                showFieldError(field, 'password', 'Password must be at least 8 characters');
                hasError = true;
            }
            
            if (!terms) {
                const field = document.getElementById('terms');
                field.classList.add('field-error');
                const wrapper = field.closest('.input-wrapper');
                if (wrapper) wrapper.classList.add('field-error');
                showFieldError(field, 'terms', 'You must agree to the terms and conditions');
                hasError = true;
            }
            
            // If there are any validation errors, stop submission
            if (hasError) {
                return;
            }
            
            // If we got here, all client-side validation passed
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
                    // Clear any existing field errors
                    clearFieldErrors();
                    
                    // Show creative success popup
                    showSuccessPopup();
                    
                } else {
                    if (data?.errors) {
                        // Highlight fields with errors
                        highlightFieldErrors(data.errors);
                        
                        // Show first error message
                        const firstError = Object.values(data.errors)[0][0];
                        showMessage(firstError, 'error');
                    } else if (data?.message) {
                        showMessage(data.message, 'error');
                    } else {
                        showMessage('Registration failed. Please check your details.', 'error');
                    }
                    btn.classList.remove('loading');
                }
                btn.disabled = false;
                
            } catch (error) {
                console.error('Registration error:', error);
                showMessage(error.message.includes('Unexpected server response') ? 'Server error: invalid response format.' : 'Network error. Please check your connection and try again.', 'error');
                btn.classList.remove('loading');
                btn.disabled = false;
            }
        });

        // Function to highlight fields with errors
        function highlightFieldErrors(errors) {
            // Clear previous errors
            clearFieldErrors();
            
            // Highlight each field with errors
            Object.keys(errors).forEach(fieldName => {
                const field = document.querySelector(`[name="${fieldName}"]`);
                if (field) {
                    field.classList.add('field-error');
                    const wrapper = field.closest('.input-wrapper');
                    if (wrapper) {
                        wrapper.classList.add('field-error');
                    }
                    // Show error message under field
                    const errorMessages = errors[fieldName];
                    if (errorMessages && errorMessages.length > 0) {
                        showFieldError(field, fieldName, errorMessages[0]);
                    }
                }
            });
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
        
        // Function to clear field errors
        function clearFieldErrors() {
            const errorFields = document.querySelectorAll('.field-error');
            errorFields.forEach(field => {
                field.classList.remove('field-error');
            });
        }
        
        // Function to show creative success popup
        function showSuccessPopup() {
            // Create popup element
            const popup = document.createElement('div');
            popup.className = 'success-popup-overlay';
            popup.innerHTML = `
                <div class="success-popup">
                    <div class="success-animation">
                        <div class="success-circle">
                            <div class="success-checkmark">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                    </div>
                    <div class="success-content">
                        <h3>Account Created Successfully! </h3>
                        <p>Your account has been created and a verification email has been sent to your email address. Please check your inbox to verify your account.</p>
                        <button onclick="handleSuccessOk()" class="success-ok-btn">OK</button>
                    </div>
                </div>
            `;
            
            // Add popup to page
            document.body.appendChild(popup);
            
            // Add animation
            setTimeout(() => {
                popup.classList.add('show');
            }, 100);
        }
        
        // Function to handle OK button click
        function handleSuccessOk() {
            // Remove popup
            const popup = document.querySelector('.success-popup-overlay');
            if (popup) {
                popup.classList.remove('show');
                setTimeout(() => {
                    popup.remove();
                    // Redirect to verification page
                    window.location.href = '{{ route("verification.verification.notice") }}';
                }, 300);
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