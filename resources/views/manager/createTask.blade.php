@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="w-50 p-5 bg-white">
        <h1 class="mb-4">Add New Task</h1>
        <form action="{{ route('manager.storeTask') }}" method="POST" >
            @csrf
            <div class="form-group">
                <label for="title">Task Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="email">Task Description</label>
                <input type="text" class="form-control" name="description" id="description" placeholder="Description">
            </div>

            <div class="form-group">
                <label for="priority_id">Task Priority</label>
                <select name="Priority_id" id="priority_id" class="form-control" >
                    @foreach ($priorities as $priority )
                        <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="assigned_user_id">Assign To User</label>
                <select name="assigned_user_id" id="assigned_user_id" class="form-control" >
                    @foreach ($users as $user )
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" >Create New Task</button>
            </div>

        </form>
    </div>
</div>

@endsection
