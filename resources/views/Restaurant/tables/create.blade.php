@extends('layouts.restaurant')

@section('content')

<div class="container mt-4">
    <div class="mb-4 p-3 bg-light border rounded">
        <h4 class="mb-0">Restaurant: {{ Auth::user()->name }}</h4>
    </div>
    <h2 class="mb-4">Add New Table</h2>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Add Table Form -->
    <form method="POST" action="{{ route('restaurant.tables.store') }}">
        @csrf

        <div class="mb-3">
            <label for="table_number" class="form-label">Table Number</label>
            <input type="text" class="form-control" id="table_number" name="table_number" value="{{ old('table_number') }}" required>
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">Capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity') }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="Available">Available</option>
                <option value="Occupied">Occupied</option>
                <option value="Reserved">Reserved</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Add Table</button>
        <a href="{{ route('restaurant.tables.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script>
    $(document).ready(function () {
           $('#status').select2();
       });
</script>
@endsection
