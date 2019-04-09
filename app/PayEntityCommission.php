<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayEntityCommission extends Model
{
	protected $table = 'transaction_import';
	protected $primaryKey = 'cli';
}
