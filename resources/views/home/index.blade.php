@extends('layouts.app')

@section('content')
<div class="relative overflow-hidden bg-slate-950 pt-16 pb-20">
    <!-- Amber radial background light -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(245,158,11,0.12),rgba(255,255,255,0))]"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium text-amber-400 bg-amber-500/10 border border-amber-500/20 mb-6">
            ⚔️ Now in Open Beta
        </span>
        <h1 class="text-5xl sm:text-7xl font-extrabold tracking-tight text-white mb-6">
            Welcome to the <br>
            <span class="bg-gradient-to-r from-amber-400 via-amber-500 to-yellow-600 bg-clip-text text-transparent">Gamers' Tavern</span>
        </h1>
        <p class="mx-auto max-w-2xl text-lg sm:text-xl text-slate-400 mb-10 font-light leading-relaxed">
            RestPoint is a home for raw, authentic, human-only gaming discussions. Get solutions to tough boss fights, write helpful walkthroughs, or talk lore over a cold pint.
        </p>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
            <a href="{{ route('games.index') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 font-bold text-slate-950 shadow-lg hover:from-amber-400 hover:to-amber-500 transition duration-300 transform hover:-translate-y-0.5 text-center">
                Browse Games Hub
            </a>
            @guest
            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-slate-900 border border-slate-800 text-slate-300 font-bold hover:bg-slate-800 transition duration-300 hover:text-white text-center">
                Claim Your Seat
            </a>
            @endguest
        </div>

        <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            <div class="p-8 rounded-2xl bg-slate-900/40 border border-slate-900 hover:border-slate-800 transition duration-300">
                <span class="text-4xl">🧱</span>
                <h3 class="text-xl font-bold mt-4 mb-2 text-white">Pure Human</h3>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Zero AI in your face. Authenticity is our creed. Everything here is written by gamers, for gamers.
                </p>
            </div>
            <div class="p-8 rounded-2xl bg-slate-900/40 border border-slate-900 hover:border-slate-800 transition duration-300">
                <span class="text-4xl">⚔️</span>
                <h3 class="text-xl font-bold mt-4 mb-2 text-white">Help & Discuss</h3>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Flag your problems as Help posts to get community answers. Once solved, get the checklist badge!
                </p>
            </div>
            <div class="p-8 rounded-2xl bg-slate-900/40 border border-slate-900 hover:border-slate-800 transition duration-300">
                <span class="text-4xl">🏆</span>
                <h3 class="text-xl font-bold mt-4 mb-2 text-white">Earn Reputation</h3>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Become a tavern legend. Get marked as solved, start trending threads, and earn customized gaming badges.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
