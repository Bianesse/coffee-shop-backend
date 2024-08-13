<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        "coffee_id",
        "user_id",
        "rating",
    ];

    public function coffees()
    {
        return $this->belongsTo(Coffee::class, "coffee_id");
    }

    public function reviewers()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
