@extends('layouts.app')

@section('content')
    @if (Auth::check())
  
      <h1>id = {{ $task->id}} のタスク内容ページ </h1>
  
      <table class="table table-bordered">
          @if (Auth::id() == $user->id)
             <tr>
                <th>id</th>
                <td>{{ $task->id }}</td>
             </tr>
             <tr>
                <th>ステータス</th>
                <td>{{ $task->status }}</td>
             </tr>
             <tr>
                <th>内容</th>
                <td>{{ $task->content }}</td>
             </tr>
          @endif
           
      </table>
  
  {!! link_to_route('tasks.edit', 'タスク内容を編集', ['id' => $task->id], ['class' => 'btn btn-light']) !!}
      
      @if (Auth::id() === $user->id)
          {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
             {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}
      @endif
         
    @endif
@endsection