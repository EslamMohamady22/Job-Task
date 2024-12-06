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
                @if (auth()->user()->hasRole('Manager'))
                    <th class="text-center" colspan="2" scope="col">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($managerTasks as $key => $task)
                <tr class="text-center">
                    <td scope="row">{{ $key + 1 }}</td>
                    <td>{{ $task->title }}</td>
                    <td class="text-truncate" style="max-width: 150px;">{{ $task->description }}</td>
                    <td>{{ $task->status->name }}</td>
                    <td>{{ $task->priority->name }}</td>
                    <td>{{ $task->user->email }}</td>
                    @if (auth()->user()->hasRole('Manager'))
                        <td>
                            <a href="{{ route('manager.editTask', $task->id) }}" class="btn btn-success">Edit</a>
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
