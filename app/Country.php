<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
      protected $table = 'countries';
      protected $primaryKey = 'country_id';

      public function entities(){
      	return $this->belongsTo('App\Entity');
      }

}
