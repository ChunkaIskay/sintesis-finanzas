<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionImport extends Model
{
    protected $table = 'transaction_import';
    protected $primaryKey = 'cli';

}
