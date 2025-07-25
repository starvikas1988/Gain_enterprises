<div class="table-responsive">
    <table class="table table-centered table-nowrap mb-0">
        <thead class="table-light">
            <tr>
                <th>Sl No.</th>
                <th>Driver</th>
                <th>Route</th>
                <th>Status</th>
                <th>Started At</th>
                <th>Completed At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $serial = $serial[0]; @endphp

            @if($result->isNotEmpty())
                @foreach($result as $key => $trip)
                    <tr>
                        <td>{{ $serial + $key }}</td>
                        <td>
                            {{ $trip->driver->name ?? 'N/A' }}<br>
                            <small class="text-muted">{{ $trip->driver->phone ?? '' }}</small>
                        </td>
                        <td>
                            {{ $trip->route->name ?? 'N/A' }}<br>
                            <small class="text-muted">{{ ucfirst($trip->route->type ?? '-') }}</small>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($trip->admin_status) }}</span><br>
                            <small>Driver: <span class="badge bg-secondary">{{ ucfirst($trip->driver_status) }}</span></small>
                        </td>
                        <td>{{ $trip->started_at ? date('d M Y, h:i A', strtotime($trip->started_at)) : '-' }}</td>
                        <td>{{ $trip->completed_at ? date('d M Y, h:i A', strtotime($trip->completed_at)) : '-' }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('admin.trip.show', ['id' => $trip->id]) }}"
                               class="btn btn-sm btn-outline-info"
                               title="View">
                                <i class="mdi mdi-eye"></i>
                            </a>

                            <a href="{{ route('admin.trip.edit', ['id' => $trip->id]) }}"
                               class="btn btn-sm btn-outline-primary"
                               title="Edit">
                                <i class="mdi mdi-pencil"></i>
                            </a>
                            {{-- Manage Timings --}}
                            <a href="{{ route('admin.trip.manage', ['id' => $trip->id]) }}"
                            class="btn btn-sm btn-outline-warning"
                            title="Manage Timings">
                                <i class="mdi mdi-clock-outline"></i>
                            </a>

                            {{-- Admin Status Toggle --}}
                        <form action="{{ route('admin.trip.toggle_admin_status', ['id' => $trip->id]) }}" method="POST" onsubmit="return confirm('Toggle admin status?')">
                            @csrf
                            <button type="submit"
                                class="btn btn-sm {{ $trip->admin_status === 'completed' ? 'btn-danger' : 'btn-success' }}"
                                title="{{ $trip->admin_status === 'completed' ? 'Undo Admin Completion' : 'Mark Admin Complete' }}">
                                <i class="mdi mdi-check-circle-outline"></i>
                                {{ $trip->admin_status === 'completed' ? 'Undo Complete' : 'Mark Complete' }}
                            </button>
                        </form>

                        {{-- Driver Status Toggle --}}
                        <form action="{{ route('admin.trip.toggle_driver_status', ['id' => $trip->id]) }}" method="POST" onsubmit="return confirm('Toggle driver confirmation?')">
                            @csrf
                            <button type="submit"
                                class="btn btn-sm {{ $trip->driver_status === 'confirmed' ? 'btn-danger' : 'btn-warning' }}"
                                title="{{ $trip->driver_status === 'confirmed' ? 'Undo Driver Confirm' : 'Confirm as Driver' }}">
                                <i class="mdi mdi-check-circle-outline"></i>
                                {{ $trip->driver_status === 'confirmed' ? 'Undo Confirm' : 'Confirm Driver' }}
                            </button>
                        </form>


                            {{-- @if($trip->admin_status !== 'completed')
                            <form action="{{ route('admin.trip.complete', ['id' => $trip->id]) }}" method="POST" onsubmit="return confirm('Confirm complete this trip?')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" title="Mark Complete">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </button>
                            </form>
                              @else
                            <span class="badge bg-success">Marked Complete</span>
                            @endif

                            @if($trip->driver_status !== 'confirmed')
                            <form action="{{ route('admin.trip.confirm_by_driver', ['id' => $trip->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to confirm this trip as complete?')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning" title="Confirm as Driver">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </button>
                            </form>
                        @else
                            <span class="badge bg-success">Driver Confirmed</span>
                        @endif --}}

                            

                            <a href="{{ route('admin.trip.delete', ['id' => $trip->id]) }}"
                               class="btn btn-sm btn-outline-danger"
                               title="Delete"
                               onclick="return confirm('Are you sure you want to delete this trip?');">
                                <i class="mdi mdi-delete"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center text-muted">No trip records found.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="clearfix mt-3"></div>
    <div align="left">{!! $result->links() !!}</div>
</div>
