@extends('layouts.app')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center vh-50 px-5 pt-5">
    <table class="table table-hover bg-white shadow-sm">
        <thead>
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">User Name</th>
                <th class="text-center" scope="col">User Email</th>
                <th class="text-center" scope="col">Task Efficiency</th>
                <th class="text-center" scope="col">Task Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allUsers as $key => $User)
                {{-- @dd($allUsers) --}}
                <tr class="text-center">
                    <td scope="row">{{ $key + 1 }}</td>
                    <td>{{ $User->name }}</td>
                    <td class="text-truncate" style="max-width: 150px;">{{ $User->email }}</td>
                    <td>{{ $User->taskEfficiency }}%</td>
                    <td>{{ $User->allTaskCount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
