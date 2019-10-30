@extends('layouts.app')

@section('content')

    <h1>id = {{ $task->id }}のメッセージ詳細ページ</h1>
    
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $task->id }}</td>
        </tr>
        <tr>
            <th>タイトル</th>
            <td>{{ $task->status }}</td>
        </tr>
        <tr>
            <th>タスク</th>
            <td>{{ $task->content }}</td>
        </tr>
    </table>
    
    {!! link_to_route('tasks.edit', 'このタスクを編集', ['id' => $task->id], ['class' => 'btn btn-light']) !!}
    
    
    <!-- ['route' => ['tasks.destroy', ...])で指定しているtasksはweb.phpのresourceで指定したtasksなのか？ -->
    {!! Form::model($task, ['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger mt-2']) !!}
    {!! Form::close() !!}

@endsection