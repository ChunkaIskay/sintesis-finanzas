<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
	protected $table = 'banks';
	protected $primaryKey = 'bank_id';

    public function many_bank_account(){
        return $this->hasMany('App\BankAccount', 'account_id');
    }
}
