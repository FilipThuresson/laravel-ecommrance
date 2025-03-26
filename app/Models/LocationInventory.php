<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationInventory extends Model
{
    protected $fillable = ['location_id', 'product_id', 'quantity'];

    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
