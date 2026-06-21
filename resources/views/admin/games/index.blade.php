@extends('layouts.app')

@section('content')
<div class="bg-slate-950 py-12 min-h-screen">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-white font-display">Keepers Deck (Game Management)</h1>
                <p class="mt-2 text-sm text-slate-400">Add, edit, or remove games from the RestPoint database. Creating a game automatically pre-seeds categories.</p>
            </div>
            <a href="{{ route('admin.games.create') }}" class="inline-flex items-center rounded-xl bg-amber-500 px-4 py-2.5 text-sm font-semibold text-slate-950 shadow-md hover:bg-amber-400 transition">
                ➕ Add Game
            </a>
        </div>

        <!-- Games List -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
            <table class="min-w-full divide-y divide-slate-800 text-left">
                <thead class="bg-slate-950/60 text-xs text-slate-400 uppercase font-semibold">
                    <tr>
                        <th class="px-6 py-4">Game</th>
                        <th class="px-6 py-4">Genre</th>
                        <th class="px-6 py-4">Platforms</th>
                        <th class="px-6 py-4">Developer</th>
                        <th class="px-6 py-4">Release Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-sm text-slate-300">
                    @forelse($games as $game)
                        <tr class="hover:bg-slate-800/30 transition">
                            <td class="px-6 py-4 flex items-center space-x-3">
                                @if($game->cover_image)
                                    <img src="{{ asset('storage/' . $game->cover_image) }}" class="h-10 w-8 rounded object-cover" alt="">
                                @else
                                    <div class="h-10 w-8 rounded bg-slate-950 flex items-center justify-center text-xs">🎮</div>
                                @endif
                                <div>
                                    <a href="{{ route('games.show', $game->slug) }}" class="font-bold text-white hover:text-amber-500 transition">{{ $game->name }}</a>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded bg-slate-850 px-2 py-1 text-xs text-slate-400 border border-slate-800">{{ $game->genre }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @if(is_array($game->platforms))
                                        @foreach($game->platforms as $plat)
                                            <span class="text-[10px] bg-slate-950 text-slate-400 border border-slate-850 px-1.5 py-0.5 rounded">{{ $plat }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-400">{{ $game->developer }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $game->release_date?->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.games.edit', $game->id) }}" class="text-amber-500 hover:text-amber-400 font-semibold transition text-sm">Edit</a>
                                <form action="{{ route('admin.games.destroy', $game->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this game? This will remove all associated categories and links.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-400 font-semibold transition text-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                No games registered. Click "Add Game" to register the first one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
