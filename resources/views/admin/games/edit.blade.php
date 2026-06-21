@extends('layouts.app')

@section('content')
<div class="bg-slate-950 py-12 min-h-screen">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.games.index') }}" class="text-amber-500 hover:text-amber-400 text-sm font-semibold transition flex items-center gap-1 mb-2">
                &larr; Back to Keepers Deck
            </a>
            <h1 class="text-3xl font-extrabold tracking-tight text-white font-display">Edit Game: {{ $game->name }}</h1>
            <p class="mt-1 text-sm text-slate-400">Modify details or store links for this game hub.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-8 shadow-xl">
            <form action="{{ route('admin.games.update', $game->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-300">Game Name</label>
                    <input type="text" name="name" id="name" required value="{{ old('name', $game->name) }}"
                           class="mt-1.5 block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 text-slate-100 placeholder-slate-500 focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm">
                    @error('name')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Genre -->
                    <div>
                        <label for="genre" class="block text-sm font-medium text-slate-300">Genre</label>
                        <input type="text" name="genre" id="genre" required value="{{ old('genre', $game->genre) }}" placeholder="e.g. Action RPG, Rogue-like"
                               class="mt-1.5 block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 text-slate-100 placeholder-slate-500 focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm">
                        @error('genre')
                            <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Developer -->
                    <div>
                        <label for="developer" class="block text-sm font-medium text-slate-300">Developer</label>
                        <input type="text" name="developer" id="developer" required value="{{ old('developer', $game->developer) }}" placeholder="e.g. FromSoftware"
                               class="mt-1.5 block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 text-slate-100 placeholder-slate-500 focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm">
                        @error('developer')
                            <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Release Date & Trailer -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="release_date" class="block text-sm font-medium text-slate-300">Release Date</label>
                        <input type="date" name="release_date" id="release_date" required value="{{ old('release_date', $game->release_date?->format('Y-m-d')) }}"
                               class="mt-1.5 block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 text-slate-100 focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm">
                        @error('release_date')
                            <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="trailer_url" class="block text-sm font-medium text-slate-300">YouTube Trailer URL</label>
                        <input type="url" name="trailer_url" id="trailer_url" value="{{ old('trailer_url', $game->trailer_url) }}" placeholder="https://www.youtube.com/watch?v=..."
                               class="mt-1.5 block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 text-slate-100 placeholder-slate-500 focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm">
                        @error('trailer_url')
                            <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Platforms (Checkboxes) -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Supported Platforms</label>
                    <div class="flex flex-wrap gap-4 bg-slate-950/60 p-4 rounded-xl border border-slate-800">
                        @foreach(['PC', 'PS5', 'Xbox', 'Mobile', 'Nintendo'] as $platform)
                            <label class="inline-flex items-center select-none cursor-pointer">
                                <input type="checkbox" name="platforms[]" value="{{ $platform }}"
                                       {{ is_array(old('platforms', $game->platforms)) && in_array($platform, old('platforms', $game->platforms)) ? 'checked' : '' }}
                                       class="h-4 w-4 rounded border-slate-800 bg-slate-950 text-amber-500 focus:ring-amber-500">
                                <span class="ml-2 text-sm text-slate-300 font-semibold">{{ $platform }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('platforms')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Images (Cover & Banner) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                    <div>
                        <label for="cover_image" class="block text-sm font-medium text-slate-300">Update Cover Art</label>
                        <input type="file" name="cover_image" id="cover_image" accept="image/*"
                               class="mt-1.5 block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-950 file:text-amber-500 hover:file:bg-slate-850 file:cursor-pointer">
                        @if($game->cover_image)
                            <div class="mt-2 flex items-center space-x-2">
                                <img src="{{ asset('storage/' . $game->cover_image) }}" class="h-12 w-9 rounded object-cover" alt="">
                                <span class="text-xs text-slate-500">Current Cover</span>
                            </div>
                        @endif
                        @error('cover_image')
                            <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="banner_image" class="block text-sm font-medium text-slate-300">Update Banner Background</label>
                        <input type="file" name="banner_image" id="banner_image" accept="image/*"
                               class="mt-1.5 block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-950 file:text-amber-500 hover:file:bg-slate-850 file:cursor-pointer">
                        @if($game->banner_image)
                            <div class="mt-2 flex items-center space-x-2">
                                <img src="{{ asset('storage/' . $game->banner_image) }}" class="h-10 w-20 rounded object-cover" alt="">
                                <span class="text-xs text-slate-500">Current Banner</span>
                            </div>
                        @endif
                        @error('banner_image')
                            <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Store storefront links -->
                <div class="border-t border-slate-800/80 pt-6">
                    <h3 class="text-lg font-bold text-white mb-4 font-display">Storefront Action Links (Optional)</h3>
                    <div class="space-y-4">
                        @foreach(['Steam', 'PlayStation', 'Xbox', 'Epic Games', 'Nintendo Switch'] as $index => $store)
                            @php
                                $existingLink = $game->links->firstWhere('store_name', $store);
                                $existingUrl = $existingLink ? $existingLink->url : '';
                            @endphp
                            <div class="flex flex-col sm:flex-row gap-4 items-center bg-slate-950/20 p-3 rounded-xl border border-slate-850">
                                <span class="w-32 text-sm font-semibold text-slate-300 text-left sm:text-right">{{ $store }}</span>
                                <input type="hidden" name="stores[{{ $index }}][name]" value="{{ $store }}">
                                <input type="url" name="stores[{{ $index }}][url]" placeholder="https://store.example.com/app/{{ strtolower($store) }}..."
                                       value="{{ old("stores.$index.url", $existingUrl) }}"
                                       class="block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-2.5 text-slate-100 placeholder-slate-650 focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Submit -->
                <div class="border-t border-slate-800/80 pt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.games.index') }}" class="px-6 py-3 rounded-xl border border-slate-800 bg-slate-950 text-slate-300 font-bold hover:bg-slate-900 transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 font-bold hover:from-amber-400 hover:to-amber-500 transition shadow-lg">
                        Update Game Hub
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
