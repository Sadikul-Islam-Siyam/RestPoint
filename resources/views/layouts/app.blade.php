<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RestPoint') }} — The Gamers' Tavern</title>

    <!-- Google Fonts: Outfit for display, Cinzel for headings, JetBrains Mono for stats/subtext -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;900&family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&family=Outfit:wght@300;400;500;600;750;900&display=swap" rel="stylesheet">

    <!-- Tailwind / Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            scrollbar-width: thin;
            scrollbar-color: rgba(207, 124, 26, 0.18) transparent;
        }
        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: 'Cinzel', serif;
        }
        .font-outfit {
            font-family: 'Outfit', sans-serif;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>
<body class="min-h-screen bg-[#090805] text-[#ede5d0] flex flex-col justify-between overflow-x-hidden antialiased">

    <!-- Sticky Header -->
    <header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b border-transparent bg-transparent">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 h-[72px] flex items-center justify-between gap-8">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0 select-none">
                <!-- SVG Flame -->
                <div class="relative w-8 h-9 flex items-center justify-center">
                    <svg viewBox="0 0 32 36" class="w-8 h-9" fill="none">
                        <ellipse cx="16" cy="33" rx="7" ry="2" fill="#cf7c1a" opacity="0.22" />
                        <path d="M16 34C9.5 29,7.5 21,12 15C11 20,15 22,17 19C14.5 25,19.5 27,21.5 22.5C24 19,22.5 13.5,19 10.5C23.5 13,27 19.5,23 25.5C25 23,25.5 18.5,23 15.5C26.5 19,27 25.5,23 30C23.5 31.5,21 34,16 34Z" fill="url(#ng)" />
                        <rect x="9" y="32" width="14" height="2.5" rx="1.25" fill="#5a2c08" />
                        <defs>
                            <linearGradient id="ng" x1="16" y1="34" x2="16" y2="10" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#a05010" />
                                <stop offset="45%" stop-color="#cf7c1a" />
                                <stop offset="85%" stop-color="#f0c040" />
                                <stop offset="100%" stop-color="#fff8c0" stop-opacity="0.85" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <div class="absolute inset-0 rounded-full bg-[radial-gradient(circle_at_50%_60%,rgba(207,124,26,0.28)_0%,transparent_70%)]"></div>
                </div>
                <div class="flex flex-col">
                    <span class="font-display font-black text-lg tracking-[0.16em] text-[#cf7c1a] leading-none [text-shadow:0_0_28px_rgba(207,124,26,0.5)]">RESTPOINT</span>
                    <span class="font-mono text-[9px] tracking-[0.25em] text-[#5a4e38] uppercase mt-0.5">Gaming Sanctuary</span>
                </div>
            </a>

            <!-- Nav links -->
            <nav class="hidden md:flex items-center gap-1">
                <a href="{{ route('home') }}" class="px-3.5 py-1.5 font-display text-[13px] tracking-[0.08em] {{ request()->routeIs('home') ? 'text-[#ede5d0] bg-[#cf7c1a]/7' : 'text-[#8a7a62]' }} hover:text-[#ede5d0] hover:bg-[#cf7c1a]/5 rounded transition">Explore</a>
                <a href="{{ route('games.index') }}" class="px-3.5 py-1.5 font-display text-[13px] tracking-[0.08em] {{ request()->routeIs('games.*') ? 'text-[#ede5d0] bg-[#cf7c1a]/7' : 'text-[#8a7a62]' }} hover:text-[#ede5d0] hover:bg-[#cf7c1a]/5 rounded transition">Games</a>
                <a href="#" class="px-3.5 py-1.5 font-display text-[13px] tracking-[0.08em] text-[#8a7a62] hover:text-[#ede5d0] hover:bg-[#cf7c1a]/5 rounded transition">Guilds</a>
                <a href="#" class="px-3.5 py-1.5 font-display text-[13px] tracking-[0.08em] text-[#8a7a62] hover:text-[#ede5d0] hover:bg-[#cf7c1a]/5 rounded transition">Events</a>
                <a href="#" class="px-3.5 py-1.5 font-display text-[13px] tracking-[0.08em] text-[#8a7a62] hover:text-[#ede5d0] hover:bg-[#cf7c1a]/5 rounded transition">Lore</a>
            </nav>

            <!-- Right side controls -->
            <div class="flex items-center gap-3.5 ml-auto">
                <!-- Search Button -->
                <button class="text-[#6a5d49] hover:text-[#ede5d0] hover:bg-white/5 p-2 rounded-lg transition duration-200">
                    <i data-lucide="search" class="w-[18px] h-[18px]"></i>
                </button>

                @auth
                    <!-- Notifications Button -->
                    <button class="relative text-[#6a5d49] hover:text-[#ede5d0] hover:bg-white/5 p-2 rounded-lg transition duration-200">
                        <i data-lucide="bell" class="w-[18px] h-[18px]"></i>
                        <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 rounded-full bg-[#cf7c1a] shadow-[0_0_8px_#cf7c1a]"></span>
                    </button>

                    <!-- User panel info -->
                    <div class="flex items-center gap-3.5 pl-3.5 border-l border-white/10">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.games.index') }}" class="hidden sm:inline-flex items-center rounded bg-[#cf7c1a]/10 px-2.5 py-1 text-[10px] font-bold text-[#cf7c1a] border border-[#cf7c1a]/20 uppercase tracking-widest font-display">
                                Keepers Deck
                            </a>
                        @endif

                        <div class="flex items-center gap-2">
                            <span class="text-xs font-semibold text-slate-300">{{ auth()->user()->username }}</span>
                            <span class="text-[10px] text-amber-500 font-mono">🔥 XP {{ auth()->user()->xp }}</span>
                        </div>

                        <!-- Logout -->
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-xs text-[#6a5d49] hover:text-rose-400 transition font-mono">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-[#8a7a62] hover:text-[#ede5d0] transition text-[13px] font-display uppercase tracking-widest">Sign In</a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 font-display text-[12px] font-bold tracking-[0.1em] bg-gradient-to-r from-[#cf7c1a] to-[#9a5510] text-[#fff8ec] rounded shadow-[0_0_24px_rgba(207,124,26,0.25)] hover:shadow-[0_0_36px_rgba(207,124,26,0.4)] transition">Join the Sanctum</a>
                @endauth

                <!-- Hamburger menu -->
                <button id="hamburger" class="md:hidden text-[#ede5d0] p-1.5 transition">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Nav Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-[#090805]/98 border-t border-[#cf7c1a]/12 px-8 py-6 flex flex-col gap-2">
            <a href="{{ route('home') }}" class="py-2.5 font-display text-sm tracking-[0.1em] text-[#8a7a62] border-b border-[#cf7c1a]/5 hover:text-white transition">Explore</a>
            <a href="{{ route('games.index') }}" class="py-2.5 font-display text-sm tracking-[0.1em] text-[#8a7a62] border-b border-[#cf7c1a]/5 hover:text-white transition">Games</a>
            <a href="#" class="py-2.5 font-display text-sm tracking-[0.1em] text-[#8a7a62] border-b border-[#cf7c1a]/5 hover:text-white transition">Guilds</a>
            <a href="#" class="py-2.5 font-display text-sm tracking-[0.1em] text-[#8a7a62] border-b border-[#cf7c1a]/5 hover:text-white transition">Events</a>
            <a href="#" class="py-2.5 font-display text-sm tracking-[0.1em] text-[#8a7a62] border-b border-[#cf7c1a]/5 hover:text-white transition">Lore</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow pt-[72px]">
        <!-- Toast Alerts -->
        @if (session('success') || session('error') || $errors->any())
            <div class="mx-auto max-w-7xl px-6 lg:px-10 mt-4">
                @if (session('success'))
                    <div class="flex items-center p-4 mb-4 text-[#cf7c1a] border border-[#cf7c1a]/15 bg-[#cf7c1a]/5 rounded-lg" role="alert">
                        <span class="mr-2">🔥</span>
                        <div class="text-sm font-medium">{{ session('success') }}</div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="flex items-center p-4 mb-4 text-rose-400 border border-rose-950/50 bg-rose-950/20 rounded-lg" role="alert">
                        <span class="mr-2">⚠️</span>
                        <div class="text-sm font-medium">{{ session('error') }}</div>
                    </div>
                @endif
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-[#cf7c1a]/10 bg-slate-950/20 py-16 px-6 lg:px-10">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-5 gap-12">
            <!-- Brand Column -->
            <div class="md:col-span-2 space-y-4">
                <div class="font-display font-black text-xl tracking-[0.16em] text-[#cf7c1a] [text-shadow:0_0_20px_rgba(207,124,26,0.35)]">
                    RESTPOINT
                </div>
                <p class="text-[#4a3f2e] text-sm leading-relaxed max-w-[280px]">
                    The dark RPG sanctuary. Where the undead find community, and the flame endures.
                </p>
                <div class="flex gap-2.5 pt-2">
                    @foreach(['Discord', 'Twitter', 'YouTube'] as $social)
                        <a href="#" class="px-3 py-1.5 rounded bg-white/4 border border-[#cf7c1a]/10 text-[#6a5d49] hover:text-[#cf7c1a] hover:border-[#cf7c1a]/30 font-mono text-[11px] transition">
                            {{ $social }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Links Column 1 -->
            <div>
                <h4 class="font-display text-[11px] font-bold tracking-[0.15em] text-[#6a5d49] uppercase mb-5">Community</h4>
                <ul class="space-y-2.5 text-sm text-[#4a3f2e] list-none p-0 m-0">
                    <li><a href="#" class="hover:text-[#c8b898] transition">Forums</a></li>
                    <li><a href="#" class="hover:text-[#c8b898] transition">Guilds</a></li>
                    <li><a href="#" class="hover:text-[#c8b898] transition">Events</a></li>
                    <li><a href="#" class="hover:text-[#c8b898] transition">Leaderboard</a></li>
                </ul>
            </div>

            <!-- Links Column 2 -->
            <div>
                <h4 class="font-display text-[11px] font-bold tracking-[0.15em] text-[#6a5d49] uppercase mb-5">Content</h4>
                <ul class="space-y-2.5 text-sm text-[#4a3f2e] list-none p-0 m-0">
                    <li><a href="#" class="hover:text-[#c8b898] transition">Game Reviews</a></li>
                    <li><a href="#" class="hover:text-[#c8b898] transition">Build Guides</a></li>
                    <li><a href="#" class="hover:text-[#c8b898] transition">Lore Archive</a></li>
                    <li><a href="#" class="hover:text-[#c8b898] transition">News</a></li>
                </ul>
            </div>

            <!-- Links Column 3 -->
            <div>
                <h4 class="font-display text-[11px] font-bold tracking-[0.15em] text-[#6a5d49] uppercase mb-5">Account</h4>
                <ul class="space-y-2.5 text-sm text-[#4a3f2e] list-none p-0 m-0">
                    <li><a href="{{ route('register') }}" class="hover:text-[#c8b898] transition">Sign Up</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-[#c8b898] transition">Log In</a></li>
                    <li><a href="#" class="hover:text-[#c8b898] transition">Settings</a></li>
                </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto mt-12 pt-6 border-t border-[#cf7c1a]/7 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-[12px] text-[#2d2820] font-mono">
                © 2026 RestPoint · All embers reserved · Age of Flames IV
            </p>
            <div class="flex gap-6 font-mono text-[12px] text-[#2d2820]">
                <a href="#" class="hover:text-[#c8b898]">Privacy</a>
                <a href="#" class="hover:text-[#c8b898]">Terms</a>
                <a href="#" class="hover:text-[#c8b898]">Cookies</a>
            </div>
        </div>
    </footer>

    <!-- Lucide icons and menu script -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        // Init Lucide
        lucide.createIcons();

        // Navbar Scroll Effect
        const header = document.getElementById('main-header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 40) {
                header.classList.add('bg-[#090805]/88', 'backdrop-blur-xl', 'border-[#cf7c1a]/12');
                header.classList.remove('bg-transparent', 'border-transparent');
            } else {
                header.classList.remove('bg-[#090805]/88', 'backdrop-blur-xl', 'border-[#cf7c1a]/12');
                header.classList.add('bg-transparent', 'border-transparent');
            }
        });

        // Mobile Menu Toggle
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');
        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
