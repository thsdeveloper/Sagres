<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

  public function student(){
    return $this->BelongsTo(Student::class);
  }


  public function discipline(){
    return $this->BelongsTo(Discipline::class);
  }

}
