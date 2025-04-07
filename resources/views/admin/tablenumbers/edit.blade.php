@extends('layouts.admin')

@section('content')
<style>
    .btn-space {
        margin-right: 10px;
    }
</style>
<div class="container">
    <h4>Edit Table Entry</h4>

    <form action="{{ route('admin.table_numbers.update', $table->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="restaurant_id">Restaurant</label>
            <select name="restaurant_id" class="form-control" required>
                @foreach($restaurants as $rest)
                    <option value="{{ $rest->id }}" {{ $rest->id == $table->restaurant_id ? 'selected' : '' }}>
                        {{ $rest->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="table_number">Table Number</label>
            <input type="text" name="table_number" class="form-control" value="{{ $table->table_number }}" required>
        </div>

        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" name="capacity" class="form-control" value="{{ $table->capacity }}">
        </div>

        <div class="form-group">
            <label for="status">Table Status</label>
            <select name="status" class="form-control" required>
                <option value="Available" {{ $table->status == 'Available' ? 'selected' : '' }}>Available</option>
                <option value="Occupied" {{ $table->status == 'Occupied' ? 'selected' : '' }}>Occupied</option>
                <option value="Reserved" {{ $table->status == 'Reserved' ? 'selected' : '' }}>Reserved</option>
            </select>
        </div>
        <div class="d-flex mt-3">
            <a href="{{ route('admin.table_numbers.index') }}" class="btn btn-secondary btn-space">← Back</a>
            <button type="submit" class="btn btn-success">Update Table</button>
        </div>
    </form>
</div>
@endsection
