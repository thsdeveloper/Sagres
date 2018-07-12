<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Discipline;
use App\Note;



class HomeController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $students = Student::with('note.discipline')->get();

    // dd($students);

    $disciplines = Discipline::get();

    $notes = Note::with('student', 'discipline')->get();

    return view('home', compact('students', 'disciplines', 'notes'));
  }
}
