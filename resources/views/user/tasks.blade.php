@extends('layouts.app')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center vh-50 px-5 pt-5">
    <a href="{{ route('manager.createTask') }}" class="btn btn-primary px-5 mb-4">Create New Task</a>

    <table class="table table-hover bg-white shadow-sm">
        <thead>
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">Task Title</th>
                <th class="text-center" scope="col">Task Description</th>
                <th class="text-center" scope="col">Task Status</th>
                <th class="text-center" scope="col">Task Priority</th>
                <th class="text-center" scope="col">Assigned To</th>
                @if (auth()->user()->hasRole('User'))
                <th class="text-center" colspan="2" scope="col">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($myTasks as $key => $task)
                <tr class="text-center">
                    <td scope="row">{{ $key + 1 }}</td>
                    <td>{{ $task->title }}</td>
                    <td class="text-truncate" style="max-width: 150px;">{{ $task->description }}</td>
                    <td>{{ $task->status->name }}</td>
                    <td>{{ $task->priority->name }}</td>
                    <td>{{ $task->user->email }}</td>
                    @if (auth()->user()->hasRole('User'))
                    <td>
                        <div class="form-group">
                            <select name="status_id" id="status_id" onchange="updateTask(this, {{ $task->id }})" class="form-control" >
                                @foreach ($statuses as $status )
                                    <option @if ($task->status_id == $status->id ) selected  @endif value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    @endif
                    <td>
                        {{-- Uncomment if delete is needed --}}
                        {{-- <form action="{{ route('manager.deleteTask', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function updateTask(status, taskId) {
        var statusId = status.value;
        // console.log(params.value);
        $.ajax({
            url: `{{ route('user.updateTaskStatus', ['taskId' => '__TASK_ID__', 'statusId' => '__STATUS_ID__']) }}`.replace('__TASK_ID__', taskId).replace('__STATUS_ID__', statusId),
            type: 'GET',
            success: function(data) {
                console.log(data);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
    });
    }

</script>
