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
        <th>Name</th>
        <th>Contact</th>
        <th>Location</th>
        <th>Status</th>
        <th>Created</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @php $serial = $serial[0]; @endphp
      @if($result->isNotEmpty())
        @foreach($result as $key => $row)
          @php
            $status = '<span class="badge bg-success">Active</span>';
            if ($row->status == 'D') {
              $status = '<span class="badge bg-danger">De-Active</span>';
            }
          @endphp
          <tr>
            <td>{{ $serial + $key }}</td>
            <td>{{ $row->name }}</td>
            <td>{!! $row->phone . '<br/>' . $row->email !!}</td>
            <td>{{ $row->location ?? '-' }}</td>
            <td>{!! $status !!}</td>
            <td>{{ date('d M, Y H:i:s', strtotime($row->created_at)) }}</td>

            <td class="d-flex gap-2">
              {{-- Edit --}}
              <a href="{{ route('admin.store.edit', ['id' => $row->id]) }}"
                 class="btn btn-sm btn-outline-primary"
                 title="Edit">
                <i class="mdi mdi-pencil"></i>
              </a>

              {{-- View --}}
              <a href="{{ route('admin.store.show', ['id' => $row->id]) }}"
                 class="btn btn-sm btn-outline-info"
                 title="View">
                <i class="mdi mdi-eye"></i>
              </a>

              {{-- Delete --}}
              <a href="{{ route('admin.store.delete', ['id' => $row->id]) }}"
                 class="btn btn-sm btn-outline-danger"
                 title="Delete"
                 onclick="return confirm('Are you sure you want to delete this store?');">
                <i class="mdi mdi-delete"></i>
              </a>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="7">No data found..</td>
        </tr>
      @endif
    </tbody>
  </table>
  <!--end::Table-->

  <div class="clearfix"><br/></div>
  <div align="left">{!! $result !!}</div>
</div>
