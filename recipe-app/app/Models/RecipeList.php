<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeList extends Model
{
    public function listEntries()
    {
        return $this->hasMany(ListEntry::class);
    }
}
