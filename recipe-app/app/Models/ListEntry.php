<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListEntry extends Model
{
    protected $fillable = [
        'recipe_list_id',
        'recipe_id',
    ];
}
