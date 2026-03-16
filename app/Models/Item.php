<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'category',
        'menu_category_id',
        'description',
        'is_available',
    ];

    public function menuCategory()
    {
        return $this->belongsTo(MenuCategory::class);
    }
}
