<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['game_id', 'name', 'slug'])]
class Category extends Model
{
    use HasFactory;

    /**
     * Get the game this category belongs to.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
