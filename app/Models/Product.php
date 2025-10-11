<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // ⬅️ ini WAJIB ADA

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'best_seller',
    ];
}
