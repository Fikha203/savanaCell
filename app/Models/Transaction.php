<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['total_price','user_id','transaction_time','status'];

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
