@extends('layouts.restaurant')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Employee Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('restaurant.employees.create') }}" class="btn btn-primary mb-3">Add Employee</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
               // dd($employees->toArray()); // Debugging line to check the structure of $employees
            @endphp
            @forelse($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->role_name ?? 'N/A' }}</td>
                <td>
                    @php
                        // Fetch permissions using the correct table
                        $permissions = DB::table('roles_permissions')
                            ->join('permissions', 'roles_permissions.permission_id', '=', 'permissions.id')
                            ->where('roles_permissions.role_id', $employee->role_id)
                            ->pluck('permissions.name')->toArray();

                    @endphp
                    @if(!empty($permissions))
                    <ul>
                        @foreach($permissions as $permission)
                            <li>{{ $permission }}</li>
                        @endforeach
                    </ul>
                @else
                    No Permissions
                @endif
                </td>
                <td>
                    <a href="{{ route('restaurant.employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('restaurant.employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No Employees Found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $employees->links() }}
</div>
@endsection
