<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banking extends Model
{
    protected $table = 'banking';
    protected $fillable = [
        'user_id',
        'account_type',
        'balance',
    ];
}
