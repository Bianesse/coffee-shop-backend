<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cartId', 'coffeeId', 'quantity', "size", "subtotal"
    ];

    public function carts()
    {
        return $this->belongsTo(Cart::class, 'cartId');
    }
    public function coffees(): BelongsTo
    {
        return $this->belongsTo(Coffee::class, "coffeeId");
    }
    
    
}
