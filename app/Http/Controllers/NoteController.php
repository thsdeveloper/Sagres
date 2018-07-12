<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;


class NoteController extends Controller
{
    //Insert new notes
    protected function insert(Request $request){
      $note = new Note;
      $note->note = $request->note;
      $note->student_id = $request->student_id;
      $note->discipline_id = $request->discipline_id;
      $note->save();
      return $note;
    }
}
