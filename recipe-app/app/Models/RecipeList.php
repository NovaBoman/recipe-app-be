<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeList extends Model
{
    protected $fillable = [
        'title',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listEntries()
    {
        return $this->hasMany(ListEntry::class);
    }
}
