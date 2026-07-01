<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight text-glow">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-panel rounded-2xl overflow-hidden shadow-2xl">
                <div class="p-6 md:p-8 space-y-6">
                    <div class="border-b border-white/10 dark:border-slate-800/40 pb-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('Edit Post Details') }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Modify your article and update its publish status when permitted.') }}</p>
                    </div>

                    <form method="POST" action="{{ route('posts.update', $post) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="space-y-2">
                            <label for="title" class="block text-sm font-bold text-gray-700 dark:text-gray-300">
                                {{ __('Title') }}
                            </label>
                            <input type="text" name="title" id="title" required value="{{ old('title', $post->title) }}" 
                                class="w-full px-4 py-2.5 glass-input focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition duration-150 @error('title') border-red-500/50 @enderror"
                                placeholder="Enter article title">
                            @error('title')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Body -->
                        <div class="space-y-2">
                            <label for="body" class="block text-sm font-bold text-gray-700 dark:text-gray-300">
                                {{ __('Body Content') }}
                            </label>
                            <textarea name="body" id="body" rows="10" required 
                                class="w-full px-4 py-2.5 glass-input focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition duration-150 @error('body') border-red-500/50 @enderror"
                                placeholder="Write your article content here...">{{ old('body', $post->body) }}</textarea>
                            @error('body')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        @php
                            $canPublish = false;
                            try {
                                $canPublish = auth()->user()->hasPermissionTo('publish-post');
                            } catch (\Throwable $e) {
                                $canPublish = false;
                            }
                        @endphp

                        @if ($canPublish)
                            <!-- Publish Status -->
                            <div class="space-y-2">
                                <label for="published" class="block text-sm font-bold text-gray-700 dark:text-gray-300">
                                    {{ __('Publish Status') }}
                                </label>
                                <select name="published" id="published"
                                    class="w-full px-4 py-2.5 glass-input focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition duration-150 @error('published') border-red-500/50 @enderror">
                                    <option value="0" @selected((string) old('published', (int) $post->published) === '0')>{{ __('Draft') }}</option>
                                    <option value="1" @selected((string) old('published', (int) $post->published) === '1')>{{ __('Published') }}</option>
                                </select>
                                @error('published')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @else
                            <div class="space-y-2">
                                <span class="block text-sm font-bold text-gray-700 dark:text-gray-300">
                                    {{ __('Publish Status') }}
                                </span>
                                <div class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold {{ $post->published ? 'bg-green-500/10 text-green-700 dark:text-green-300' : 'bg-amber-500/10 text-amber-700 dark:text-amber-300' }}">
                                    {{ $post->published ? __('Published') : __('Draft') }}
                                </div>
                            </div>
                        @endif

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-white/10 dark:border-slate-800/40">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2.5 bg-slate-500/10 hover:bg-slate-500/20 text-gray-750 dark:text-gray-250 text-sm font-bold rounded-xl transition duration-150">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2.5 bg-indigo-650 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition duration-150">
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
