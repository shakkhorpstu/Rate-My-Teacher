<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  public function faculty()
  {
    return $this->belongsTo(Faculty::class);
  }

  public function department()
  {
    return $this->belongsTo(Department::class);
  }
}
