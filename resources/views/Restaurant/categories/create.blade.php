@extends('layouts.restaurant')

@section('content')

<div class="container mt-4">
    <div class="mb-4 p-3 bg-light border rounded">
        <h4 class="mb-0">Restaurant: {{ Auth::user()->name }}</h4>
    </div>
    <h2 class="mb-4">Add New Category</h2>

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

    <!-- Add Form -->
    <form method="POST" action="{{ route('restaurant.categories.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="icon" class="form-label">Category Icon (Optional)</label>
            <input type="file" class="form-control" id="icon" name="icon" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="A" {{ old('status') === 'A' ? 'selected' : '' }}>Active</option>
                <option value="D" {{ old('status') === 'D' ? 'selected' : '' }}>Deactivated</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Category</button>
        <a href="{{ route('restaurant.categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script>
     $(document).ready(function () {
            $('#status').select2();
        });
</script>
@endsection
