<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        $admin = User::factory()->create([
            'name' => 'Tavern Keeper',
            'username' => 'admin',
            'email' => 'admin@restpoint.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'bio' => 'Owner of the Tavern. Keeping the tavern clean.',
        ]);

        // 2. Create Moderator User
        $moderator = User::factory()->create([
            'name' => 'Tavern Guard',
            'username' => 'moderator',
            'email' => 'mod@restpoint.com',
            'password' => bcrypt('password'),
            'role' => 'moderator',
            'bio' => 'Tavern bouncer. Keep it positive.',
        ]);

        // 3. Create regular Member
        $member = User::factory()->create([
            'name' => 'Siam Sadikul',
            'username' => 'siam',
            'email' => 'siam@example.com',
            'password' => bcrypt('password'),
            'role' => 'member',
            'bio' => 'Avid RPG and rogue-like gamer!',
        ]);

        // 4. Create some test members
        User::factory(10)->create();

        // 5. Seed Games
        $gamesData = [
            [
                'name' => 'Elden Ring',
                'slug' => 'elden-ring',
                'genre' => 'Action RPG',
                'platforms' => ['PC', 'PS5', 'Xbox'],
                'developer' => 'FromSoftware',
                'release_date' => '2022-02-25',
                'trailer_url' => 'https://www.youtube.com/embed/E3Huy2cdih0',
                'links' => [
                    ['store_name' => 'Steam', 'url' => 'https://store.steampowered.com/app/1245620/ELDEN_RING/'],
                    ['store_name' => 'PlayStation', 'url' => 'https://store.playstation.com/en-us/product/UP0700-PPSA04609_00-ELDENRING0000000'],
                    ['store_name' => 'Xbox', 'url' => 'https://www.xbox.com/en-US/games/store/elden-ring/9p2n0sxh1t00'],
                ]
            ],
            [
                'name' => 'Hades II',
                'slug' => 'hades-ii',
                'genre' => 'Rogue-like',
                'platforms' => ['PC'],
                'developer' => 'Supergiant Games',
                'release_date' => '2024-05-06',
                'trailer_url' => 'https://www.youtube.com/embed/fW4fGf8f-y4',
                'links' => [
                    ['store_name' => 'Steam', 'url' => 'https://store.steampowered.com/app/1145350/Hades_II/'],
                    ['store_name' => 'Epic Games', 'url' => 'https://store.epicgames.com/en-US/p/hades-ii-82f505'],
                ]
            ],
            [
                'name' => 'Cyberpunk 2077',
                'slug' => 'cyberpunk-2077',
                'genre' => 'Sci-Fi RPG',
                'platforms' => ['PC', 'PS5', 'Xbox'],
                'developer' => 'CD Projekt Red',
                'release_date' => '2020-12-10',
                'trailer_url' => 'https://www.youtube.com/embed/L8zT4m-2tS8',
                'links' => [
                    ['store_name' => 'Steam', 'url' => 'https://store.steampowered.com/app/1091500/Cyberpunk_2077/'],
                    ['store_name' => 'Epic Games', 'url' => 'https://store.epicgames.com/en-US/p/cyberpunk-2077'],
                    ['store_name' => 'GOG', 'url' => 'https://www.gog.com/en/game/cyberpunk_2077'],
                ]
            ],
        ];

        $standardCategories = [
            'Boss Strategy',
            'Walkthrough',
            'Builds & Loadouts',
            'Item Locations',
            'Lore & Story',
            'Technical / Bugs',
            'General'
        ];

        foreach ($gamesData as $gd) {
            $game = \App\Models\Game::create([
                'name' => $gd['name'],
                'slug' => $gd['slug'],
                'genre' => $gd['genre'],
                'platforms' => $gd['platforms'],
                'developer' => $gd['developer'],
                'release_date' => $gd['release_date'],
                'trailer_url' => $gd['trailer_url'],
                'created_by' => $admin->id,
            ]);

            // Add Categories
            foreach ($standardCategories as $catName) {
                \App\Models\Category::create([
                    'game_id' => $game->id,
                    'name' => $catName,
                    'slug' => \Illuminate\Support\Str::slug($catName),
                ]);
            }

            // Add Store Links
            foreach ($gd['links'] as $link) {
                \App\Models\GameLink::create([
                    'game_id' => $game->id,
                    'store_name' => $link['store_name'],
                    'url' => $link['url'],
                ]);
            }
        }
    }
}
