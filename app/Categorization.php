<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorization extends Model
{
   protected $table = 'categorizations';

    // relacion one to many
    public function contracts(){
    	
    	 return $this->belongsTo('App\Contract');
    }
}


