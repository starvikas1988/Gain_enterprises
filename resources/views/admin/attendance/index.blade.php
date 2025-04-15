@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Attendance List</li>
                </ol>
            </div>
            <h4 class="page-title">Attendance List</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('admin.include.messages')

                <div class="d-flex justify-content-between mb-3">
                    {{-- <a href="{{ route('admin.attendance.create') }}" class="btn btn-primary">Add Attendance</a> --}}
                    <a href="{{ route('admin.attendance.export') }}" class="btn btn-success">Export Excel</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Login Time</th>
                                <th>Logout Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendances as $key => $attendance)
                                <tr>
                                    <td>{{ $attendances->firstItem() + $key }}</td>
                                    <td>{{ $attendance->employee->name ?? 'N/A' }}</td>
                                    <td>{{ $attendance->login_time }}</td>
                                    <td>{{ $attendance->logout_time ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('admin.attendance.edit', $attendance->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <form action="{{ route('admin.attendance.destroy', $attendance->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this record?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5">No attendance found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $attendances->links() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
