<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'tbl_account';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function transactionHistory()
    {
        return $this->hasMany(TransactionHistory::class, 'account_id', 'id');
    }

    protected $fillable = [
        'fullname',
        'email',
        'username',
        'password',
        'phone',
        'surplus',
    ];
}
