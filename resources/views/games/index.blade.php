@extends('layouts.app')

@section('content')
<div class="py-12 min-h-screen">
    <div class="mx-auto max-w-5xl px-8">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-12 border-b border-slate-900 pb-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-3xl font-extrabold tracking-wider text-white sm:text-4xl font-display uppercase fire-text-glow">
                    Game Library
                </h2>
                <p class="mt-2 text-sm text-slate-400 font-light">
                    Locate your game hub to draft walkthroughs, request boss strategy tips, or share equipment setups.
                </p>
            </div>
            @auth
                @if(auth()->user()->isAdmin())
                    <div class="mt-4 flex md:ml-4 md:mt-0">
                        <a href="{{ route('admin.games.create') }}" class="inline-flex items-center rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-slate-950 shadow-md hover:from-amber-400 hover:to-amber-500 transition font-display fire-glow">
                            ➕ Add Game
                        </a>
                    </div>
                @endif
            @endauth
        </div>

        <!-- Games Grid -->
        <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
            @forelse($games as $game)
                <div class="group relative flex flex-col overflow-hidden rounded-2xl restpoint-glass transition duration-300">
                    <!-- Cover Art -->
                    <div class="aspect-w-3 aspect-h-4 bg-slate-950 sm:aspect-none sm:h-52 relative overflow-hidden">
                        @if($game->cover_image)
                            <img src="{{ asset('storage/' . $game->cover_image) }}" class="h-full w-full object-cover object-center group-hover:scale-105 transition duration-500" alt="{{ $game->name }} cover">
                        @else
                            <div class="h-full w-full bg-gradient-to-br from-slate-950 to-slate-900 flex items-center justify-center border-b border-slate-900/60 relative">
                                <span class="text-slate-800 text-5xl select-none group-hover:animate-pulse transition">🎮</span>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3 bg-slate-950/90 border border-amber-500/10 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider text-amber-400 font-display">
                            {{ $game->genre }}
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="flex flex-1 flex-col p-5">
                        <h3 class="text-lg font-bold text-white group-hover:text-amber-400 transition duration-200 font-display uppercase tracking-wide">
                            <a href="{{ route('games.show', $game->slug) }}">
                                <span class="absolute inset-0"></span>
                                {{ $game->name }}
                            </a>
                        </h3>
                        <p class="text-[11px] text-slate-500 mt-1 font-light">By {{ $game->developer }}</p>

                        <!-- Platform badges -->
                        <div class="mt-4 flex flex-wrap gap-1.5">
                            @if(is_array($game->platforms))
                                @foreach($game->platforms as $platform)
                                    <span class="rounded bg-slate-950/80 px-2 py-0.5 text-[9px] font-bold uppercase text-slate-400 border border-slate-900/80 tracking-wider">
                                        {{ $platform }}
                                    </span>
                                @endforeach
                            @endif
                        </div>

                        <!-- Stats -->
                        <div class="mt-6 flex items-center justify-between border-t border-slate-950 pt-4 text-[11px] text-slate-500 font-light">
                            <span>{{ $game->release_date?->format('M Y') }}</span>
                            <span class="flex items-center gap-1 font-semibold text-amber-500/80">
                                👥 {{ $game->followers_count }} members
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center restpoint-glass rounded-2xl border-dashed">
                    <span class="text-4xl">📭</span>
                    <h3 class="mt-4 text-base font-bold text-slate-300 font-display uppercase">Tavern board is clear</h3>
                    <p class="mt-2 text-xs text-slate-500">Check back later or ask an administrator to add games.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
