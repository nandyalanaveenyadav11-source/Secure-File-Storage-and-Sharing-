<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SecureVault - File Storage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">
</head>
<body>
    <!-- Navigation -->
    <nav class="nav-header">
        <div class="container nav-container">
            <div class="nav-logo">
                <div class="nav-logo-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <span>SecureVault</span>
            </div>
            <div class="nav-links">
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary">Log in</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="hero-section">
        <div class="hero-pill">
            <span class="pulse-dot"></span>
            Military-Grade Protection
        </div>
        
        <h1 class="hero-title">
            Secure your files with <br><span class="text-gradient">unbreakable encryption</span>.
        </h1>
        
        <p class="hero-subtitle">
            Protect your sensitive data with AES-256 encryption vaulted behind RSA-2048 keys. Designed for seamless, ultra-fast, and secure file storage and sharing.
        </p>

        <div class="hero-actions">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn hero-btn hero-btn-primary">
                    Access Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="btn hero-btn hero-btn-primary">
                    Start for Free
                </a>
                <a href="#features" class="btn hero-btn hero-btn-secondary">
                    View Features
                </a>
            @endauth
        </div>
    </main>

    <!-- Features -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="features-grid">
                <!-- Feature 1 -->
                <div>
                    <div class="feature-icon-wrapper indigo">
                        <svg class="feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="feature-title">Hybrid Core</h3>
                    <p class="feature-desc">We encrypt your data with AES-256 and wrap the security key with your personal RSA certificate.</p>
                </div>
                <!-- Feature 2 -->
                <div>
                    <div class="feature-icon-wrapper blue">
                        <svg class="feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                    </div>
                    <h3 class="feature-title">Secure Sharing</h3>
                    <p class="feature-desc">Instantly and securely share your encrypted files with other users on the platform with a single click.</p>
                </div>
                <!-- Feature 3 -->
                <div>
                    <div class="feature-icon-wrapper purple">
                        <svg class="feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="feature-title">Security Visualizer</h3>
                    <p class="feature-desc">The integrated Encryption Inspector lets you witness the raw power of the encryption protecting your files.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="app-footer">
        <p>&copy; {{ date('Y') }} SecureVault. Designed for Excellence.</p>
    </footer>
</body>
</html>
