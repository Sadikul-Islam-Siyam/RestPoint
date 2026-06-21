@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <!-- Game Banner/Header (Smoky opacity backdrop) -->
    <div class="relative h-56 md:h-72 w-full overflow-hidden bg-slate-900 border-b border-slate-900">
        @if($game->banner_image)
            <img src="{{ asset('storage/' . $game->banner_image) }}" class="h-full w-full object-cover opacity-40" alt="{{ $game->name }} banner">
        @else
            <div class="h-full w-full bg-gradient-to-r from-amber-950/10 via-slate-950 to-slate-900 opacity-60 flex items-center justify-center">
                <span class="text-slate-800 text-7xl font-extrabold tracking-widest font-display select-none opacity-5">{{ $game->name }}</span>
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent"></div>
    </div>

    <!-- Main Content Grid -->
    <div class="mx-auto max-w-5xl px-8 -mt-20 md:-mt-28 relative z-10 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Sidebar Details (Left col) -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Cover Card -->
                <div class="restpoint-glass rounded-2xl p-5 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-amber-500/0 via-amber-500/15 to-amber-500/0"></div>
                    <div class="aspect-w-3 aspect-h-4 bg-slate-950 rounded-xl overflow-hidden mb-5 border border-slate-900">
                        @if($game->cover_image)
                            <img src="{{ asset('storage/' . $game->cover_image) }}" class="h-full w-full object-cover" alt="{{ $game->name }} cover">
                        @else
                            <div class="h-full w-full flex items-center justify-center bg-slate-950 text-slate-800 text-4xl">🎮</div>
                        @endif
                    </div>

                    <h1 class="text-2xl font-extrabold text-white mb-2 font-display uppercase tracking-wide fire-text-glow leading-tight">
                        {{ $game->name }}
                    </h1>
                    <span class="inline-flex items-center rounded bg-amber-500/10 px-2 py-0.5 text-[10px] font-bold text-amber-400 border border-amber-500/20 uppercase tracking-widest font-display mb-4">
                        {{ $game->genre }}
                    </span>

                    <div class="space-y-3 text-xs text-slate-400 border-t border-slate-950 pt-4 font-light">
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
                            <span class="text-amber-500 font-semibold">👥 {{ $game->followers->count() }} members</span>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col gap-2">
                        @auth
                            <button class="w-full py-3 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 text-xs font-bold uppercase tracking-wider font-display shadow transition fire-glow">
                                🔔 Follow Hub
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="w-full py-3 rounded-xl bg-slate-950 hover:bg-slate-900 border border-slate-900 text-slate-400 hover:text-slate-200 text-xs font-bold uppercase tracking-wider font-display text-center block">
                                Log in to Follow
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Action links -->
                @if($game->links->count() > 0)
                    <div class="restpoint-glass rounded-2xl p-5 shadow-xl relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-amber-500/0 via-amber-500/15 to-amber-500/0"></div>
                        <h3 class="text-sm font-bold text-white mb-4 font-display uppercase tracking-widest border-b border-slate-950 pb-2">
                            🛒 Storefront links
                        </h3>
                        <div class="space-y-2">
                            @foreach($game->links as $link)
                                <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-3 rounded-xl border border-slate-950 bg-slate-950/60 hover:bg-slate-900 hover:border-slate-800 transition">
                                    <span class="text-xs font-bold text-slate-300">{{ $link->store_name }}</span>
                                    <span class="text-[10px] text-amber-500 font-semibold uppercase tracking-wider hover:underline">Get &rarr;</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Content details (Right col) -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Video trailer -->
                @if($game->trailer_url)
                    <div class="restpoint-glass rounded-2xl overflow-hidden shadow-xl p-1.5 relative">
                        <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-amber-500/0 via-amber-500/15 to-amber-500/0"></div>
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe src="{{ $game->trailer_url }}" title="{{ $game->name }} Official Trailer" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="w-full h-[320px] md:h-[380px] rounded-xl border border-slate-950"></iframe>
                        </div>
                    </div>
                @endif

                <!-- Feed category floor -->
                <div class="restpoint-glass rounded-2xl p-6 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-amber-500/0 via-amber-500/15 to-amber-500/0"></div>
                    <div class="flex items-center justify-between mb-6 border-b border-slate-950 pb-4">
                        <h3 class="text-lg font-bold text-white font-display uppercase tracking-widest">Tavern Floor</h3>
                        @auth
                            <a href="#" class="inline-flex items-center rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-slate-950 shadow-md hover:from-amber-400 hover:to-amber-500 transition font-display fire-glow">
                                📝 Write Post
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center rounded-xl bg-slate-950 px-4 py-2.5 text-xs font-semibold text-slate-400 hover:text-slate-200 border border-slate-900 transition font-display">
                                Log in to Post
                            </a>
                        @endauth
                    </div>

                    <!-- Category filter tags -->
                    <div class="flex flex-wrap gap-1.5 mb-6">
                        <button class="bg-amber-500 text-slate-950 font-bold uppercase tracking-wider text-[10px] px-3.5 py-2 rounded-lg transition font-display">
                            All Posts
                        </button>
                        @foreach($game->categories as $category)
                            <button class="bg-slate-950/80 text-slate-400 hover:bg-slate-900 border border-slate-900 px-3.5 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest font-display transition">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>

                    <!-- Mock post lists -->
                    <div class="border-t border-slate-950 pt-6">
                        <div class="py-12 text-center bg-slate-950/40 border border-dashed border-slate-900 rounded-xl">
                            <span class="text-3xl text-amber-500/80">📜</span>
                            <h4 class="mt-4 text-sm font-bold text-slate-300 font-display uppercase">Tavern board is clear</h4>
                            <p class="mt-1 text-xs text-slate-500 font-light">We will deploy the posting engine in Phase 2 next week.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
