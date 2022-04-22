@extends('layouts.app')

@section('content')

    <h1>タスクリスト一覧</h1>

    @if (count($task) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ステータス</th>
                    <th>タスク内容</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($task as $task)
                <tr>
                    {{-- メッセージ詳細ページへのリンク --}}
                    <td>{!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->content }}</td><br>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    
    {{-- メッセージ作成ページへのリンク --}}
    {!! link_to_route('tasks.create',
    '新規メッセージの投稿', [], 
    ['class' => 'btn btn-primary']) 
    !!}
    
    

@endsection