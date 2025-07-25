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
                    <li class="breadcrumb-item active">Manage Timing</li>
                </ol>
            </div>
            <h4 class="page-title">Manage Trip Timing</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="text-muted font-14">@include('admin.include.messages')</p>

                <div class="mb-4">
                    <strong>Driver:</strong> {{ $trip->driver->name ?? 'N/A' }} ({{ $trip->driver->phone ?? '' }})<br>
                    <strong>Route:</strong> {{ $trip->route->name ?? 'N/A' }} ({{ ucfirst($trip->route->type ?? '') }})<br>
                    <strong>Status:</strong> 
                        <span class="badge bg-info">{{ ucfirst($trip->admin_status) }}</span>
                        <small class="ms-2">Driver: <span class="badge bg-secondary">{{ ucfirst($trip->driver_status) }}</span></small>
                </div>

                <form action="{{ route('admin.trip.save_timings', ['id' => $trip->id]) }}" method="POST">
                    @csrf

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
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
                                        <td>
                                            {{ $store->name }}
                                            <input type="hidden" name="store_ids[]" value="{{ $store->id }}">
                                        </td>
                                        <td>
                                            <input type="datetime-local" name="arrival_time[{{ $store->id }}]" 
                                                   value="{{ old('arrival_time.' . $store->id, optional($store->pivot->arrival_time)->format('Y-m-d\TH:i')) }}"
                                                   class="form-control" />
                                        </td>
                                        <td>
                                            <input type="datetime-local" name="load_time[{{ $store->id }}]" 
                                                   value="{{ old('load_time.' . $store->id, optional($store->pivot->load_time)->format('Y-m-d\TH:i')) }}"
                                                   class="form-control" />
                                        </td>
                                        <td>
                                            <input type="datetime-local" name="departure_time[{{ $store->id }}]" 
                                                   value="{{ old('departure_time.' . $store->id, optional($store->pivot->departure_time)->format('Y-m-d\TH:i')) }}"
                                                   class="form-control" />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No stores found in this trip.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-4">
                        <div class="offset-md-6 col-md-3">
                            <a href="{{ route('admin.trips') }}" class="btn btn-secondary d-grid">BACK</a>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary d-grid">SAVE TIMINGS</button>
                        </div>
                    </div>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
@endsection
