@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="w-50 p-5 bg-white">
        <h1 class="mb-4">Add New Task</h1>

        <form action="{{ route('manager.updateTask',$task->id) }}" method="POST" >
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">Task Title</label>
                <input type="text" class="form-control" value="{{ $task->title }}" name="title" id="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="email">Task Description</label>
                <input type="text" class="form-control" value="{{ $task->description }}" name="description" id="description" placeholder="Description">
            </div>

            <div class="form-group">
                <label for="status_id">Task Status</label>
                <select name="status_id" id="status_id" class="form-control" >
                    @foreach ($statuses as $status )
                        <option @if ($task->status_id == $status->id ) selected  @endif value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="priority_id">Task Priority</label>
                <select name="priority_id" id="priority_id" class="form-control" >
                    @foreach ($priorities as $priority )
                        <option @if ($task->priority_id == $priority->id ) selected  @endif value="{{ $priority->id }}">{{ $priority->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="assigned_user_id">Assign To User</label>
                <select name="assigned_user_id" id="assigned_user_id" class="form-control" >
                    @foreach ($users as $user )
                        <option @if ($task->assigned_user_id == $user->id ) selected  @endif value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" >Update</button>
            </div>

        </form>
    </div>
</div>

@endsection
