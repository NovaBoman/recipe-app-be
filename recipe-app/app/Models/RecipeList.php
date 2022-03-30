<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeList extends Model
{
    protected $fillable = [
        'title',
        'user_id',
    ];

    public function listEntries()
    {
        return $this->hasMany(ListEntry::class);
    }
}
