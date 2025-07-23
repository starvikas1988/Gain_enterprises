<style>
  .btn-sm {
    padding: 4px 8px;
    font-size: 13px;
  }

  .btn-outline-primary:hover,
  .btn-outline-danger:hover,
  .btn-outline-info:hover {
    color: #fff !important;
  }
</style>

<div class="table-responsive">
  <!--begin::Table-->
  <table class="table table-centered table-nowrap mb-0">
    <!--begin::Table head-->
    <thead class="table-light">
      <tr>
        <th>Sl No.</th>
        <th>Route Name</th>
        <th>Driver</th>
        <th>Type</th>
        <th>Stores (Stops)</th>
        <th>Created At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @php $serial = $serial[0]; @endphp
      @if($result->isNotEmpty())
        @foreach($result as $key => $row)
          <tr>
            <td>{{ $serial + $key }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->driver->name ?? 'N/A' }}</td>
            <td>
              @if($row->type === 'linear')
                <span class="badge bg-primary">Linear</span>
              @else
                <span class="badge bg-warning">Circular</span>
              @endif
            </td>
            <td>
              @foreach($row->stores as $store)
                {{ $store->name }}@if (!$loop->last) → @endif
              @endforeach
            </td>
            <td>{{ date('d M, Y H:i:s', strtotime($row->created_at)) }}</td>

            <td class="d-flex gap-2">
              {{-- Edit --}}
              <a href="{{ route('admin.drive_route.edit', ['id' => $row->id]) }}"
                 class="btn btn-sm btn-outline-primary"
                 title="Edit">
                <i class="mdi mdi-pencil"></i>
              </a>

              {{-- View --}}
              <a href="{{ route('admin.drive_route.show', ['id' => $row->id]) }}"
                 class="btn btn-sm btn-outline-info"
                 title="View">
                <i class="mdi mdi-eye"></i>
              </a>

              {{-- Delete --}}
              <a href="{{ route('admin.drive_route.delete', ['id' => $row->id]) }}"
                 class="btn btn-sm btn-outline-danger"
                 title="Delete"
                 onclick="return confirm('Are you sure you want to delete this route?');">
                <i class="mdi mdi-delete"></i>
              </a>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="7">No routes found..</td>
        </tr>
      @endif
    </tbody>
  </table>
  <!--end::Table-->
  <div class="clearfix"><br/></div>
  <div align="left">{!! $result !!}</div>
</div>
