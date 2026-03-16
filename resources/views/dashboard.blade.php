<x-app-layout>
<x-slot name="header">
    <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--color-gray-800);">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div style="padding-top: 3rem; padding-bottom: 3rem;">
    <div class="container">
        <div style="display: grid; gap: 1.5rem; @media (min-width: 768px) { grid-template-columns: repeat(2, 1fr); }">
            <!-- Welcome Stat -->
            <div class="card">
                <div class="card-body">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="width: 3rem; height: 3rem; background-color: var(--color-primary-100); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; color: var(--color-primary-600);">
                            <svg style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <div>
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--color-gray-900);">Security Status: Active</h3>
                            <p style="font-size: 0.875rem; color: var(--color-gray-500);">Encryption engine is running</p>
                        </div>
                    </div>
                    <p style="color: var(--color-gray-600); margin-bottom: 1.5rem;">Welcome back, {{ Auth::user()->name }}! Your files are protected with military-grade hybrid AES-256 and RSA encryption.</p>
                    <a href="{{ route('files.index') }}" class="btn btn-primary" style="display: inline-flex; width: auto;">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1m-6 9a3 3 0 100-6 3 3 0 000 6z"></path></svg>
                        Manage Secure Vault
                    </a>
                </div>
            </div>

            <!-- Quick Info -->
            <div class="card" style="background-color: var(--color-primary-600); color: var(--color-white); position: relative; overflow: hidden;">
                <div class="card-body" style="height: 100%; display: flex; flex-direction: column;">
                    <div style="position: absolute; top: 0; right: 0; padding: 2rem; opacity: 0.1;">
                        <svg style="width: 6rem; height: 6rem;" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    </div>
                    <h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.5rem; position: relative; z-index: 10;">Hybrid Encryption System</h3>
                    <p style="color: rgba(255, 255, 255, 0.8); font-size: 0.875rem; margin-bottom: 1rem; position: relative; z-index: 10;">Each file is uniquely encrypted with a symmetric AES-256 key, which is then wrapped in an RSA-2048 public key for maximum security.</p>
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-top: auto; position: relative; z-index: 10;">
                        <div style="background-color: rgba(255, 255, 255, 0.1); border-radius: var(--radius-md); padding: 0.75rem;">
                            <div style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.8;">RSA Bits</div>
                            <div style="font-size: 1.5rem; font-weight: 700;">2048</div>
                        </div>
                        <div style="background-color: rgba(255, 255, 255, 0.1); border-radius: var(--radius-md); padding: 0.75rem;">
                            <div style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.8;">AES Mode</div>
                            <div style="font-size: 1.5rem; font-weight: 700;">CBC</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* CSS specific to dashboard layout, since media queries are hard inline */
@media (min-width: 768px) {
    .container > div {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}
</style>
</x-app-layout>
