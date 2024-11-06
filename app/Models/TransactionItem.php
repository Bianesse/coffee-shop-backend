<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'orderId', 'coffeeId', 'quantity','size', 'subtotal'
    ];

    public function transactions()
    {
        return $this->belongsTo(Transaction::class, 'orderId', 'orderId');
    }

    public function coffees()
    {
        return $this->belongsTo(Coffee::class, 'coffeeId');
    }
}
