<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>ステータス</th>
            <th>タスク</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td>{!! link_to_route('tasks.show', '詳細', ['id' => $task->id]) !!}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->content }}</td>
            </tr>
        @endforeach
    </tbody>
</table>