<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status style="margin-bottom: 1rem; color: var(--color-success-600); font-weight: 500;" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div style="margin-bottom: 1.5rem;">
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-bottom: 0.5rem;">Welcome Back</h1>
            <p style="font-size: 0.875rem; color: var(--color-gray-500);">Enter your credentials to access your secure vault.</p>
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" style="margin-top: 0.5rem; color: var(--color-danger-500); font-size: 0.75rem;" />
        </div>

        <!-- Password -->
        <div class="form-group" style="margin-top: 1rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <label for="password" class="form-label" style="margin-bottom: 0;">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                    <a style="font-size: 0.75rem; font-weight: 600; color: var(--color-primary-600); text-decoration: none;" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>
            <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" style="margin-top: 0.5rem; color: var(--color-danger-500); font-size: 0.75rem;" />
        </div>

        <!-- Remember Me -->
        <div style="display: flex; align-items: center; margin-top: 1rem;">
            <input id="remember_me" type="checkbox" name="remember" style="width: 1rem; height: 1rem; border-radius: var(--radius-sm); border: 1px solid var(--color-gray-300);">
            <label for="remember_me" style="margin-left: 0.5rem; font-size: 0.875rem; color: var(--color-gray-600);">{{ __('Remember me') }}</label>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.75rem; font-size: 1rem;">
                {{ __('Secure Sign In') }}
            </button>
        </div>

        <div style="margin-top: 1.5rem; text-align: center;">
            <p style="font-size: 0.875rem; color: var(--color-gray-600);">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" style="font-weight: 700; color: var(--color-primary-600);">{{ __('Sign Up') }}</a>
            </p>
        </div>
    </form>
</x-guest-layout>
