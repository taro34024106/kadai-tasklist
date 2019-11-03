@extends('layouts.app')

@section('content')

    <h1>id: {{ $task->id }} のタスク内容編集ページ</h1>
    
    <div class="row">
        <div class="col-12">
            {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method'=> 'put']) !!}
                
                <div class="from-group">
                    {!! Form::label('status','ステータス:') !!}
                    {!! Form::text('status', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('content', '内容:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('更新',['class' => 'btn btn-primary']) !!}
            
            {!! Form::close() !!}
        </div>
    </div>

@endsection