<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product_table';

    protected $fillable = [
            'brand_name', 
            'product_name', 
            'sku', 
            'orginal_price', 
            'receive_date', 
            'exp_date', 
            'image_urls'
    ];

}
