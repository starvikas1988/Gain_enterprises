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
                    <li class="breadcrumb-item active">Add Trip</li>
                </ol>
            </div>
            <h4 class="page-title">Add Trip</h4>
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
                    <form action="{{ route('admin.trip.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="driver_id" class="form-label">Driver</label>
                                <select name="driver_id" id="driver_id" class="form-select">
                                    <option value="">Select Driver</option>
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
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
                                        <option value="{{ $route->id }}" {{ old('route_id') == $route->id ? 'selected' : '' }}>
                                            {{ $route->name }} ({{ ucfirst($route->type) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row" id="store_list_wrapper">
                            <div class="col-12">
                                <label class="form-label fw-bold">Stores in Route</label>
                                <ul class="list-group" id="store_list">
                                    {{-- Populated dynamically based on selected route --}}
                                </ul>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="offset-md-8 col-md-4">
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

@section('script')
<script>
    let routeData = @json($routes->keyBy('id'));

    $('#route_id').change(function () {
        const selectedRouteId = $(this).val();
        const storeListEl = $('#store_list');
        storeListEl.empty();

        if (selectedRouteId && routeData[selectedRouteId]) {
            const stores = routeData[selectedRouteId].stores;

            if (stores.length > 0) {
                stores.forEach((store, index) => {
                    storeListEl.append(`
                        <li class="list-group-item">
                            <strong>Stop ${index + 1}:</strong> ${store.name}
                        </li>
                    `);
                });
            } else {
                storeListEl.append('<li class="list-group-item text-muted">No stores defined in route.</li>');
            }
        }
    });

    // Trigger change on load if old route_id is set
    @if(old('route_id'))
        $('#route_id').trigger('change');
    @endif
</script>
@endsection
