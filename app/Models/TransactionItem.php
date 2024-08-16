<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'orderId', 'coffeeId', 'quantity','size', 'subtotal'
    ];

    public function transactions()
    {
        return $this->belongsTo(Transaction::class, 'orderId');
    }

    public function coffees()
    {
        return $this->belongsTo(Coffee::class, 'coffeeId');
    }
}
