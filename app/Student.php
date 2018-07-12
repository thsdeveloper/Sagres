<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    public function note(){
      return $this->hasMany(Note::class, 'student_id');
    }
}
