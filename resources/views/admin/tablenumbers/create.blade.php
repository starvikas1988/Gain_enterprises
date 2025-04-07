@extends('layouts.admin')

@section('content')
<style>
    .btn-space {
        margin-right: 10px;
    }
</style>
<div class="container">
    <h4>Assign Table to Restaurant</h4>

    <form action="{{ route('admin.table_numbers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="restaurant_id">Restaurant</label>
            <select name="restaurant_id" class="form-control" required>
                <option value="">-- Select Restaurant --</option>
                @foreach($restaurants as $rest)
                    <option value="{{ $rest->id }}">{{ $rest->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="table_number">Table Number</label>
            <input type="text" name="table_number" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="capacity">Capacity (optional)</label>
            <input type="number" name="capacity" class="form-control">
        </div>

        <div class="form-group">
            <label for="status">Table Status</label>
            <select name="status" class="form-control" required>
                <option value="Available">Available</option>
                <option value="Occupied">Occupied</option>
                <option value="Reserved">Reserved</option>
            </select>
        </div>

        <div class="d-flex mt-3">
            <a href="{{ route('admin.table_numbers.index') }}" class="btn btn-secondary btn-space">← Back</a>
            <button type="submit" class="btn btn-success">Assign Table</button>
        </div>
      
    </form>
</div>
@endsection
