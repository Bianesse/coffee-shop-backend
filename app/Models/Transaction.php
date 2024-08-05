<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'orderId',
        'total',
        'paymentAmount',
        'change',
    ];

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
