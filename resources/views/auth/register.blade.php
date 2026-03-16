<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div style="margin-bottom: 1.5rem;">
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-bottom: 0.5rem;">Create Account</h1>
            <p style="font-size: 0.875rem; color: var(--color-gray-500);">Join SecureVault to start protecting your sensitive data.</p>
        </div>

        <!-- Name -->
        <div class="form-group">
            <label for="name" class="form-label">{{ __('Full Name') }}</label>
            <input id="name" class="form-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" style="margin-top: 0.5rem; color: var(--color-danger-500); font-size: 0.75rem;" />
        </div>

        <!-- Email Address -->
        <div class="form-group" style="margin-top: 1rem;">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" style="margin-top: 0.5rem; color: var(--color-danger-500); font-size: 0.75rem;" />
        </div>

        <!-- Password -->
        <div class="form-group" style="margin-top: 1rem;">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" style="margin-top: 0.5rem; color: var(--color-danger-500); font-size: 0.75rem;" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group" style="margin-top: 1rem;">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" style="margin-top: 0.5rem; color: var(--color-danger-500); font-size: 0.75rem;" />
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.75rem; font-size: 1rem;">
                {{ __('Create Secure Account') }}
            </button>
        </div>

        <div style="margin-top: 1.5rem; text-align: center;">
            <p style="font-size: 0.875rem; color: var(--color-gray-600);">
                {{ __('Already registered?') }}
                <a href="{{ route('login') }}" style="font-weight: 700; color: var(--color-primary-600);">{{ __('Sign In') }}</a>
            </p>
        </div>
    </form>
</x-guest-layout>
