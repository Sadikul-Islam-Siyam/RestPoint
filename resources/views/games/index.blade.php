@extends('layouts.app')

@section('content')
<div class="bg-slate-950 py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-10">
            <div class="min-w-0 flex-1">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl font-display">
                    Game Library
                </h2>
                <p class="mt-2 text-sm text-slate-400">
                    Find your game hub to share walkthroughs, ask for boss strategies, and review builds.
                </p>
            </div>
            @auth
                @if(auth()->user()->isAdmin())
                    <div class="mt-4 flex md:ml-4 md:mt-0">
                        <a href="{{ route('admin.games.create') }}" class="inline-flex items-center rounded-xl bg-amber-500 px-4 py-2.5 text-sm font-semibold text-slate-950 shadow-md hover:bg-amber-400 transition">
                            ➕ Add New Game
                        </a>
                    </div>
                @endif
            @endauth
        </div>

        <!-- Games Grid -->
        <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
            @forelse($games as $game)
                <div class="group relative flex flex-col overflow-hidden rounded-2xl border border-slate-900 bg-slate-900/40 hover:border-slate-800 transition duration-300">
                    <!-- Banner or Cover Art -->
                    <div class="aspect-w-3 aspect-h-4 bg-slate-850 sm:aspect-none sm:h-56 relative overflow-hidden">
                        @if($game->cover_image)
                            <img src="{{ asset('storage/' . $game->cover_image) }}" class="h-full w-full object-cover object-center group-hover:scale-105 transition duration-500" alt="{{ $game->name }} cover">
                        @else
                            <div class="h-full w-full bg-gradient-to-br from-slate-900 to-slate-950 flex items-center justify-center border-b border-slate-900 relative">
                                <span class="text-slate-700 text-6xl select-none">🎮</span>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3 bg-slate-950/80 backdrop-blur-md px-2.5 py-1 rounded-md text-xs font-semibold text-amber-500 border border-slate-800">
                            {{ $game->genre }}
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="flex flex-1 flex-col p-6">
                        <h3 class="text-xl font-bold text-white group-hover:text-amber-500 transition duration-200">
                            <a href="{{ route('games.show', $game->slug) }}">
                                <span class="absolute inset-0"></span>
                                {{ $game->name }}
                            </a>
                        </h3>
                        <p class="text-xs text-slate-500 mt-1">Developed by {{ $game->developer }}</p>

                        <!-- Platform badges -->
                        <div class="mt-4 flex flex-wrap gap-1.5">
                            @if(is_array($game->platforms))
                                @foreach($game->platforms as $platform)
                                    <span class="rounded bg-slate-800/80 px-2 py-0.5 text-[10px] font-medium text-slate-300 border border-slate-700/30">
                                        {{ $platform }}
                                    </span>
                                @endforeach
                            @endif
                        </div>

                        <!-- Stats -->
                        <div class="mt-6 flex items-center justify-between border-t border-slate-900 pt-4 text-xs text-slate-500">
                            <span>Released {{ $game->release_date?->format('M Y') }}</span>
                            <span class="flex items-center gap-1 font-semibold text-slate-400">
                                👥 {{ $game->followers_count }} members
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-slate-900/10 border border-dashed border-slate-900 rounded-2xl">
                    <span class="text-4xl">📭</span>
                    <h3 class="mt-4 text-lg font-bold text-white">No games in library yet</h3>
                    <p class="mt-2 text-sm text-slate-500">Check back later or ask an administrator to add games.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
