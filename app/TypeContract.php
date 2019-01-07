<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeContract extends Model
{
    protected $table = 'type_contracts';
    // relacion one to many
    public function contracts(){
    	
    	 return $this->belongsTo('App\Contract');
    }
}
