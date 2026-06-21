<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-950 text-slate-100 dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RestPoint') }} — The Gamers' Tavern</title>

    <!-- Google Fonts: Outfit for display, Inter for body -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind / Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: 'Outfit', sans-serif;
        }
        .tavern-glow {
            box-shadow: 0 0 25px -5px rgba(245, 158, 11, 0.15), 0 0 15px -5px rgba(245, 158, 11, 0.1);
        }
    </style>
</head>
<body class="h-full flex flex-col selection:bg-amber-500/30 selection:text-amber-200">

    <!-- Glassmorphic Header -->
    <nav class="sticky top-0 z-40 w-full border-b border-slate-900 bg-slate-950/80 backdrop-blur-md">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 text-amber-500 font-extrabold text-2xl tracking-wide font-display hover:text-amber-400 transition duration-300">
                        <span>🍺</span>
                        <span class="bg-gradient-to-r from-amber-400 to-amber-600 bg-clip-text text-transparent">RestPoint</span>
                    </a>
                    <div class="hidden md:ml-10 md:flex md:items-baseline md:space-x-4">
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-slate-900 text-amber-500 border border-slate-800' : 'text-slate-300 hover:bg-slate-900 hover:text-amber-500' }} rounded-lg px-3.5 py-2 text-sm font-medium transition duration-200">Tavern Floor</a>
                        <a href="{{ route('games.index') }}" class="{{ request()->routeIs('games.*') ? 'bg-slate-900 text-amber-500 border border-slate-800' : 'text-slate-300 hover:bg-slate-900 hover:text-amber-500' }} rounded-lg px-3.5 py-2 text-sm font-medium transition duration-200">Game Library</a>
                    </div>
                </div>

                <!-- Right Menu -->
                <div class="flex items-center space-x-4">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.games.index') }}" class="hidden sm:inline-flex items-center rounded-md border border-slate-800 bg-slate-900 px-3 py-1.5 text-xs font-semibold text-amber-500 uppercase tracking-widest hover:bg-slate-800 transition">
                                Keepers Deck
                            </a>
                        @endif

                        <div class="flex items-center space-x-3 bg-slate-900 border border-slate-800/80 rounded-full py-1 pl-3 pr-1">
                            <span class="text-sm font-medium text-slate-300">
                                {{ auth()->user()->username }}
                                <span class="text-xs text-amber-500 font-bold ml-1">XP {{ auth()->user()->xp }}</span>
                            </span>
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="h-8 w-8 rounded-full object-cover border border-amber-500/50" alt="Avatar">
                            @else
                                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center text-slate-900 font-bold text-xs uppercase shadow-sm">
                                    {{ substr(auth()->user()->name, 0, 2) }}
                                </div>
                            @endif
                        </div>

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-slate-400 hover:text-rose-400 text-sm font-medium transition duration-200">
                                Leave Tavern
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-300 hover:text-amber-500 text-sm font-medium transition duration-200">Pull Up a Stool</a>
                        <a href="{{ route('register') }}" class="rounded-lg bg-gradient-to-r from-amber-500 to-amber-600 px-4 py-2 text-sm font-semibold text-slate-950 shadow-md hover:from-amber-400 hover:to-amber-500 transition duration-200 tavern-glow">Join the Guild</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-grow">
        <!-- Toast Alerts -->
        @if (session('success') || session('error') || $errors->any())
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-4">
                @if (session('success'))
                    <div class="flex items-center p-4 mb-4 text-emerald-400 border border-emerald-950/50 bg-emerald-950/20 rounded-xl" role="alert">
                        <span class="text-xl mr-2">✅</span>
                        <div class="text-sm font-medium">{{ session('success') }}</div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="flex items-center p-4 mb-4 text-rose-400 border border-rose-950/50 bg-rose-950/20 rounded-xl" role="alert">
                        <span class="text-xl mr-2">⚠️</span>
                        <div class="text-sm font-medium">{{ session('error') }}</div>
                    </div>
                @endif
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-900 bg-slate-950 py-8 text-center text-slate-500 text-sm">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <p class="font-display">&copy; {{ date('Y') }} RestPoint. Human-generated discussions only. No AI allowed on the floor.</p>
        </div>
    </footer>
</body>
</html>
