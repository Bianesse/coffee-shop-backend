<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'orderId',
        'user_id',
        'total',
        'paymentAmount',
        'change',
        'payment_method',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($transaction) {
            if ($transaction->isForceDeleting()) {
                // Force delete related det_transactions
                $transaction->transactionItems()->forceDelete();
            } else {
                // Soft delete related det_transactions
                $transaction->transactionItems()->delete();
            }
        });
        static::restoring(function ($transaction) {
            // Restore related det_transactions
            $transaction->transactionItems()->onlyTrashed()->restore();
        });
    }
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class, "orderId", "orderId");
    }

    public function users()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
