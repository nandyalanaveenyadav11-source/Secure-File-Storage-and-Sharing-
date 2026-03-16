<nav x-data="{ open: false }" class="nav-header">
    <div class="container nav-container">
        <div class="nav-logo">
            <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none; color: inherit;">
                <div class="nav-logo-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <span>SecureVault</span>
            </a>
        </div>

        <!-- Desktop Links -->
        <div class="nav-links" style="display: none; @media (min-width: 640px) { display: flex; align-items: center; }">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                {{ __('Overview') }}
            </a>
            <a href="{{ route('files.index') }}" class="nav-link {{ request()->routeIs('files.*') ? 'active' : '' }}">
                {{ __('My Vault') }}
            </a>
            <a href="{{ route('shared-files.index') }}" class="nav-link {{ request()->routeIs('shared-files.*') ? 'active' : '' }}">
                {{ __('Shared With Me') }}
            </a>
            
            <!-- Settings Dropdown -->
            <div style="position: relative; margin-left: 1.5rem;" x-data="{ dropdownOpen: false }" @click.away="dropdownOpen = false">
                <button @click="dropdownOpen = !dropdownOpen" style="display: flex; items-center: center; gap: 0.25rem; background: none; border: none; font-size: 0.875rem; font-weight: 500; color: var(--color-gray-600); cursor: pointer;">
                    {{ Auth::user()->name }}
                    <svg style="width: 1rem; height: 1rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="dropdownOpen" style="display: none; position: absolute; right: 0; top: 100%; margin-top: 0.5rem; width: 12rem; background: white; border-radius: var(--radius-md); box-shadow: var(--shadow-md); border: 1px solid var(--color-gray-100); z-index: 50;"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95">
                    
                    <a href="{{ route('profile.edit') }}" style="display: block; padding: 0.5rem 1rem; font-size: 0.875rem; color: var(--color-gray-700); text-decoration: none;">
                        {{ __('Profile') }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" style="display: block; padding: 0.5rem 1rem; font-size: 0.875rem; color: var(--color-gray-700); text-decoration: none;">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Hamburger (Mobile) -->
        <div style="display: flex; align-items: center; @media (min-width: 640px) { display: none; }">
            <button @click="open = !open" style="background: none; border: none; padding: 0.5rem; color: var(--color-gray-500); cursor: pointer;">
                <svg style="width: 1.5rem; height: 1.5rem;" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" style="display: none;" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" style="display: none; border-top: 1px solid var(--color-gray-200); background: var(--color-white);">
        <div style="padding: 0.5rem 0;">
            <a href="{{ route('dashboard') }}" style="display: block; padding: 0.5rem 1rem; font-size: 1rem; font-weight: 500; color: {{ request()->routeIs('dashboard') ? 'var(--color-primary-600)' : 'var(--color-gray-600)' }}; background: {{ request()->routeIs('dashboard') ? 'var(--color-primary-50)' : 'transparent' }}; border-left: 4px solid {{ request()->routeIs('dashboard') ? 'var(--color-primary-600)' : 'transparent' }};">
                {{ __('Overview') }}
            </a>
            <a href="{{ route('files.index') }}" style="display: block; padding: 0.5rem 1rem; font-size: 1rem; font-weight: 500; color: {{ request()->routeIs('files.*') ? 'var(--color-primary-600)' : 'var(--color-gray-600)' }}; background: {{ request()->routeIs('files.*') ? 'var(--color-primary-50)' : 'transparent' }}; border-left: 4px solid {{ request()->routeIs('files.*') ? 'var(--color-primary-600)' : 'transparent' }};">
                {{ __('My Vault') }}
            </a>
            <a href="{{ route('shared-files.index') }}" style="display: block; padding: 0.5rem 1rem; font-size: 1rem; font-weight: 500; color: {{ request()->routeIs('shared-files.*') ? 'var(--color-primary-600)' : 'var(--color-gray-600)' }}; background: {{ request()->routeIs('shared-files.*') ? 'var(--color-primary-50)' : 'transparent' }}; border-left: 4px solid {{ request()->routeIs('shared-files.*') ? 'var(--color-primary-600)' : 'transparent' }};">
                {{ __('Shared With Me') }}
            </a>
        </div>
        
        <div style="padding: 1rem; border-top: 1px solid var(--color-gray-200);">
            <div style="font-weight: 500; color: var(--color-gray-800);">{{ Auth::user()->name }}</div>
            <div style="font-size: 0.875rem; color: var(--color-gray-500);">{{ Auth::user()->email }}</div>
            
            <div style="margin-top: 1rem;">
                <a href="{{ route('profile.edit') }}" style="display: block; padding: 0.5rem 0; color: var(--color-gray-600);">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" style="display: block; padding: 0.5rem 0; color: var(--color-gray-600);">
                        Log Out
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Add media queries that can't be inlined easily for the nav */
    @media (min-width: 640px) {
        .nav-links { display: flex !important; align-items: center; }
        .nav-header > .container > div:last-of-type { display: none !important; }
    }
</style>
