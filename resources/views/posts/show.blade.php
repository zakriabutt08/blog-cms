<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight text-glow">
                {{ __('View Post') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2.5 bg-slate-500/10 hover:bg-slate-500/20 text-gray-750 dark:text-gray-250 text-sm font-bold rounded-xl transition duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                {{ __('Back to Dashboard') }}
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <article class="glass-panel rounded-2xl overflow-hidden shadow-2xl">
                <!-- Header Section -->
                <div class="p-6 md:p-10 border-b border-white/10 dark:border-slate-800/40 space-y-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <!-- Author Badge -->
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-500/10 text-indigo-700 dark:text-indigo-400">
                            {{ __('Author: ') }}{{ $post->user->name ?? 'Unknown' }}
                        </span>
                        
                        <!-- Status Badge -->
                        @if ($post->published)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-500/10 text-green-700 dark:text-green-400">
                                {{ __('Published') }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 text-amber-700 dark:text-amber-400">
                                {{ __('Draft') }}
                            </span>
                        @endif

                        <!-- Time Badge -->
                        <span class="text-xs text-gray-400 dark:text-gray-500">
                            {{ __('Posted on') }} {{ $post->created_at->format('F d, Y \a\t h:i A') }}
                        </span>
                    </div>

                    <!-- Article Title -->
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white leading-tight">
                        {{ $post->title }}
                    </h1>
                </div>

                <!-- Content Body Section -->
                <div class="p-6 md:p-10 text-gray-700 dark:text-gray-300 leading-relaxed text-lg whitespace-pre-line">
                    {{ $post->body }}
                </div>

                <!-- Footer Actions Section (Conditional) -->
                @if(auth()->user()->can('update', $post) || auth()->user()->can('delete', $post))
                    <div class="px-6 md:px-10 py-5 bg-slate-500/5 border-t border-white/10 dark:border-slate-800/40 flex justify-end space-x-3">
                        @can('update', $post)
                            <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/15 transition duration-155">
                                {{ __('Edit Post') }}
                            </a>
                        @endcan

                        @can('delete', $post)
                            <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Are you sure you want to delete this post?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-650 hover:bg-red-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-red-500/15 transition duration-155">
                                    {{ __('Delete Post') }}
                                </button>
                            </form>
                        @endcan
                    </div>
                @endif
            </article>
        </div>
    </div>
</x-app-layout>
