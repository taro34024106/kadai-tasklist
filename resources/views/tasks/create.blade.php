@extends('layouts.app')

@section('content')

    <h1>タスク作成ページ</h1>
    
    <div class="row">
        <div class="col-12">
            @if (Auth::id() == $user->id)
            {!! Form::open( ['route' => 'tasks.store']) !!}
            
               <div class="form-group">
                   {!! Form::label('status','ステータス') !!}
                   {!! Form::text('status', old('status'), ['class' => 'form-control']) !!}
               </div>
               <div class="form-group">
                   {!! Form::label('content', '内容:') !!}
                   {!! Form::text('content', old('content'), ['class' => 'form-control']) !!}
               </div>
               
            
               {!! Form::submit('作成', ['class' => 'btn btn-primary']) !!}
               
            {!! Form::close() !!}
            @endif
        </div>
    </div>
@endsection