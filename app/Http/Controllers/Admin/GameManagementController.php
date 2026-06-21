<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Category;
use App\Models\GameLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GameManagementController extends Controller
{
    /**
     * List all games in management dashboard.
     */
    public function index()
    {
        $games = Game::latest()->get();
        return view('admin.games.index', compact('games'));
    }

    /**
     * Show form to add a game.
     */
    public function create()
    {
        return view('admin.games.create');
    }

    /**
     * Store new game and seed standard categories.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:games,name',
            'genre' => 'required|string|max:100',
            'platforms' => 'required|array',
            'developer' => 'required|string|max:255',
            'release_date' => 'required|date',
            'trailer_url' => 'nullable|url',
            'cover_image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:4096',
            'stores' => 'nullable|array',
            'stores.*.name' => 'required_with:stores|string',
            'stores.*.url' => 'required_with:stores|url',
        ]);

        $slug = Str::slug($request->name);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        }

        $bannerPath = null;
        if ($request->hasFile('banner_image')) {
            $bannerPath = $request->file('banner_image')->store('banners', 'public');
        }

        $game = Game::create([
            'name' => $request->name,
            'slug' => $slug,
            'genre' => $request->genre,
            'platforms' => $request->platforms,
            'developer' => $request->developer,
            'release_date' => $request->release_date,
            'trailer_url' => $this->formatTrailerUrl($request->trailer_url),
            'cover_image' => $coverPath,
            'banner_image' => $bannerPath,
            'created_by' => auth()->id(),
        ]);

        // Auto pre-seed standard categories
        $standardCategories = [
            'Boss Strategy',
            'Walkthrough',
            'Builds & Loadouts',
            'Item Locations',
            'Lore & Story',
            'Technical / Bugs',
            'General'
        ];
        foreach ($standardCategories as $catName) {
            Category::create([
                'game_id' => $game->id,
                'name' => $catName,
                'slug' => Str::slug($catName),
            ]);
        }

        // Add Store Links
        if ($request->has('stores')) {
            foreach ($request->stores as $store) {
                if (!empty($store['name']) && !empty($store['url'])) {
                    GameLink::create([
                        'game_id' => $game->id,
                        'store_name' => $store['name'],
                        'url' => $store['url'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.games.index')->with('success', 'Game added successfully and categories pre-seeded!');
    }

    /**
     * Show form to edit game details.
     */
    public function edit(Game $game)
    {
        $game->load('links');
        return view('admin.games.edit', compact('game'));
    }

    /**
     * Update game details.
     */
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:games,name,' . $game->id,
            'genre' => 'required|string|max:100',
            'platforms' => 'required|array',
            'developer' => 'required|string|max:255',
            'release_date' => 'required|date',
            'trailer_url' => 'nullable|url',
            'cover_image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:4096',
            'stores' => 'nullable|array',
            'stores.*.name' => 'required_with:stores|string',
            'stores.*.url' => 'required_with:stores|url',
        ]);

        $slug = Str::slug($request->name);

        if ($request->hasFile('cover_image')) {
            $game->cover_image = $request->file('cover_image')->store('covers', 'public');
        }

        if ($request->hasFile('banner_image')) {
            $game->banner_image = $request->file('banner_image')->store('banners', 'public');
        }

        $game->update([
            'name' => $request->name,
            'slug' => $slug,
            'genre' => $request->genre,
            'platforms' => $request->platforms,
            'developer' => $request->developer,
            'release_date' => $request->release_date,
            'trailer_url' => $this->formatTrailerUrl($request->trailer_url),
        ]);

        // Sync Store Links
        $game->links()->delete();
        if ($request->has('stores')) {
            foreach ($request->stores as $store) {
                if (!empty($store['name']) && !empty($store['url'])) {
                    GameLink::create([
                        'game_id' => $game->id,
                        'store_name' => $store['name'],
                        'url' => $store['url'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.games.index')->with('success', 'Game updated successfully!');
    }

    /**
     * Delete game.
     */
    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('admin.games.index')->with('success', 'Game deleted successfully!');
    }

    /**
     * Embed format helper.
     */
    private function formatTrailerUrl($url)
    {
        if (empty($url)) return null;

        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $url, $match)) {
            return "https://www.youtube.com/embed/" . $match[1];
        }

        return $url;
    }
}
