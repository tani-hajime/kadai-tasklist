@extends('layouts.app')

@section('content')


    @if (Auth::check())
        <h1>タスクリスト一覧</h1>
        @if (count($task) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>ステータス</th>
                        <th>タスク内容</th>
                        <th>user_id</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($task as $task)
                    <tr>
                        {{-- メッセージ詳細ページへのリンク --}}
                        <td>{!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->content }}</td>
                        <td>{{ $task->user_id }}</td><br>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    
    
        {{-- メッセージ作成ページへのリンク --}}
        {!! link_to_route('tasks.create',
        '新規タスクの投稿', [], 
        ['class' => 'btn btn-primary']) 
        !!}
        
    @else
    
    
      <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the Microposts</h1>
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
        
    <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}</li>
        
    @endif

    

@endsection