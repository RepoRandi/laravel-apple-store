<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'stock',
        'weight',
        'is_available',
        'category_id',
    ];

    protected $casts = [
        'weight' => 'decimal:1',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
