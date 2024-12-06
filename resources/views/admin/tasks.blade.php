@extends('layouts.app')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center vh-50 px-5 pt-5">
    <table class="table table-hover bg-white shadow-sm">
        <thead>
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">Task Title</th>
                <th class="text-center" scope="col">Task Description</th>
                <th class="text-center" scope="col">Task Status</th>
                <th class="text-center" scope="col">Task Priority</th>
                <th class="text-center" scope="col">Created By</th>
                <th class="text-center" scope="col">Assigned To</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allTasks as $key => $task)
                <tr class="text-center">
                    <td scope="row">{{ $key + 1 }}</td>
                    <td>{{ $task->title }}</td>
                    <td class="text-truncate" style="max-width: 150px;">{{ $task->description }}</td>
                    <td>{{ $task->status->name }}</td>
                    <td>{{ $task->priority->name }}</td>
                    <td>{{ $task->createdBy->email }}</td>
                    <td>{{ $task->user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
