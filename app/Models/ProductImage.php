<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{

    protected $table = 'product_image';

    protected $fillable = [
        'product_id', 'path', 'user_id', 'show_order'
    ];
}
