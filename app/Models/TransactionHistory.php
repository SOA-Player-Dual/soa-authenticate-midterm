<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $table = 'tbl_transaction_history';
    protected $primaryKey = 'id';
    protected $fillable = [
        'account_id',
        'amount',
        'created_at',
        'updated_at',
    ];
}
