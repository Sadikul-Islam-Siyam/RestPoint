@extends('layouts.app')

@section('content')
<div class="bg-slate-950 min-h-screen">
    <!-- Game Banner/Header -->
    <div class="relative h-64 md:h-96 w-full overflow-hidden bg-slate-900 border-b border-slate-900">
        @if($game->banner_image)
            <img src="{{ asset('storage/' . $game->banner_image) }}" class="h-full w-full object-cover opacity-60" alt="{{ $game->name }} banner">
        @else
            <div class="h-full w-full bg-gradient-to-r from-amber-950/20 via-slate-950 to-slate-900 opacity-80 flex items-center justify-center">
                <span class="text-slate-800 text-9xl font-extrabold tracking-widest font-display select-none opacity-10">{{ $game->name }}</span>
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent"></div>
    </div>

    <!-- Main Content -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 -mt-24 md:-mt-32 relative z-10 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Sidebar (Game Details & Actions) -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Cover Card -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl relative overflow-hidden">
                    <div class="aspect-w-3 aspect-h-4 bg-slate-950 rounded-xl overflow-hidden mb-6">
                        @if($game->cover_image)
                            <img src="{{ asset('storage/' . $game->cover_image) }}" class="h-full w-full object-cover" alt="{{ $game->name }} cover">
                        @else
                            <div class="h-full w-full flex items-center justify-center bg-slate-950 text-slate-800 text-5xl">🎮</div>
                        @endif
                    </div>

                    <h1 class="text-3xl font-extrabold text-white mb-2 font-display">{{ $game->name }}</h1>
                    <span class="inline-flex items-center rounded-md bg-amber-500/10 px-2 py-1 text-xs font-semibold text-amber-400 ring-1 ring-inset ring-amber-500/20 mb-4">
                        {{ $game->genre }}
                    </span>

                    <div class="space-y-3 text-sm text-slate-400 border-t border-slate-800/80 pt-4">
                        <div class="flex justify-between">
                            <span>Developer</span>
                            <span class="text-slate-200 font-medium">{{ $game->developer }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Released</span>
                            <span class="text-slate-200 font-medium">{{ $game->release_date?->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Followers</span>
                            <span class="text-slate-200 font-semibold">{{ $game->followers->count() }} members</span>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col gap-2">
                        @auth
                            <button class="w-full py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold shadow transition flex items-center justify-center gap-2">
                                🔔 Follow Game
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="w-full py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold transition text-center block">
                                Log in to Follow
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Purchase Links -->
                @if($game->links->count() > 0)
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl">
                        <h3 class="text-lg font-bold text-white mb-4 font-display flex items-center gap-2">
                            <span>🔗</span> Storefront Links
                        </h3>
                        <div class="space-y-3">
                            @foreach($game->links as $link)
                                <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-3 rounded-xl border border-slate-800 bg-slate-950/60 hover:bg-slate-800 hover:border-slate-700 transition">
                                    <span class="text-sm font-semibold text-slate-300">{{ $link->store_name }}</span>
                                    <span class="text-xs text-amber-500 font-medium hover:underline">Get Game &rarr;</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Game Dashboard Area (Trailer, Categories & Feed) -->
            <div class="lg:col-span-8 space-y-8">
                <!-- YouTube Trailer -->
                @if($game->trailer_url)
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl p-1">
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe src="{{ $game->trailer_url }}" title="{{ $game->name }} Official Trailer" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="w-full h-[360px] md:h-[420px] rounded-xl"></iframe>
                        </div>
                    </div>
                @endif

                <!-- Pre-seeded categories header -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-white font-display">Tavern Floor Categories</h3>
                        @auth
                            <a href="#" class="inline-flex items-center rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 px-4 py-2.5 text-sm font-bold text-slate-950 shadow-md hover:from-amber-400 hover:to-amber-500 transition">
                                📝 Write Post
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center rounded-xl bg-slate-800 px-4 py-2.5 text-sm font-semibold text-slate-400 hover:text-slate-200 transition">
                                Log in to Post
                            </a>
                        @endauth
                    </div>

                    <!-- Category List -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <button class="bg-amber-500 text-slate-950 font-semibold px-4 py-2 rounded-xl text-sm transition">
                            All Posts
                        </button>
                        @foreach($game->categories as $category)
                            <button class="bg-slate-950 text-slate-300 hover:bg-slate-850 border border-slate-800 px-4 py-2 rounded-xl text-sm transition">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>

                    <!-- Mock Post Feed for Phase 1 -->
                    <div class="border-t border-slate-800 pt-6">
                        <div class="py-12 text-center text-slate-500 bg-slate-950/20 border border-slate-850 rounded-xl border-dashed">
                            <span class="text-4xl">📜</span>
                            <h4 class="mt-4 text-base font-bold text-slate-300">Tavern board is clear</h4>
                            <p class="mt-2 text-xs text-slate-500">We will deploy the posting engine in Phase 2 next week.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
