<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coffee extends Model
{
    use HasFactory;

    protected $fillable = [
        "name","type","description","image","rate", "rate_total"
    ];
    public $timestamps = false;

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function favorites()
    {
        return $this->hasMany(CoffeeFavorite::class, "coffee_id");
    }

    public function priceForSize($size)
    {
        return $this->prices()->where('size', $size)->first();
    }
}
