<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroceryItem extends Model
{
    protected $fillable = [
        'name',
        'quantity', 
        'price',
        'category',
        'store',
        'purchased'
    ];

    // Calculate total cost for this item
    public function getTotalAttribute()
    {
        return $this->quantity * ($this->price ?? 0);
    }
}
