<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'slug', 'cover_image', 'banner_image', 'trailer_url', 'genre', 'platforms', 'developer', 'release_date', 'created_by'])]
class Game extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'platforms' => 'array',
            'release_date' => 'date',
        ];
    }

    /**
     * Get categories under this game.
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Get links (stores, downloads) for this game.
     */
    public function links()
    {
        return $this->hasMany(GameLink::class);
    }

    /**
     * Get users following this game.
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'game_follows', 'game_id', 'user_id')->withTimestamps();
    }
}
