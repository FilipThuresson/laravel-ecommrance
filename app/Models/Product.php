<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'name', 'article_no', 'price', 'description', 'short_description', 'active'
    ];


    public function getPriceAttribute()
    {
        return $this->price_in_cents / 100;
    }

    // Set price in cents when saving
    public function setPriceAttribute($value)
    {
        $this->attributes['price_in_cents'] = $value * 100;
    }

    public function images() {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')->orderBy('show_order');
    }

    public function inventory() {
        return $this->hasMany(LocationInventory::class, 'product_id', 'id')->orderBy('location_id');
    }
}
