<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SecureVault - File Storage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased selection:bg-indigo-500 selection:text-white">
    <!-- Navigation -->
    <nav class="container mx-auto px-6 py-6 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <span class="text-xl font-bold tracking-tight text-gray-900">SecureVault</span>
        </div>
        <div class="flex items-center gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Log in</a>
                <a href="{{ route('register') }}" class="text-sm font-medium bg-indigo-600 text-white px-5 py-2.5 rounded-full hover:bg-indigo-700 transition shadow-sm">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="container mx-auto px-6 pt-20 pb-24 text-center max-w-4xl">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 text-sm font-medium mb-8 border border-indigo-100">
            <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
            Military-Grade Protection
        </div>
        
        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-gray-900 mb-8 leading-tight">
            Secure your files with <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">unbreakable encryption</span>.
        </h1>
        
        <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
            Protect your sensitive data with AES-256 encryption vaulted behind RSA-2048 keys. Designed for seamless, ultra-fast, and secure file storage.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 text-white font-semibold rounded-full hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                    Access Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 text-white font-semibold rounded-full hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                    Start for Free
                </a>
                <a href="#features" class="w-full sm:w-auto px-8 py-4 bg-white text-gray-700 font-semibold rounded-full hover:bg-gray-50 border border-gray-200 transition shadow-sm">
                    View Features
                </a>
            @endauth
        </div>
    </main>

    <!-- Features -->
    <section id="features" class="bg-white border-t border-gray-100 py-24">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="grid md:grid-cols-3 gap-12">
                <!-- Feature 1 -->
                <div>
                    <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Hybrid Core</h3>
                    <p class="text-gray-600 leading-relaxed">We encrypt your data with AES-256 and wrap the security key with your personal RSA certificate.</p>
                </div>
                <!-- Feature 2 -->
                <div>
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Fast Processing</h3>
                    <p class="text-gray-600 leading-relaxed">Powerful on-the-fly encryption ensures your files are processed in milliseconds without delay.</p>
                </div>
                <!-- Feature 3 -->
                <div>
                    <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Security Visualizer</h3>
                    <p class="text-gray-600 leading-relaxed">The integrated Encryption Inspector lets you witness the raw power of the encryption protecting your files.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-10 border-t border-gray-100 bg-gray-50 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} SecureVault. Designed for Excellence.</p>
    </footer>
</body>
</html>
