<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudantController extends Controller
{

  //Insert new student
  protected function insert(Request $request){
    $student = new Student;
    $student->nome = $request->nome;
    $student->matricula = $request->matricula;
    $student->endereco = $request->endereco;
    $student->bairro = $request->bairro;
    $student->cep = $request->cep;
    $student->cidade = $request->cidade;
    $student->uf = $request->uf;
    $student->email = $request->email;
    $student->data_entrada = $request->data;
    $student->save();
    return $student;
  }
}
