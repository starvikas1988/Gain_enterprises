@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.trips') }}">Trips</a></li>
                    <li class="breadcrumb-item active">Trip Details</li>
                </ol>
            </div>
            <h4 class="page-title">Trip Details</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mb-3">Basic Trip Information</h4>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Driver:</strong><br>
                        {{ $trip->driver->name ?? 'N/A' }}<br>
                        <small class="text-muted">{{ $trip->driver->phone ?? '' }}</small>
                    </div>
                    <div class="col-md-4">
                        <strong>Route:</strong><br>
                        {{ $trip->route->name ?? 'N/A' }} ({{ ucfirst($trip->route->type) }})
                    </div>
                    <div class="col-md-4">
                        <strong>Trip Status:</strong><br>
                        <span class="badge bg-info">{{ ucfirst($trip->admin_status) }}</span>
                        <br>
                        <small>Driver Confirmation: <span class="badge bg-secondary">{{ ucfirst($trip->driver_status) }}</span></small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Started At:</strong><br>
                        {{ $trip->started_at ? date('d M Y, h:i A', strtotime($trip->started_at)) : 'Not started' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Completed At:</strong><br>
                        {{ $trip->completed_at ? date('d M Y, h:i A', strtotime($trip->completed_at)) : 'Not completed' }}
                    </div>
                </div>

                <h4 class="header-title mt-4">Store Visit Details</h4>
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Store</th>
                                <th>Arrival Time</th>
                                <th>Load Time</th>
                                <th>Departure Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($trip->stores as $index => $store)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $store->name }}</td>
                                    <td>{{ $store->pivot->arrival_time ? date('d M Y, h:i A', strtotime($store->pivot->arrival_time)) : '-' }}</td>
                                    <td>{{ $store->pivot->load_time ? date('d M Y, h:i A', strtotime($store->pivot->load_time)) : '-' }}</td>
                                    <td>{{ $store->pivot->departure_time ? date('d M Y, h:i A', strtotime($store->pivot->departure_time)) : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No stores visited.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="{{ route('admin.trips') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
@endsection
