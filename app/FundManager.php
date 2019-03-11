<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundManager extends Model
{
    protected $table = 'fund_managers';
    protected $fillable = [
        'user_id',
        'receiver',
        'desc',
        'transaction_type',
        'amount',
    ];
}
