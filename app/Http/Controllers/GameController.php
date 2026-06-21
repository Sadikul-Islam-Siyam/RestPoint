<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a list of all games.
     */
    public function index()
    {
        $games = Game::withCount('followers')->get();
        return view('games.index', compact('games'));
    }

    /**
     * Display a specific game page.
     */
    public function show($slug)
    {
        $game = Game::with(['categories', 'links', 'followers'])->where('slug', $slug)->firstOrFail();
        return view('games.show', compact('game'));
    }
}
