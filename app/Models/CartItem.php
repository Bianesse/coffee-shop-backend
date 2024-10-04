<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'coffeeId', 'quantity', "size", "subtotal"
    ];


    public function coffees(): BelongsTo
    {
        return $this->belongsTo(Coffee::class, "coffeeId");
    }
    
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
