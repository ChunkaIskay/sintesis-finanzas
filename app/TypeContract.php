<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeContract extends Model
{
    protected $table = 'type_contracts';
    protected $primaryKey = 'type_id';
    // relacion one to many
    public function contracts(){
    	
    	 return $this->belongsTo('App\Contract');
    }
}
