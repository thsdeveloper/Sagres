<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
  //
  //
  // public function student(){
  //   return $this->hasMany(InstitutionSuggestion::class);
  // }

  // public function student(){
  //   return $this->BelongsToMany(Student::class);
  // }


  public function discipline(){
    return $this->BelongsTo(Discipline::class);
  }

}
