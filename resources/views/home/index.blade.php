@extends('layouts.app')

@section('content')
<div class="bg-[#090805] text-[#ede5d0] font-sans antialiased overflow-x-hidden">

    <!-- ── HERO SECTION ──────────────────────────────── -->
    <section class="relative min-h-[92vh] flex items-center overflow-hidden -mt-[72px]">
        <!-- Background image with zoom effect on load -->
        <div class="absolute inset-0 w-full h-full overflow-hidden select-none pointer-events-none">
            <img
              src="https://images.unsplash.com/photo-1641667838410-b257ca266e38?w=1800&h=1100&fit=crop&auto=format"
              alt="Dark atmospheric forest — hero background"
              class="w-full h-full object-cover object-[center_35%] brightness-[0.22] saturate-[0.6] transition-transform duration-[10000ms] scale-102"
            />
            <!-- Smoky/misty linear gradient overlays -->
            <div class="absolute inset-0 bg-gradient-to-b from-[#090805]/40 via-transparent to-[#090805]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_70%_60%_at_50%_70%,rgba(207,124,26,0.07)_0%,transparent_70%)]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#090805]/80 via-transparent to-transparent"></div>
        </div>

        <!-- Ambient Embers Floating Particles -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden select-none">
            <div class="absolute bottom-1/4 left-[15%] w-2 h-2 rounded-full bg-[#cf7c1a] opacity-40 shadow-[0_0_12px_#cf7c1a] animate-[pulse_3s_infinite_alternate]"></div>
            <div class="absolute bottom-1/3 left-[40%] w-1.5 h-1.5 rounded-full bg-[#cf7c1a] opacity-30 shadow-[0_0_8px_#cf7c1a] animate-[pulse_4s_infinite_alternate_1s]"></div>
            <div class="absolute bottom-1/5 left-[60%] w-2.5 h-2.5 rounded-full bg-[#cf7c1a] opacity-25 shadow-[0_0_16px_#cf7c1a] animate-[pulse_5s_infinite_alternate_2s]"></div>
            <div class="absolute bottom-[28%] left-[80%] w-1 h-1 rounded-full bg-[#cf7c1a] opacity-50 shadow-[0_0_6px_#cf7c1a] animate-[pulse_2.5s_infinite_alternate_0.5s]"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-10 w-full pt-32 pb-24 z-10">
            <!-- Eyebrow Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded bg-amber-500/10 border border-amber-500/20 text-[#cf7c1a] font-mono text-[10px] tracking-[0.22em] uppercase mb-8 select-none shadow-[0_0_15px_rgba(207,124,26,0.1)]">
                <i data-lucide="flame" class="w-3.5 h-3.5 animate-pulse text-[#cf7c1a]"></i>
                <span>The Sanctuary is Lit</span>
            </div>

            <!-- Headline with Cinzel Typography & Fire Glow -->
            <h1 class="font-display text-4xl sm:text-6xl lg:text-7xl font-black leading-[1.05] tracking-tight text-[#f0e8d4] [text-shadow:0_4px_45px_rgba(0,0,0,0.95)] max-w-4xl mb-6">
                Where Flames<br />
                <span class="text-[#cf7c1a] [text-shadow:0_0_60px_rgba(207,124,26,0.45),0_4px_40px_rgba(0,0,0,0.9)] animate-[pulse_4s_infinite_alternate]">Never Die</span>
            </h1>

            <!-- Subtitle -->
            <p class="text-sm sm:text-base md:text-lg text-[#8a7a62] leading-relaxed max-w-xl mb-10 font-light tracking-wide">
                RestPoint is the premier RPG community for those who embrace the struggle. Discover game sanctuaries, discuss deep lore, and draft elite builds — forged in the embers of a thousand fallen Undead.
            </p>

            <!-- Action buttons with custom transition and shadows -->
            <div class="flex flex-wrap items-center gap-4">
                <a href="{{ route('games.index') }}" class="font-display inline-flex items-center gap-2.5 px-8 py-3.5 text-xs font-bold tracking-widest bg-gradient-to-r from-[#cf7c1a] to-[#9a5510] text-[#fff8ec] rounded shadow-[0_8px_32px_rgba(207,124,26,0.3)] hover:shadow-[0_12px_44px_rgba(207,124,26,0.5)] transition duration-300 hover:-translate-y-0.5 border border-[#cf7c1a]/30">
                    Light Your Bonfire
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
                <a href="#games-section" class="font-display inline-flex items-center gap-2 px-7 py-3.5 text-xs font-semibold tracking-widest bg-white/5 text-[#c8b898] border border-white/10 hover:border-white/20 hover:text-[#ede5d0] hover:bg-white/8 rounded-md transition duration-300">
                    Explore Sanctuaries
                </a>
            </div>

            <!-- Live Pilgrim Counter -->
            <div class="mt-16 flex items-center gap-4">
                <div class="flex -space-x-2">
                    @foreach(['AK', 'LV', 'GR', 'PB', 'DS'] as $i => $initials)
                        <div class="w-8 h-8 rounded-full border-2 border-[#090805] bg-gradient-to-br from-amber-950/80 to-slate-900 flex items-center justify-center text-[9px] font-display font-black text-[#f0e0c0] shadow-md select-none" style="z-index: {{ 5 - $i }}">
                            {{ $initials }}
                        </div>
                    @endforeach
                </div>
                <div class="text-xs text-[#8a7a62]">
                    <span class="text-[#ede5d0] font-semibold border-b border-[#cf7c1a]/25 pb-0.5">12,847 pilgrims</span> resting at the bonfire right now
                </div>
            </div>
        </div>

        <!-- Descend Scroll Hint -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2.5 opacity-40 select-none hidden sm:flex">
            <div class="w-[1px] h-14 bg-gradient-to-b from-transparent to-[#cf7c1a]"></div>
            <span class="font-mono text-[9px] tracking-[0.2em] text-[#cf7c1a] uppercase">Descend</span>
        </div>
    </section>

    <!-- ── STATS STRIP ───────────────────────────────── -->
    <section class="border-y border-[#cf7c1a]/10 bg-[#cf7c1a]/2 py-1 select-none">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 grid grid-cols-2 md:grid-cols-4 gap-0 divide-x divide-[#cf7c1a]/10">
            @foreach([
                ['label' => 'Pilgrims Online', 'value' => '12,847', 'icon' => 'globe'],
                ['label' => 'Active Threads', 'value' => '4,291', 'icon' => 'message-square'],
                ['label' => 'Guilds Formed', 'value' => '892', 'icon' => 'shield'],
                ['label' => 'Games Covered', 'value' => '138', 'icon' => 'sword']
            ] as $stat)
                <div class="p-6 md:p-8 flex flex-col gap-2.5 items-center md:items-start text-center md:text-left">
                    <i data-lucide="{{ $stat['icon'] }}" class="w-4 h-4 text-[#cf7c1a] opacity-65"></i>
                    <div class="font-mono text-2xl sm:text-3xl font-medium text-[#ede5d0] tracking-tight leading-none">
                        {{ $stat['value'] }}
                    </div>
                    <div class="font-mono text-[10px] text-[#6a5d49] tracking-widest uppercase">
                        {{ $stat['label'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ── GAME SANCTUARIES ──────────────────────────── -->
    <section id="games-section" class="py-24 border-b border-[#cf7c1a]/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <!-- Header Grid -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
                <div class="max-w-xl">
                    <div class="font-mono text-[10px] tracking-[0.25em] text-[#cf7c1a] uppercase mb-3">
                        ── Browse Communities
                    </div>
                    <h2 class="font-display text-3xl sm:text-5xl font-extrabold text-[#f0e8d4] leading-tight">
                        Game Sanctuaries
                    </h2>
                    <p class="mt-3 text-slate-400 text-sm sm:text-base leading-relaxed font-light">
                        Find your kin. Each title has its own dedicated community floor for discussion, questions, and guides.
                    </p>
                </div>
                <a href="{{ route('games.index') }}" class="font-display inline-flex items-center gap-1.5 text-[11px] font-bold tracking-widest text-[#cf7c1a] border border-[#cf7c1a]/25 hover:bg-[#cf7c1a]/10 hover:border-[#cf7c1a]/40 px-6 py-3 rounded-xl transition duration-350 select-none">
                    All Sanctuaries
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- Games Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($games as $game)
                    @php
                        // Distinct high-fidelity background image if cover is not loaded
                        $mockImages = [
                            'https://images.unsplash.com/photo-1765294021016-f98fa390a506?w=800&h=560&fit=crop&auto=format',
                            'https://images.unsplash.com/photo-1768741876785-268ebaaddc03?w=800&h=560&fit=crop&auto=format',
                            'https://images.unsplash.com/photo-1762452712451-33780c18a745?w=800&h=560&fit=crop&auto=format'
                        ];
                        $img = $game->cover_image ? asset('storage/' . $game->cover_image) : $mockImages[$loop->index % 3];
                        $accentColors = ['from-[#8b2a0a]/50', 'from-[#6b1a1a]/50', 'from-[#2a1a4a]/50'];
                        $accent = $accentColors[$loop->index % 3];
                    @endphp
                    <div class="group relative flex flex-col overflow-hidden rounded-2xl bg-[#131008] border border-[#cf7c1a]/10 hover:border-[#cf7c1a]/30 shadow-lg hover:shadow-2xl hover:shadow-amber-500/5 hover:-translate-y-1.5 transition-all duration-350">
                        
                        <!-- Image Container with Dark Shroud -->
                        <div class="relative h-52 bg-slate-950 overflow-hidden">
                            <img src="{{ $img }}" alt="" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t {{ $accent }} via-[#0e0c08]/85 to-[#0e0c08]/50"></div>
                            
                            @if($loop->index < 2)
                                <div class="absolute top-4 right-4 inline-flex items-center gap-1.5 px-3 py-1 rounded bg-[#cf7c1a]/90 text-[#090805] font-mono text-[9px] font-black tracking-widest uppercase shadow-md select-none">
                                    <i data-lucide="flame" class="w-3 h-3"></i>
                                    Trending
                                </div>
                            @endif

                            <div class="absolute bottom-4 left-5 right-5">
                                <div class="font-mono text-[9px] tracking-widest text-[#cf7c1a] uppercase mb-1">
                                    {{ $game->genre }}
                                </div>
                                <h3 class="font-display text-lg font-bold text-[#f0e8d4] tracking-wide leading-tight group-hover:text-amber-400 transition-colors">
                                    <a href="{{ route('games.show', $game->slug) }}">
                                        {{ $game->name }}
                                    </a>
                                </h3>
                            </div>
                        </div>

                        <!-- Card Stats Footer -->
                        <div class="px-5 py-4 flex items-center justify-between border-t border-[#cf7c1a]/5 bg-[#0d0a06]/40 text-xs text-[#8a7a62]">
                            <div class="flex gap-4">
                                <div class="flex items-center gap-1.5">
                                    <i data-lucide="users" class="w-4 h-4 text-[#4a3f2e]"></i>
                                    <span class="font-mono">{{ $game->followers_count }} members</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <i data-lucide="message-square" class="w-4 h-4 text-[#4a3f2e]"></i>
                                    <span class="font-mono">0 posts</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 text-[#e8a22a]">
                                <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                                <span class="font-mono font-bold">4.9</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center rounded-2xl border border-dashed border-[#cf7c1a]/15 bg-[#131008]/40">
                        <i data-lucide="shield" class="w-8 h-8 mx-auto text-[#6a5d49] mb-4"></i>
                        <p class="text-[#8a7a62] font-light">No sanctuaries have been lit yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ── THE CHRONICLE (COMMUNITY POSTS) ──────────────── -->
    <section class="py-24 border-b border-[#cf7c1a]/5 bg-gradient-to-b from-transparent via-[#cf7c1a]/1 to-[#cf7c1a]/2">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <!-- Title -->
            <div class="mb-16">
                <div class="font-mono text-[10px] tracking-[0.25em] text-[#cf7c1a] uppercase mb-3">
                    ── Latest from the Community
                </div>
                <h2 class="font-display text-3xl sm:text-5xl font-extrabold text-[#f0e8d4]">
                    The Chronicle
                </h2>
            </div>

            <!-- Asymmetrical Showcase Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Large Featured Article (Left - cols 8) -->
                <div class="lg:col-span-8 group">
                    <div class="flex flex-col overflow-hidden rounded-2xl bg-[#131008] border border-[#cf7c1a]/10 group-hover:border-[#cf7c1a]/25 shadow-lg group-hover:shadow-2xl group-hover:shadow-amber-500/5 transition-all duration-350">
                        <div class="relative h-72 md:h-80 bg-slate-950 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1470549584009-d347338fc0ff?w=900&h=600&fit=crop&auto=format" alt="" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-103">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#131008] via-[#131008]/40 to-[#131008]/10"></div>
                            <div class="absolute top-5 left-5 inline-flex items-center gap-1.5 px-3 py-1 rounded bg-amber-500/10 border border-amber-500/20 text-[#cf7c1a] font-mono text-[9px] font-bold tracking-widest uppercase select-none">
                                <i data-lucide="star" class="w-3 h-3 text-[#cf7c1a] animate-pulse"></i>
                                Featured Thread
                            </div>
                        </div>

                        <div class="p-6 md:p-8">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="font-mono text-[10px] font-semibold px-2.5 py-1 rounded bg-[#cf7c1a]/10 border border-[#cf7c1a]/15 text-[#cf7c1a]">
                                    Elden Ring
                                </span>
                            </div>
                            <h3 class="font-display text-xl sm:text-2xl font-bold text-[#f0e8d4] tracking-wide leading-snug mb-3 group-hover:text-amber-400 transition-colors">
                                The Great Covenant War of Season XII — A Full Chronicle
                            </h3>
                            <p class="text-slate-400 text-xs sm:text-sm leading-relaxed font-light mb-6">
                                Four alliances, one shattered throne, and forty-three days of the most coordinated PvP campaign in RestPoint history. We sat down with the leaders of each faction to piece together what really happened.
                            </p>
                            
                            <!-- User footprint and stats -->
                            <div class="flex items-center justify-between pt-5 border-t border-[#cf7c1a]/5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#8b3a0a] to-[#5c2205] flex items-center justify-center font-display font-bold text-[11px] text-[#f5e8c0] shadow select-none">
                                        AK
                                    </div>
                                    <div>
                                        <p class="text-xs text-[#c8b898] font-semibold">Ashen_Knight</p>
                                        <p class="text-[10px] text-[#4a3f2e] font-mono">Bearer of the Flame</p>
                                    </div>
                                </div>
                                <div class="flex gap-4 font-mono text-xs text-[#4a3f2e]">
                                    <span class="flex items-center gap-1"><i data-lucide="eye" class="w-3.5 h-3.5"></i> 12.4k</span>
                                    <span class="flex items-center gap-1"><i data-lucide="message-square" class="w-3.5 h-3.5"></i> 347</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Side list of recent activities (Right - cols 4) -->
                <div class="lg:col-span-4 flex flex-col gap-3">
                    @foreach([
                        ['flair' => 'Build Theory', 'color' => 'text-amber-500 bg-amber-500/10 border-amber-500/20', 'title' => 'Optimal bonfire build for NG+7 — all 12 covenants tested', 'author' => 'PhantomBlade_IX', 'time' => '4h ago', 'comments' => 147, 'likes' => 284],
                        ['flair' => 'Lore & Theory', 'color' => 'text-purple-400 bg-purple-400/10 border-purple-400/20', 'title' => 'Who built the Shattered Throne — and why the lore lies to you', 'author' => 'LoreMasterVex', 'time' => '6h ago', 'comments' => 93, 'likes' => 176],
                        ['flair' => 'Guilds', 'color' => 'text-emerald-400 bg-emerald-400/10 border-emerald-400/20', 'title' => 'Ironveil Remnants now recruiting — 200+ members, weekly raids', 'author' => 'GuildmasterResh', 'time' => '9h ago', 'comments' => 58, 'likes' => 91],
                        ['flair' => 'Patch News', 'color' => 'text-rose-500 bg-rose-500/10 border-rose-500/20', 'title' => 'Ashen Covenant patch 1.4.2 — sweeping balance update incoming', 'author' => 'DevWatch_Sorn', 'time' => '12h ago', 'comments' => 211, 'likes' => 432]
                    ] as $i => $post)
                        <div class="p-4 rounded-xl border border-transparent hover:border-[#cf7c1a]/15 hover:bg-[#131008] transition duration-300 group cursor-pointer">
                            <div class="flex items-center gap-2.5 mb-2.5">
                                <span class="font-mono text-xs text-[#2d2820] group-hover:text-[#cf7c1a]/80 transition-colors select-none">
                                    {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="font-mono text-[9px] px-2 py-0.5 rounded border tracking-wide uppercase {{ $post['color'] }} select-none">
                                    {{ $post['flair'] }}
                                </span>
                            </div>

                            <h4 class="font-display text-sm font-medium text-[#c8b898] group-hover:text-[#ede5d0] leading-snug mb-2.5">
                                {{ $post['title'] }}
                            </h4>

                            <div class="flex items-center justify-between text-[11px] text-[#4a3f2e] border-t border-[#cf7c1a]/3 pt-2">
                                <span>{{ $post['author'] }}</span>
                                <div class="flex gap-3 font-mono">
                                    <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3 h-3"></i> {{ $post['time'] }}</span>
                                    <span class="flex items-center gap-1"><i data-lucide="message-square" class="w-3 h-3"></i> {{ $post['comments'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <a href="{{ route('games.index') }}" class="font-display inline-flex items-center justify-center gap-2 mt-4 px-5 py-3.5 text-xs font-semibold tracking-wider text-[#cf7c1a] border border-[#cf7c1a]/15 rounded-xl hover:bg-[#cf7c1a]/10 hover:border-[#cf7c1a]/30 transition select-none">
                        Explore Board Threads
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ── TESTIMONIALS (VOICES FROM BONFIRE) ────────── -->
    <section class="py-24 border-b border-[#cf7c1a]/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <div class="text-center mb-16">
                <div class="font-mono text-[10px] tracking-[0.25em] text-[#cf7c1a] uppercase mb-3 select-none">
                    ── Voices from the Bonfire
                </div>
                <h2 class="font-display text-3xl sm:text-4xl font-extrabold text-[#f0e8d4]">
                    What the Pilgrims Say
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach([
                    ['quote' => 'The only forum where the lore discussions are as deep and intricate as the RPG systems themselves.', 'author' => 'Mordecai_IX', 'rank' => 'Lorekeeper · 3 years', 'avatar' => 'M'],
                    ['quote' => "Drafted my guild squad here. Three years later we're still clearing mythic boss runs together every single week.", 'author' => 'SilentBlade_V', 'rank' => 'Ember Knight · 3 years', 'avatar' => 'S'],
                    ['quote' => 'RestPoint has the single best build database in the soulslike community. Verified and tested.', 'author' => 'RavenWeld', 'rank' => 'Ashen Pilgrim · 2 years', 'avatar' => 'R']
                ] as $test)
                    <div class="p-8 rounded-2xl bg-[#131008] border border-[#cf7c1a]/10 hover:border-[#cf7c1a]/20 shadow-md hover:shadow-lg transition-colors duration-300 relative overflow-hidden flex flex-col justify-between">
                        <!-- Giant decorative Quote mark -->
                        <div class="font-display text-6xl text-[#cf7c1a] opacity-[0.06] absolute -top-1 -left-1 select-none pointer-events-none">&ldquo;</div>
                        
                        <p class="text-slate-300 text-sm leading-relaxed mb-8 italic relative z-10 font-light">
                            "{{ $test['quote'] }}"
                        </p>
                        
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#cf7c1a] to-[#6a3808] flex items-center justify-center font-display font-bold text-xs text-[#faf0dc] shadow-inner select-none">
                                {{ $test['avatar'] }}
                            </div>
                            <div>
                                <p class="text-xs text-[#ede5d0] font-semibold leading-none">{{ $test['author'] }}</p>
                                <p class="font-mono text-[9px] text-[#4a3f2e] mt-1">{{ $test['rank'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── CALL TO ACTION BANNER ────────────────────── -->
    <section class="px-6 lg:px-10 py-24 max-w-7xl mx-auto">
        <div class="relative rounded-3xl overflow-hidden py-20 px-6 md:px-16 text-center border border-[#cf7c1a]/15 shadow-2xl bg-slate-950">
            <!-- Background Image layer with intense dark filter -->
            <div class="absolute inset-0 w-full h-full pointer-events-none select-none">
                <img src="https://images.unsplash.com/photo-1595319260223-c068746347cc?w=1400&h=500&fit=crop&auto=format" alt="" class="w-full h-full object-cover brightness-[0.16] saturate-[0.4]">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_70%_70%_at_50%_50%,rgba(207,124,26,0.1)_0%,rgba(9,8,5,0.7)_100%)]"></div>
            </div>

            <!-- Content Card -->
            <div class="relative z-10 max-w-xl mx-auto">
                <div class="mb-6 select-none">
                    <i data-lucide="flame" class="w-10 h-10 mx-auto text-[#cf7c1a] filter drop-shadow-[0_0_12px_#cf7c1a]"></i>
                </div>
                <h2 class="font-display text-3xl sm:text-4xl font-extrabold text-[#f0e8d4] mb-3 leading-tight">
                    The Bonfire Awaits
                </h2>
                <p class="text-[#8a7a62] text-sm sm:text-base leading-relaxed mb-10 font-light">
                    Join 12,000+ dark RPG enthusiasts. Create builds, share tactics, form alliances. Free forever.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('register') }}" class="font-display px-8 py-3.5 text-xs font-bold tracking-widest bg-gradient-to-r from-[#cf7c1a] to-[#9a5510] text-[#fff8ec] rounded-xl shadow-[0_8px_32px_rgba(207,124,26,0.25)] hover:shadow-[0_12px_44px_rgba(207,124,26,0.4)] hover:-translate-y-0.5 transition duration-300 border border-[#cf7c1a]/20">
                        Create Free Account
                    </a>
                    <a href="{{ route('games.index') }}" class="font-display px-7 py-3.5 text-xs font-bold tracking-widest bg-white/5 text-[#c8b898] border border-white/10 hover:border-white/20 hover:text-[#ede5d0] hover:bg-white/8 rounded-xl transition duration-300">
                        Browse as Guest
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
