@extends('layouts.admin')

@section('content')
<div class="container">
    <h4>All Table Numbers</h4>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.table_numbers.create') }}" class="btn btn-success mb-3">+ Add New Table</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Table Number</th>
                <th>Capacity</th>
                <th>Status</th>
                <th>Restaurant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tableNumbers as $table)
                <tr>
                    <td>{{ $table->id }}</td>
                    <td>{{ $table->table_number }}</td>
                    <td>{{ $table->capacity }}</td>
                    <td>{{ $table->status }}</td>
                    <td>{{ $table->restaurant->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.table_numbers.edit', $table->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <a href="{{ route('admin.table_numbers.delete', $table->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No table entries found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $tableNumbers->links() }}
    </div>
</div>
@endsection
