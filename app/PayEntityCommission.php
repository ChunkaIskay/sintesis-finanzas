<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayEntityCommission extends Model
{
	//Memoria maxima de ejecucion
    ini_set('memory_limit', "3072M");
    //Tiempo maximo de ejecucion
    set_time_limit(300);
    
	protected $table = 'transaction_import';
	protected $primaryKey = 'cli';
}
