<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionHistory extends Model
{
    protected $table = 'commission_history';
    protected $primaryKey = 'history_id';
}
