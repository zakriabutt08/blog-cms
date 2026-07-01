<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            @if(auth()->user()->hasRole('Admin'))
                <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight text-glow">
                    {{ __('Admin Dashboard') }}
                </h2>
                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/25 transition duration-150 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ __('Create New Post') }}
                </a>
            @elseif(auth()->user()->hasRole('Author'))
                <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight text-glow">
                    {{ __('Author Dashboard') }}
                </h2>
                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2.5 bg-purple-600 hover:bg-purple-700 dark:bg-purple-500 dark:hover:bg-purple-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-purple-500/25 transition duration-150 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ __('Create New Post') }}
                </a>
            @else
                <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight text-glow">
                    {{ __('Article Feed') }}
                </h2>
            @endif
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Session Status Notification -->
            @if (session('success'))
                <div class="flex items-center p-4 mb-4 text-sm text-green-900 border border-green-200/50 bg-green-50/50 dark:text-green-400 dark:bg-green-950/20 dark:border-green-900/30 rounded-2xl backdrop-blur-md shadow-lg" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ml-3 font-semibold">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(auth()->user()->hasRole('Admin'))
                <!-- ADMIN CONTENT -->
                <!-- Metric Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="glass-card p-6 rounded-2xl flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Total Posts') }}</p>
                            <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $totalPosts }}</h3>
                        </div>
                        <div class="p-3 bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-xl">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 012 2v8a2 2 0 01-2 2h-3m-6 0a1 1 0 001-1V7a1 1 0 00-1-1h-3a1 1 0 00-1 1v12a1 1 0 001 1h3z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="glass-card p-6 rounded-2xl flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Published') }}</p>
                            <h3 class="text-3xl font-extrabold text-green-600 dark:text-green-400 mt-2">{{ $publishedPosts }}</h3>
                        </div>
                        <div class="p-3 bg-green-500/10 text-green-600 dark:text-green-400 rounded-xl">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="glass-card p-6 rounded-2xl flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Drafts') }}</p>
                            <h3 class="text-3xl font-extrabold text-amber-500 dark:text-amber-400 mt-2">{{ $unpublishedPosts }}</h3>
                        </div>
                        <div class="p-3 bg-amber-500/10 text-amber-600 dark:text-amber-400 rounded-xl">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="glass-card p-6 rounded-2xl flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Total Users') }}</p>
                            <h3 class="text-3xl font-extrabold text-indigo-600 dark:text-indigo-400 mt-2">{{ $totalUsers }}</h3>
                        </div>
                        <div class="p-3 bg-purple-500/10 text-purple-650 dark:text-purple-400 rounded-xl">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Table: Manage Blog Posts -->
                <div class="glass-panel rounded-2xl overflow-hidden">
                    <div class="px-6 py-5 border-b border-white/10 dark:border-slate-800/40 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('Post Management') }}</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-500/5 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    <th class="px-6 py-4">{{ __('Title') }}</th>
                                    <th class="px-6 py-4">{{ __('Author') }}</th>
                                    <th class="px-6 py-4">{{ __('Status') }}</th>
                                    <th class="px-6 py-4">{{ __('Created At') }}</th>
                                    <th class="px-6 py-4 text-right">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5 dark:divide-slate-800/30">
                                @forelse ($posts as $post)
                                    <tr class="hover:bg-indigo-500/5 dark:hover:bg-indigo-400/5 transition duration-150">
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">
                                            <a href="{{ route('posts.show', $post) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                                {{ $post->title }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $post->user->name ?? 'Unknown' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($post->published)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-500/10 text-green-700 dark:text-green-400">
                                                    {{ __('Published') }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-500/10 text-amber-700 dark:text-amber-400">
                                                    {{ __('Draft') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $post->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm font-medium space-x-2 flex justify-end items-center">
                                            <form method="POST" action="{{ route('posts.update', $post) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="toggle_publish" value="1">
                                                @if ($post->published)
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-gray-500/10 hover:bg-gray-500/20 text-gray-700 dark:text-gray-300 text-xs font-bold rounded-lg transition duration-150">
                                                        {{ __('Unpublish') }}
                                                    </button>
                                                @else
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 text-white text-xs font-bold rounded-lg shadow-md shadow-green-500/15 transition duration-150">
                                                        {{ __('Publish') }}
                                                    </button>
                                                @endif
                                            </form>

                                            <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-lg shadow-md shadow-indigo-500/15 transition duration-150">
                                                {{ __('Edit') }}
                                            </a>

                                            <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-655 hover:bg-red-700 text-white text-xs font-bold rounded-lg shadow-md shadow-red-500/15 transition duration-150">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                                            {{ __('No posts found in the system.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Table: User Directory -->
                <div class="glass-panel rounded-2xl overflow-hidden">
                    <div class="px-6 py-5 border-b border-white/10 dark:border-slate-800/40">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('User & Role Directory') }}</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-500/5 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    <th class="px-6 py-4">{{ __('Name') }}</th>
                                    <th class="px-6 py-4">{{ __('Email') }}</th>
                                    <th class="px-6 py-4">{{ __('Roles') }}</th>
                                    <th class="px-6 py-4">{{ __('Registered At') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5 dark:divide-slate-800/30">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-indigo-500/5 dark:hover:bg-indigo-400/5 transition duration-150">
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            @foreach ($user->roles as $role)
                                                @if ($role->name === 'Admin')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-500/10 text-rose-700 dark:text-rose-400">
                                                        {{ $role->name }}
                                                    </span>
                                                @elseif ($role->name === 'Author')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-purple-500/10 text-purple-750 dark:text-purple-400">
                                                        {{ $role->name }}
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-500/10 text-slate-700 dark:text-slate-400">
                                                        {{ $role->name }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $user->created_at->format('M d, Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            @elseif(auth()->user()->hasRole('Author'))
                <!-- AUTHOR CONTENT -->
                <!-- Metric Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="glass-card p-6 rounded-2xl flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('My Total Posts') }}</p>
                            <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $totalPosts }}</h3>
                        </div>
                        <div class="p-3 bg-purple-500/10 text-purple-650 dark:text-purple-450 rounded-xl">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 012 2v8a2 2 0 01-2 2h-3m-6 0a1 1 0 001-1V7a1 1 0 00-1-1h-3a1 1 0 00-1 1v12a1 1 0 001 1h3z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="glass-card p-6 rounded-2xl flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('My Published') }}</p>
                            <h3 class="text-3xl font-extrabold text-green-600 dark:text-green-400 mt-2">{{ $publishedPosts }}</h3>
                        </div>
                        <div class="p-3 bg-green-500/10 text-green-600 dark:text-green-400 rounded-xl">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="glass-card p-6 rounded-2xl flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('My Drafts') }}</p>
                            <h3 class="text-3xl font-extrabold text-amber-500 dark:text-amber-400 mt-2">{{ $unpublishedPosts }}</h3>
                        </div>
                        <div class="p-3 bg-amber-500/10 text-amber-600 dark:text-amber-400 rounded-xl">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Table: Manage Blog Posts -->
                <div class="glass-panel rounded-2xl overflow-hidden">
                    <div class="px-6 py-5 border-b border-white/10 dark:border-slate-800/40">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('My Posts') }}</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-500/5 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    <th class="px-6 py-4">{{ __('Title') }}</th>
                                    <th class="px-6 py-4">{{ __('Status') }}</th>
                                    <th class="px-6 py-4">{{ __('Created At') }}</th>
                                    <th class="px-6 py-4 text-right">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5 dark:divide-slate-800/30">
                                @forelse ($posts as $post)
                                    <tr class="hover:bg-purple-500/5 dark:hover:bg-purple-400/5 transition duration-150">
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">
                                            <a href="{{ route('posts.show', $post) }}" class="hover:text-purple-600 dark:hover:text-purple-400 transition">
                                                {{ $post->title }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($post->published)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-500/10 text-green-700 dark:text-green-400">
                                                    {{ __('Published') }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-500/10 text-amber-700 dark:text-amber-400">
                                                    {{ __('Draft (Awaiting Review)') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $post->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm font-medium space-x-2 flex justify-end">
                                            <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-lg shadow-md shadow-indigo-500/15 transition duration-150">
                                                {{ __('Edit') }}
                                            </a>

                                            <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-655 hover:bg-red-700 text-white text-xs font-bold rounded-lg shadow-md shadow-red-500/15 transition duration-150">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                                            {{ __('You have not created any posts yet.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            @else
                <!-- READER CONTENT -->
                <div class="text-center max-w-xl mx-auto space-y-3">
                    <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                        {{ __('Discover Stories') }}
                    </h1>
                    <p class="text-lg text-gray-500 dark:text-gray-400">
                        {{ __('Read original viewpoints and insights from our team of authors.') }}
                    </p>
                </div>

                <!-- Posts Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse ($posts as $post)
                        <article class="glass-card rounded-2xl overflow-hidden flex flex-col justify-between hover:shadow-2xl hover:shadow-indigo-500/10 hover:border-indigo-500/30 transition duration-300 transform hover:-translate-y-1">
                            <div class="p-6 space-y-4">
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-500/10 text-indigo-700 dark:text-indigo-400">
                                        {{ __('Author: ') }}{{ $post->user->name ?? 'Unknown' }}
                                    </span>
                                </div>
                                
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white line-clamp-2">
                                    <a href="{{ route('posts.show', $post) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-3 leading-relaxed">
                                    {{ Str::limit($post->body, 140, '...') }}
                                </p>
                            </div>

                            <div class="px-6 py-4 bg-slate-500/5 border-t border-white/10 dark:border-slate-800/20 flex justify-between items-center mt-auto">
                                <span class="text-xs text-gray-400">
                                    {{ $post->created_at->format('M d, Y') }}
                                </span>
                                <a href="{{ route('posts.show', $post) }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 flex items-center transition">
                                    {{ __('Read More') }}
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full glass-panel rounded-2xl p-12 text-center">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 012 2v8a2 2 0 01-2 2h-3m-6 0a1 1 0 001-1V7a1 1 0 00-1-1h-3a1 1 0 00-1 1v12a1 1 0 001 1h3z"/>
                            </svg>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('No articles published yet') }}</h3>
                            <p class="text-gray-500 dark:text-gray-400 mt-2">{{ __('Please check back later for new updates.') }}</p>
                        </div>
                    @endforelse
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
