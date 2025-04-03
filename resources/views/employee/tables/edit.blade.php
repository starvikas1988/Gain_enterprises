@extends('layouts.employee')

@section('content')

<div class="container mt-4">
    <div class="mb-4 p-3 bg-light border rounded">
        <h4 class="mb-0">Restaurant: {{ Auth::guard('employee')->user()->restaurant->name }}</h4>
    </div>
    <h2 class="mb-4">Edit Table</h2>

    <!-- Back to Table Management -->
    <a href="{{ route('employee.tables.index') }}" class="btn btn-secondary mb-3">Back to Table Management</a>

    <!-- Table Edit Form -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('employee.tables.update', $table->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Table Number -->
                <div class="mb-3">
                    <label for="table_number" class="form-label">Table Number</label>
                    <input type="text" id="table_number" name="table_number" class="form-control" 
                           value="{{ old('table_number', $table->table_number) }}" required>
                    @error('table_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Capacity -->
                <div class="mb-3">
                    <label for="capacity" class="form-label">Capacity</label>
                    <input type="number" id="capacity" name="capacity" class="form-control" 
                           value="{{ old('capacity', $table->capacity) }}" min="1" required>
                    @error('capacity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="Available" {{ $table->status == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Occupied" {{ $table->status == 'Occupied' ? 'selected' : '' }}>Occupied</option>
                        <option value="Reserved" {{ $table->status == 'Reserved' ? 'selected' : '' }}>Reserved</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-success">Update Table</button>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#status').select2(); // If using Select2
});
</script>

@endsection
