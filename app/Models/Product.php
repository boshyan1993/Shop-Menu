<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
   protected $fillable = [
    'name',
    'description',
    'description_hy',
    'description_ru',
    'description_en',
    'price',
    'image',
    'menu_item_id',
];

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }
}
