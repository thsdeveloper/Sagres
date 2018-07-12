<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discipline;

class DisciplinesController extends Controller
{
    //Insert new discipline
    protected function insert(Request $request){
        $discipline = new Discipline;
        $discipline->nome = $request->nome;
        $discipline->save();
        return $discipline;
    }
}
