<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Welcome Stat -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Security Status: Active</h3>
                        <p class="text-sm text-gray-500">Encryption engine is running</p>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Welcome back, {{ Auth::user()->name }}! Your files are protected with military-grade hybrid AES-256 and RSA encryption.</p>
                <a href="{{ route('files.index') }}" class="inline-flex items-center px-4 py-2 hover:bg-indigo-700 text-white rounded-lg font-semibold text-sm transition shadow-lg shadow-indigo-200 dark:shadow-none" style="background-color: #4f46e5; color: white !important;">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1m-6 9a3 3 0 100-6 3 3 0 000 6z"></path></svg>
                    Manage Secure Vault
                </a>
            </div>

            <!-- Quick Info -->
            <div class="overflow-hidden shadow-sm sm:rounded-xl p-6 text-white relative" style="background-color: #4f46e5; color: white !important;">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Hybrid Encryption System</h3>
                <p class="text-indigo-100/80 text-sm mb-4">Each file is uniquely encrypted with a symmetric AES-256 key, which is then wrapped in an RSA-2048 public key for maximum security.</p>
                <div class="grid grid-cols-2 gap-4 mt-auto">
                    <div class="bg-white/10 rounded-lg p-3">
                        <div class="text-xs uppercase tracking-widest opacity-60">RSA Bits</div>
                        <div class="text-2xl font-bold">2048</div>
                    </div>
                    <div class="bg-white/10 rounded-lg p-3">
                        <div class="text-xs uppercase tracking-widest opacity-60">AES Mode</div>
                        <div class="text-2xl font-bold">CBC</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
