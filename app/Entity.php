<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
   protected $table = 'entities';
    
     // relacion one to many
    public function contracts(){
    	
    	 return $this->belongsTo('App\Contract');
    }
    
}
