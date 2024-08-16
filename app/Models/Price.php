<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        "coffee_id",
        "size",
        "price",
    ];

    public function coffees()
    {
        return $this->belongsTo(Coffee::class, "coffee_id");
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
