@extends('layouts.app')

@section('content')
    @if (Auth::check())
        {{ Auth::user()->name }}<p>でログイン中です。</p>
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
