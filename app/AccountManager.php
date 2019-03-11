<?php

namespace App;

use App\Banking;
use App\FundManager;
use Illuminate\Database\Eloquent\Model;

class AccountManager extends Model
{
    /**
     * @var string
     */
    protected $table = 'account_managers';

    /**
     * @var array
     */
    protected $fillable = [
        'dob',
        'photo',
        'title',
        'state',
        'address',
        'surname',
        'country',
        'password',
        'othername',
        'account_pin',
        'account_type',
        'phone_number',
        'email_address',
        'account_number',
        'facial_response',
    ];

    /**
     * @return mixed
     */
    public function bankDetails()
    {
        return $this->hasMany(FundManager::class, 'user_id', 'id');
    }

    /**
     * @return mixed
     */
    public function bankAccount()
    {
        return $this->hasMany(Banking::class, 'user_id', 'id');
    }

    /**
     * @param $userInfo
     * @return mixed
     */
    public function fullInfo($userInfo)
    {
        return $this->where('id', $userInfo->id)->with('bankDetails')->with('bankAccount');
    }
}
