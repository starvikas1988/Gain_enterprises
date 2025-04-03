@extends('layouts.restaurant')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Employee</h2>

    <form action="{{ route('restaurant.employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Employee Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Employee Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Select Role</label>
            <select class="form-control" id="role" name="role_id" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $role->id == $employeeRole ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="permissions" class="form-label">Assign Permissions</label>
            <select class="form-control" id="permissions" name="permissions[]" multiple size="10">
                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}" {{ in_array($permission->id, $employeePermissions) ? 'selected' : '' }}>{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Update Employee</button>
        <a href="{{ route('restaurant.employees.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
