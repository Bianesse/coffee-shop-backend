<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeFavorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coffee_id',
    ];

    public function coffees()
    {
        return $this->belongsTo(Coffee::class, "coffee_id");
    }

    public function users()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
