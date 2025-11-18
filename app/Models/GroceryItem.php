<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroceryItem extends Model
{
    protected $fillable = [
        'name',
        'quantity', 
        'price',
        'category',
        'store',
        'purchased',
        'user_id'
    ];

    // Calculate total cost for this item
    public function getTotalAttribute()
    {
        return $this->quantity * ($this->price ?? 0);
    }

    // Relationship with User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
