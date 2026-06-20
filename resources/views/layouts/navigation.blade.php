<!-- Desktop Left Sidebar -->
<aside class="hidden md:flex flex-col w-64 h-screen sticky top-0 bg-white/60 dark:bg-slate-950/50 border-r border-white/10 dark:border-slate-800/40 backdrop-blur-xl p-6 justify-between z-40">
    <div class="space-y-8">
        <!-- Logo / Brand -->
        <div class="flex items-center space-x-3 px-2">
            <x-application-logo class="block h-10 w-auto fill-current text-indigo-600 dark:text-indigo-400" />
            <span class="text-xl font-extrabold tracking-tight text-gray-900 dark:text-white text-glow">
                {{ config('app.name', 'BlogCMS') }}
            </span>
        </div>

        <!-- Vertical Navigation Links -->
        <nav class="space-y-1.5">
            <!-- Dashboard Link -->
            <a href="{{ route('dashboard') }}" 
               class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition duration-150 {{ request()->routeIs('dashboard') ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-450' : 'text-gray-500 dark:text-gray-400 hover:bg-slate-500/5 hover:text-gray-900 dark:hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                {{ __('Dashboard') }}
            </a>

            <!-- All Posts Link -->
            @can('viewAny', App\Models\Post::class)
                <a href="{{ route('posts.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition duration-150 {{ request()->routeIs('posts.index') ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-450' : 'text-gray-500 dark:text-gray-400 hover:bg-slate-500/5 hover:text-gray-900 dark:hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 012 2v8a2 2 0 01-2 2h-3m-6 0a1 1 0 001-1V7a1 1 0 00-1-1h-3a1 1 0 00-1 1v12a1 1 0 001 1h3z"/>
                    </svg>
                    {{ __('Posts') }}
                </a>
            @endcan

            <!-- Create Post Link
            @can('create', App\Models\Post::class)
                <a href="{{ route('posts.create') }}" 
                   class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition duration-150 {{ request()->routeIs('posts.create') ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-450' : 'text-gray-500 dark:text-gray-400 hover:bg-slate-500/5 hover:text-gray-900 dark:hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ __('Create Post') }}
                </a>
            @endcan -->
        </nav>
    </div>

    <!-- User Profile Dropdown / Log Out -->
    <div class="border-t border-white/10 dark:border-slate-800/40 pt-4 space-y-4">
        <div class="px-3 flex items-center space-x-3">
            <div class="min-w-0 flex-1">
                <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <div class="space-y-1">
            <a href="{{ route('profile.edit') }}" class="flex items-center px-3 py-2 text-sm font-bold text-gray-500 dark:text-gray-400 hover:bg-slate-500/10 rounded-xl transition duration-150">
                <svg class="w-4 h-4 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                {{ __('Profile') }}
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-3 py-2 text-sm font-bold text-red-650 hover:bg-red-500/10 rounded-xl transition duration-150">
                    <svg class="w-4 h-4 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Mobile Navigation Header -->
<header x-data="{ open: false }" class="md:hidden glass-nav sticky top-0 z-50 flex flex-col">
    <div class="flex justify-between items-center h-16 px-4">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
            <x-application-logo class="block h-8 w-auto fill-current text-indigo-650 dark:text-indigo-400" />
            <span class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{ config('app.name', 'BlogCMS') }}</span>
        </a>

        <!-- Hamburger Menu -->
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:bg-slate-500/10 transition duration-150">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu Drawer -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-white/10 dark:border-slate-800/40 bg-white/95 dark:bg-slate-950/95 backdrop-blur-xl py-3 px-4 space-y-4">
        <div class="space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @can('viewAny', App\Models\Post::class)
                <x-responsive-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                    {{ __('All Posts') }}
                </x-responsive-nav-link>
            @endcan
            @can('create', App\Models\Post::class)
                <x-responsive-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')">
                    {{ __('Create Post') }}
                </x-responsive-nav-link>
            @endcan
        </div>

        <div class="border-t border-slate-500/10 pt-3">
            <div class="font-bold text-sm text-gray-800 dark:text-gray-255">{{ Auth::user()->name }}</div>
            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
            <div class="mt-2 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-500">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</header>
