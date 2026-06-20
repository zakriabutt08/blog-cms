<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight text-glow">
                {{ __('All Blog Posts') }}
            </h2>
            @can('create', App\Models\Post::class)
                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/25 transition transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ __('Create New Post') }}
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($posts as $post)
                    <div class="glass-card rounded-2xl overflow-hidden flex flex-col justify-between hover:shadow-2xl hover:shadow-indigo-500/10 hover:border-indigo-500/30 transition duration-300 transform hover:-translate-y-1">
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-400">
                                    {{ $post->created_at->format('M d, Y') }}
                                </span>
                                @if ($post->published)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-500/10 text-green-700 dark:text-green-400">
                                        {{ __('Published') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-500/10 text-amber-700 dark:text-amber-400">
                                        {{ __('Draft') }}
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-lg font-bold text-gray-900 dark:text-white line-clamp-2">
                                <a href="{{ route('posts.show', $post) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                    {{ $post->title }}
                                </a>
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-3 leading-relaxed">
                                {{ Str::limit($post->body, 120, '...') }}
                            </p>
                        </div>

                        <div class="px-6 py-4 bg-slate-500/5 border-t border-white/10 dark:border-slate-800/25 flex justify-between items-center mt-auto">
                            <span class="text-xs text-gray-500 dark:text-gray-450 font-bold">
                                {{ __('By: ') }}{{ $post->user->name ?? 'Unknown' }}
                            </span>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('posts.show', $post) }}" class="text-xs font-bold text-indigo-650 dark:text-indigo-400 hover:underline">
                                    {{ __('View') }}
                                </a>
                                @can('update', $post)
                                    <a href="{{ route('posts.edit', $post) }}" class="text-xs font-bold text-blue-600 dark:text-blue-400 hover:underline">
                                        {{ __('Edit') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full glass-panel rounded-2xl p-12 text-center">
                        <p class="text-gray-500 dark:text-gray-400 font-medium">{{ __('No posts found.') }}</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
