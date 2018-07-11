<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('students', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('matricula');
      $table->string('nome');
      $table->string('endereco');
      $table->string('bairro');
      $table->string('cep');
      $table->string('cidade');
      $table->string('uf');
      $table->string('email');
      $table->date('data_entrada');
      $table->timestamps();
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('students');
  }
}
