<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayPnetEntity extends Model
{
    protected $table = 'pnet_entidades_import';
	protected $primaryKey = 'codigo_unico_empresa';
}
