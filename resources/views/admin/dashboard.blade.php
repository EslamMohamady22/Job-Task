
@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center vh-50 px-5 pt-5">
        <h1 class=" text-center bg-white shadow-sm"> Average task completion time: {{ $averageCompletionTimeFormatted }}</h1>
        <br>

        <div class="row">
            <div class="col-sm-6 col-md-6">
              <div class="card " style="height: 130px">
                <div class="card-body">
                  <h5 class="card-title">Average task completion time</h5>
                  <p class="card-text" style="font-size: 30px ; width: 400px ; text-align: center">{{ $averageCompletionTimeFormatted }}</p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-6 h-50">
              <div class="card " style="height: 130px">
                <div class="card-body">
                  <h5 class="card-title">Task Efficiency</h5>
                  <p class="card-text" style="font-size: 30px ; width: 400px ; text-align: center">{{ $taskEfficiency }}%</p>
                </div>
              </div>
            </div>
          </div>

        <br>

        <table class="table table-hover bg-white shadow-sm">
            <h1>User Count By Role</h1>

            <thead>
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Role Name</th>
                    <th class="text-center" scope="col">All User Count</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 0;
                @endphp
                @foreach ($userCountByRole as $role => $userCount)
                    <tr class="text-center">
                        <td scope="row">{{ ++$index }}</td>
                        <td>{{ $role }}</td>
                        <td class="text-truncate">{{ $userCount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <table class="table table-hover bg-white shadow-sm">
            <h1>Task Count By Status</h1>

            <thead>
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Role Name</th>
                    <th class="text-center" scope="col">All User Count</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 0;
                @endphp
                @foreach ($taskCountByStatus as $status => $taskCountStatus)
                    <tr class="text-center">
                        <td scope="row">{{ ++$index }}</td>
                        <td>{{ $status }}</td>
                        <td class="text-truncate">{{ $taskCountStatus }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <table class="table table-hover bg-white shadow-sm">
            <h1>Task Count By Priority</h1>
            <thead>
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Role Name</th>
                    <th class="text-center" scope="col">All User Count</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 0;
                @endphp
                @foreach ($taskCountByPriority as $priority => $taskCountPriority)
                    <tr class="text-center">
                        <td scope="row">{{ ++$index }}</td>
                        <td>{{ $priority }}</td>
                        <td class="text-truncate">{{ $taskCountPriority }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


