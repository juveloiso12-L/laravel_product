<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Tambahkan baris ini agar Laravel mengizinkan penyimpanan data
    protected $fillable = [
        'name', 
        'sku', 
        'price', 
        'stock', 
        'description', 
        'image'
    ];
}