@extends('layouts.app')

@section('content')
    @if (Auth::check())
        
        <!-- ！！！注意！！！　表示されるのはwelcome　！！！注意！！！ -->
        <h1>タスク一覧</h1>

        @if (count($tasks) > 0)
            @include('tasks.tasks', ['tasks' => $tasks])
        @endif
    
        {!! link_to_route('tasks.create', '新規タスクの追加', [], ['class' => 'btn btn-primary']) !!}
    
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Tasklist</h1>
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
                <p class="mt-3">すでに登録されている方は{!! link_to_route('login', 'コチラ') !!}</p>
            </div>
        </div>
    @endif
        
@endsection