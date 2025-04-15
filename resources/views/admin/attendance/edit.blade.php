@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Edit Attendance</li>
                </ol>
            </div>
            <h4 class="page-title">Edit Attendance</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                @include('admin.include.messages')

                <form action="{{ route('admin.attendance.update', $attendance->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Select Employee</label>
                        <select class="form-select" name="employee_id" id="employee_id" disabled>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ $emp->id == $attendance->employee_id ? 'selected' : '' }}>{{ $emp->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="login_time" class="form-label">Login Time</label>
                        <input type="datetime-local" class="form-control" name="login_time" id="login_time" value="{{ \Carbon\Carbon::parse($attendance->login_time)->format('Y-m-d\TH:i') }}">
                    </div>

                    <div class="mb-3">
                        <label for="logout_time" class="form-label">Logout Time</label>
                        <input type="datetime-local" class="form-control" name="logout_time" id="logout_time" value="{{ $attendance->logout_time ? \Carbon\Carbon::parse($attendance->logout_time)->format('Y-m-d\TH:i') : '' }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">Back</a>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
