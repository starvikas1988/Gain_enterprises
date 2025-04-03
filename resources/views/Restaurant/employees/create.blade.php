@extends('layouts.restaurant')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Add New Employee</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('restaurant.employees.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Employee Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Employee Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Select Role</label>
            <select class="form-control" id="role" name="role_id" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="permissions" class="form-label">Assign Permissions</label>
            <select class="form-control" id="permissions" name="permissions[]" multiple size="10">
                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- Permission Selection with Checkboxes -->
        {{-- <div class="mb-3">
            <label class="form-label">Assign Permissions</label>
            <div>
                <input type="checkbox" id="select-all"> <label for="select-all"><strong>Select All</strong></label>
            </div>
            @foreach($permissions as $permission)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input permission-checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                    <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div> --}}

        <button type="submit" class="btn btn-success">Create Employee</button>
        <a href="{{ route('restaurant.employees.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<!-- Select All Checkbox Script -->
<script>
    document.getElementById('select-all').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>
@endsection
