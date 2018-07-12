@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <el-tabs type="border-card">
          <el-tab-pane label="Alunos cadastrados">
            <students :students="{{$students}}"></students>
          </el-tab-pane>
          <el-tab-pane label="Disciplinas">
            <disciplines :disciplines="{{$disciplines}}"></disciplines>
          </el-tab-pane>
          <el-tab-pane label="Aplicar Notas">
            <notes :notes="{{$notes}}" :students="{{$students}}" :disciplines="{{$disciplines}}"></notes>
          </el-tab-pane>
        </el-tabs>
      </div>
    </div>
  </div>
@endsection
