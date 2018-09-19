<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
   public function faculty()
   {
	 return $this->belongsTo(Faculty::class);
   }
}

