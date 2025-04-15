@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Add Attendance</li>
                </ol>
            </div>
            <h4 class="page-title">Add Attendance</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                @include('admin.include.messages')

                <form action="{{ route('admin.attendance.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Select Employee</label>
                        <select class="form-select" name="employee_id" id="employee_id">
                            <option value="">Select Employee</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="login_time" class="form-label">Login Time</label>
                        <input type="datetime-local" class="form-control" name="login_time" id="login_time" required>
                    </div>

                    <div class="mb-3">
                        <label for="logout_time" class="form-label">Logout Time (Optional)</label>
                        <input type="datetime-local" class="form-control" name="logout_time" id="logout_time">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
