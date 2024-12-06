@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="w-50 p-5 bg-white">
        <h1 class="mb-4">Add New Admin</h1>
        <form action="{{ route('admin.storeAdmin') }}" method="POST" >
            @csrf
            <div class="form-group">
                <label for="name">Admin Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="email">Admin Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="password">Admin Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" >submit</button>
            </div>

        </form>
    </div>
</div>

@endsection
