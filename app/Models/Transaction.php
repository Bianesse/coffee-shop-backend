<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'orderId',
        'user_id',
        'total',
        'paymentAmount',
        'change',
    ];

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class, "orderId", "orderId");
    }

    public function users()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
