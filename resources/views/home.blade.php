<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Vuexy · Intelligent User Hub</title>
    <meta name="description" content="Modern user management platform with analytics, roles & secure authentication">
    <!-- Font Awesome 6 & clean typography -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Light mode (refined palette) */
            --primary: #0066cc;
            --primary-dark: #0052a3;
            --primary-light: #eef5ff;
            --primary-glow: rgba(0, 102, 204, 0.12);
            --text-primary: #0a1c2f;
            --text-secondary: #2c3e50;
            --text-muted: #5a6e85;
            --bg-surface: #ffffff;
            --bg-subtle: #f8fafd;
            --bg-elevated: #ffffff;
            --border-color: #eef2f8;
            --border-focus: #cbddea;
            --card-bg: #ffffff;
            --shadow-sm: 0 5px 12px rgba(0, 0, 0, 0.03), 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.06), 0 2px 4px rgba(0, 0, 0, 0.02);
            --shadow-lg: 0 25px 35px -12px rgba(0, 102, 204, 0.18);
            --radius-card: 1.5rem;
            --radius-element: 1rem;
            --transition-smooth: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        [data-theme="dark"] {
            --primary: #4d9eff;
            --primary-dark: #3b82f6;
            --primary-light: #1a2c3e;
            --primary-glow: rgba(77, 158, 255, 0.2);
            --text-primary: #f0f3f8;
            --text-secondary: #cddbe9;
            --text-muted: #96a7bc;
            --bg-surface: #0f1217;
            --bg-subtle: #181e26;
            --bg-elevated: #1a212b;
            --border-color: #2a323e;
            --border-focus: #3a4453;
            --card-bg: #181f28;
            --shadow-sm: 0 5px 12px rgba(0, 0, 0, 0.4);
            --shadow-md: 0 10px 28px rgba(0, 0, 0, 0.5);
            --shadow-lg: 0 20px 35px -10px rgba(0, 0, 0, 0.6);
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
            background: var(--bg-surface);
            color: var(--text-primary);
            line-height: 1.5;
            transition: background 0.25s ease, color 0.2s ease;
            min-height: 100vh;
            padding: 0;
            margin: 0;
            position: relative;
        }

        /* top bar refined (fixed social bar) */
        .top-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: var(--bg-elevated);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            padding: 0.9rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-smooth);
        }

        .logo-group {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .logo-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            color: white;
            box-shadow: 0 6px 12px -6px rgba(0,102,204,0.3);
        }

        .brand-name {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--text-primary) 40%, var(--primary) 80%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: -0.3px;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-nav {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 1.3rem;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
            text-decoration: none;
            background: var(--primary);
            color: white;
            box-shadow: 0 2px 6px rgba(0, 102, 204, 0.2);
            border: none;
            cursor: pointer;
        }

        .btn-nav-outline {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
            box-shadow: none;
        }

        .btn-nav-outline:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        .btn-nav:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* theme toggle pill (fixed in top-bar) */
        .theme-toggle {
            background: var(--bg-subtle);
            border: 1px solid var(--border-color);
            border-radius: 2.5rem;
            padding: 0.45rem 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.8rem;
            transition: var(--transition-smooth);
            color: var(--text-secondary);
            margin-left: 0.5rem;
        }

        .theme-toggle:hover {
            border-color: var(--primary);
            background: var(--bg-elevated);
            transform: scale(0.97);
        }

        .theme-toggle i {
            font-size: 0.9rem;
            color: var(--primary);
        }

        /* illustration section */
        .illustrations-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 1.8rem;
            margin-top: 6rem;
            margin-bottom: 2rem;
            padding: 1rem 2rem;
        }

        .illustration-card {
            flex: 1;
            min-width: 180px;
            display: flex;
            justify-content: center;
            transition: transform 0.2s;
        }

        .illustration-img {
            width: 220px;
            height: auto;
            filter: drop-shadow(0 8px 20px rgba(0,0,0,0.08));
            transition: all 0.2s;
            border-radius: 12px;
        }

        .dark-theme-img {
            display: none;
        }

        [data-theme="dark"] .light-theme-img {
            display: none;
        }

        [data-theme="dark"] .dark-theme-img {
            display: block;
        }

        /* hero section e-commerce style */
        .hero-section {
            display: flex;
            align-items: center;
            gap: 3rem;
            margin: 4rem 0;
            padding: 2rem;
            background: var(--bg-surface);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-md);
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .hero-text {
            text-align: left;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--text-primary) 30%, var(--primary) 70%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: -0.5px;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .hero-description {
            font-size: 1rem;
            color: var(--text-secondary);
            line-height: 1.7;
            margin-bottom: 2rem;
            max-width: 500px;
        }

        .hero-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .hero-feature {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            background: var(--bg-subtle);
            border-radius: var(--radius-element);
            transition: var(--transition-smooth);
        }

        .hero-feature:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        .hero-feature i {
            font-size: 1.25rem;
            color: var(--primary);
            width: 24px;
            text-align: center;
        }

        .hero-feature span {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.9rem;
        }

        .hero-image {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-img {
            width: 280px;
            height: auto;
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-lg);
            transition: var(--transition-smooth);
        }

        .dark-theme-img {
            display: none;
        }

        [data-theme="dark"] .light-theme-img {
            display: none;
        }

        [data-theme="dark"] .dark-theme-img {
            display: block;
        }

        /* product showcase section */
        .product-showcase {
            margin: 3rem 0;
            padding: 2rem;
            background: var(--bg-surface);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-md);
        }

        .showcase-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            text-align: center;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, var(--primary) 30%, var(--primary-dark) 70%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            display: inline-block;
            padding: 0.5rem 2rem;
            border-radius: 40px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-card);
            padding: 1.5rem;
            text-align: center;
            transition: var(--transition-smooth);
            box-shadow: var(--shadow-sm);
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary);
        }

        .product-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: var(--radius-element);
            margin-bottom: 1rem;
            animation: float 3s ease-in-out infinite;
            transition: transform 0.3s ease;
        }

        .product-img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 102, 204, 0.15);
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
            background: var(--primary-light);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            display: inline-block;
        }

        /* main content */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem 3rem;
            text-align: center;
        }

        .header {
            margin-bottom: 2rem;
        }

        .subtitle {
            font-size: 1rem;
            font-weight: 500;
            color: var(--primary);
            background: var(--primary-light);
            display: inline-block;
            padding: 0.3rem 1.2rem;
            border-radius: 40px;
            letter-spacing: 0.2px;
        }

        .main-title {
            font-size: 2.6rem;
            font-weight: 800;
            margin: 0.75rem 0 0.5rem;
            background: linear-gradient(135deg, var(--text-primary) 30%, var(--primary) 70%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2.5rem;
        }

        .feature {
            background: var(--card-bg);
            border-radius: var(--radius-card);
            padding: 2rem 1.5rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: var(--transition-smooth);
            box-shadow: var(--shadow-sm);
        }

        .feature:hover {
            border-color: var(--primary);
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary);
            background: var(--primary-light);
            width: 70px;
            height: 70px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 28px;
            margin-bottom: 1.2rem;
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .feature-description {
            color: var(--text-muted);
            font-size: 0.92rem;
            line-height: 1.5;
        }

        @media (max-width: 860px) {
            .top-bar {
                padding: 0.7rem 1.2rem;
                flex-wrap: wrap;
                gap: 0.8rem;
            }
            .illustrations-section {
                margin-top: 7rem;
            }
            .illustration-img {
                width: 160px;
            }
        }

        @media (max-width: 640px) {
            .action-buttons {
                order: 2;
                width: 100%;
                justify-content: center;
            }
            .theme-toggle {
                margin-left: 0;
            }
            .top-bar {
                justify-content: center;
                flex-direction: column;
                align-items: center;
                gap: 0.6rem;
            }
            .illustration-img {
                width: 130px;
            }
            .main-title {
                font-size: 1.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Fixed top bar with clean toggle + sign in/register -->
    <div class="top-bar">
        <div class="logo-group">
            <div class="logo-icon">VX</div>
            <span class="brand-name">Vuexy</span>
        </div>
        <div class="action-buttons">
            <a href="#" id="signinNavBtn" class="btn-nav">
                <i class="fas fa-sign-in-alt"></i> Sign In
            </a>
            <a href="#" id="registerNavBtn" class="btn-nav btn-nav-outline">
                <i class="fas fa-user-plus"></i> Register
            </a>
            <div class="theme-toggle" id="globalThemeToggle">
                <i id="theme-icon" class="fas fa-moon"></i>
                <span id="theme-text">Dark Mode</span>
            </div>
        </div>
    </div>

    
    <!-- Main content block -->
    <div class="container">
        <div class="header">
            <span class="subtitle">next‑gen user management</span>
            <h1 class="main-title">Welcome to Vuexy</h1>
            <p style="color: var(--text-secondary); max-width: 520px; margin: 0.8rem auto 0;">Simple, powerful, and secure platform for modern teams.</p>
        </div>
        <!-- Hero section with product image only -->
    <div class="hero-section">
        <div class="hero-content">
            <div class="hero-image">
                <img src="{{ asset('assets/img/ecommerce-images/product-1.png') }}" 
                     alt="Product Light Theme" 
                     class="hero-img light-theme-img">
                <img src="{{ asset('assets/img/ecommerce-images/product-10.png') }}" 
                     alt="Product Dark Theme" 
                     class="hero-img dark-theme-img">
            </div>
        </div>
    </div>

    <!-- Product showcase section -->
    <div class="product-showcase">
        <h2 class="showcase-title">All Products</h2>
        <div class="product-grid">
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-1.png') }}" 
                     alt="Product 1" 
                     class="product-img">
                <h3 class="product-name">Product 1</h3>
                <p class="product-price">R19.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-2.png') }}" 
                     alt="Product 2" 
                     class="product-img">
                <h3 class="product-name">Product 2</h3>
                <p class="product-price">R29.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-3.png') }}" 
                     alt="Product 3" 
                     class="product-img">
                <h3 class="product-name">Product 3</h3>
                <p class="product-price">R39.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-4.png') }}" 
                     alt="Product 4" 
                     class="product-img">
                <h3 class="product-name">Product 4</h3>
                <p class="product-price">R49.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-5.png') }}" 
                     alt="Product 5" 
                     class="product-img">
                <h3 class="product-name">Product 5</h3>
                <p class="product-price">R59.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-6.png') }}" 
                     alt="Product 6" 
                     class="product-img">
                <h3 class="product-name">Product 6</h3>
                <p class="product-price">R69.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-7.png') }}" 
                     alt="Product 7" 
                     class="product-img">
                <h3 class="product-name">Product 7</h3>
                <p class="product-price">R79.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-8.png') }}" 
                     alt="Product 8" 
                     class="product-img">
                <h3 class="product-name">Product 8</h3>
                <p class="product-price">R89.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-9.png') }}" 
                     alt="Product 9" 
                     class="product-img">
                <h3 class="product-name">Product 9</h3>
                <p class="product-price">R99.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-11.png') }}" 
                     alt="Product 11" 
                     class="product-img">
                <h3 class="product-name">Product 11</h3>
                <p class="product-price">R109.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-12.png') }}" 
                     alt="Product 12" 
                     class="product-img">
                <h3 class="product-name">Product 12</h3>
                <p class="product-price">R119.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-13.png') }}" 
                     alt="Product 13" 
                     class="product-img">
                <h3 class="product-name">Product 13</h3>
                <p class="product-price">R129.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-14.png') }}" 
                     alt="Product 14" 
                     class="product-img">
                <h3 class="product-name">Product 14</h3>
                <p class="product-price">R139.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-15.png') }}" 
                     alt="Product 15" 
                     class="product-img">
                <h3 class="product-name">Product 15</h3>
                <p class="product-price">R149.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-16.png') }}" 
                     alt="Product 16" 
                     class="product-img">
                <h3 class="product-name">Product 16</h3>
                <p class="product-price">R159.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-17.png') }}" 
                     alt="Product 17" 
                     class="product-img">
                <h3 class="product-name">Product 17</h3>
                <p class="product-price">R169.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-18.png') }}" 
                     alt="Product 18" 
                     class="product-img">
                <h3 class="product-name">Product 18</h3>
                <p class="product-price">R179.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-19.png') }}" 
                     alt="Product 19" 
                     class="product-img">
                <h3 class="product-name">Product 19</h3>
                <p class="product-price">R189.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-20.png') }}" 
                     alt="Product 20" 
                     class="product-img">
                <h3 class="product-name">Product 20</h3>
                <p class="product-price">R199.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-21.png') }}" 
                     alt="Product 21" 
                     class="product-img">
                <h3 class="product-name">Product 21</h3>
                <p class="product-price">R209.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-22.png') }}" 
                     alt="Product 22" 
                     class="product-img">
                <h3 class="product-name">Product 22</h3>
                <p class="product-price">R219.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-23.png') }}" 
                     alt="Product 23" 
                     class="product-img">
                <h3 class="product-name">Product 23</h3>
                <p class="product-price">R229.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-24.png') }}" 
                     alt="Product 24" 
                     class="product-img">
                <h3 class="product-name">Product 24</h3>
                <p class="product-price">R239.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-25.png') }}" 
                     alt="Product 25" 
                     class="product-img">
                <h3 class="product-name">Product 25</h3>
                <p class="product-price">R249.99</p>
            </div>
            <div class="product-card">
                <img src="{{ asset('assets/img/ecommerce-images/product-26.png') }}" 
                     alt="Product 26" 
                     class="product-img">
                <h3 class="product-name">Product 26</h3>
                <p class="product-price">$259.99</p>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Vuexy. Built with modern technology for modern teams.</p>
            <div class="footer-links">
                <a href="#" style="color: var(--text-muted); text-decoration: none; margin: 0 1rem;">Privacy</a>
                <a href="#" style="color: var(--text-muted); text-decoration: none; margin: 0 1rem;">Terms</a>
                <a href="#" style="color: var(--text-muted); text-decoration: none;">Support</a>
            </div>
        </div>
    </footer>
    </div>

    <script>
        // FIXED TOGGLE ONLY — THEME SYSTEM FULLY RESPONSIVE, PERSISTENT, AND INTEGRATED
        (function() {
            // Key for localStorage
            const THEME_STORAGE_KEY = 'vuexy_theme_pref';
            
            // Helper: get current theme from data attribute
            function getCurrentTheme() {
                const attr = document.documentElement.getAttribute('data-theme');
                return attr === 'dark' ? 'dark' : 'light';
            }
            
            // Core: set theme and update UI elements
            function setTheme(theme) {
                if (theme !== 'dark' && theme !== 'light') theme = 'light';
                const root = document.documentElement;
                root.setAttribute('data-theme', theme);
                localStorage.setItem(THEME_STORAGE_KEY, theme);
                
                // Update toggle button icon + text
                const iconElem = document.getElementById('theme-icon');
                const textElem = document.getElementById('theme-text');
                if (iconElem && textElem) {
                    if (theme === 'dark') {
                        iconElem.className = 'fas fa-sun';
                        textElem.textContent = 'Light Mode';
                    } else {
                        iconElem.className = 'fas fa-moon';
                        textElem.textContent = 'Dark Mode';
                    }
                }
                
                // Optional: dispatch custom event so any other component can sync
                window.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme } }));
            }
            
            // Toggle handler
            function toggleThemeHandler() {
                const current = getCurrentTheme();
                const newTheme = current === 'dark' ? 'light' : 'dark';
                setTheme(newTheme);
            }
            
            // Initial load: detect saved preference or system theme, then apply
            function initTheme() {
                let savedTheme = localStorage.getItem(THEME_STORAGE_KEY);
                if (!savedTheme) {
                    // fallback to system preference
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    savedTheme = prefersDark ? 'dark' : 'light';
                }
                setTheme(savedTheme);
            }
            
            // Listen to system changes only if user never manually selected (optional: but respect stored)
            // We'll add listener but not override user choice via system unless they have no saved pref.
            // But anyway we'll keep it non-intrusive: only follow system when localStorage empty: already done.
            // Additional improvement: when system changes & there's no explicit user choice, we can auto adapt,
            // however modern UX keeps user preference. Here we sync only if user never set.
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                const userSelected = localStorage.getItem(THEME_STORAGE_KEY);
                if (!userSelected) {
                    // no explicit user pref, follow OS
                    const newSystemTheme = e.matches ? 'dark' : 'light';
                    setTheme(newSystemTheme);
                }
            });
            
            // Ensure toggle button is attached after DOM ready
            document.addEventListener('DOMContentLoaded', () => {
                initTheme();
                const toggleBtn = document.getElementById('globalThemeToggle');
                if (toggleBtn) {
                    // remove any previous listener to avoid duplicates (but safe)
                    toggleBtn.removeEventListener('click', toggleThemeHandler);
                    toggleBtn.addEventListener('click', toggleThemeHandler);
                }
                
                // Also handle navigation buttons for demo (keep routes as before but we keep them partial placeholder)
                const signinBtn = document.getElementById('signinNavBtn');
                const registerBtn = document.getElementById('registerNavBtn');
                
                function getRoute(name) {
                    // Simulate laravel route names for integration; in pure static demo we use safety
                    // but keep the same structure as original. For backend environment, correct route will be applied.
                    // We'll just store theme before redirect.
                    if (name === 'login') return '/login';
                    if (name === 'register') return '/register';
                    return '#';
                }
                
                function storeThemeBeforeRedirect() {
                    const currentTheme = getCurrentTheme();
                    sessionStorage.setItem('theme', currentTheme);
                    document.cookie = `theme_preference=${currentTheme}; path=/; max-age=${60*60*24*7}; SameSite=Lax`;
                }
                
                function handleNav(page) {
                    const url = page === 'login' ? getRoute('login') : getRoute('register');
                    if (url && url !== '#') {
                        storeThemeBeforeRedirect();
                        window.location.href = url;
                    } else {
                        // graceful demo notification
                        const toast = document.createElement('div');
                        toast.innerText = `✨ ${page === 'login' ? 'Sign In' : 'Register'} — integrate with Laravel auth routes for full flow.`;
                        toast.style.position = 'fixed';
                        toast.style.bottom = '24px';
                        toast.style.left = '50%';
                        toast.style.transform = 'translateX(-50%)';
                        toast.style.background = 'var(--primary)';
                        toast.style.color = 'white';
                        toast.style.padding = '0.7rem 1.4rem';
                        toast.style.borderRadius = '40px';
                        toast.style.fontWeight = '500';
                        toast.style.fontSize = '0.85rem';
                        toast.style.zIndex = '10000';
                        toast.style.backdropFilter = 'blur(8px)';
                        toast.style.boxShadow = '0 8px 18px rgba(0,0,0,0.2)';
                        document.body.appendChild(toast);
                        setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.remove(), 350); }, 2000);
                        storeThemeBeforeRedirect();
                    }
                }
                
                if (signinBtn) {
                    signinBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        handleNav('login');
                    });
                }
                if (registerBtn) {
                    registerBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        handleNav('register');
                    });
                }
            });
            
            // Also attach an extra safety for dynamic content reload to keep UI consistent
            window.addEventListener('load', () => {
                // Ensure any leftover inline conflict resolved
                const currentAttr = document.documentElement.getAttribute('data-theme');
                if (!currentAttr) initTheme();
            });
        })();
    </script>
</body>
</html>