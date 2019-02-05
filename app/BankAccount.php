<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
     protected $table = 'many_bank_accounts';
     protected $primaryKey = 'account_id';

    public function entities(){
        
         return $this->belongsTo('App\Entity');
    }

    public function bank(){

         return $this->belongsTo('App\Bank');
    }
}
