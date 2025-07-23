@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.trips') }}">Trip</a></li>
                    <li class="breadcrumb-item active">Edit Trip</li>
                </ol>
            </div>
            <h4 class="page-title">Edit Trip</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="text-muted font-14">
                    @include('admin.include.messages')
                </p>

                <div class="tab-content">
                    <form action="{{ route('admin.trip.update', ['id' => $trip->id]) }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="driver_id" class="form-label">Driver</label>
                                <select name="driver_id" class="form-select">
                                    <option value="">Select Driver</option>
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}" {{ old('driver_id', $trip->driver_id) == $driver->id ? 'selected' : '' }}>
                                            {{ $driver->name }} ({{ $driver->phone }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="route_id" class="form-label">Route</label>
                                <select name="route_id" id="route_id" class="form-select">
                                    <option value="">Select Route</option>
                                    @foreach($routes as $route)
                                        <option value="{{ $route->id }}" {{ old('route_id', $trip->route_id) == $route->id ? 'selected' : '' }}>
                                            {{ $route->name }} ({{ ucfirst($route->type) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row" id="store_list_wrapper">
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Stores in Route</label>
                                <ul class="list-group" id="store_list">
                                    @forelse($trip->stores as $index => $store)
                                        <li class="list-group-item">
                                            <strong>Stop {{ $index + 1 }}:</strong> {{ $store->name }}
                                        </li>
                                    @empty
                                        <li class="list-group-item text-muted">No stores assigned.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="offset-md-4 col-md-3">
                                <a href="{{ route('admin.trips') }}" class="btn d-grid btn-secondary">BACK</a>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn d-grid btn-primary">SUBMIT</button>
                            </div>
                        </div>

                    </form>
                </div> <!-- end tab-content-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
@endsection
