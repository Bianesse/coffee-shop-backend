<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        "cartId",
        "coffeeId",
        "size",
        "amount",
    ];

    public function coffees(): BelongsTo
    {
        return $this->belongsTo(Coffee::class, "coffeeId");
    }
}
