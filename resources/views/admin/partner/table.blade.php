
<div class="table-responsive">
  <!--begin::Table-->
  <table class="table table-centered mb-0">
    <!--begin::Table head-->
    <thead>
      <thead class="table-light">
        <th>Sl No.</th>
        <th>Name</th>
        <th>Mobile Number</th>
        <th>Email</th>
        <th>Service</th>
        <th>City</th>
        <th>Message</th>
        <th>Status</th>
        <th>Action</th>
    </thead>
    <tbody> 
      @php $serial = $serial[0]; @endphp
      @if($result->isNotEmpty())
        @foreach($result as $key => $row)
             
        <tr>
          <td>{{ $serial+$key }}</td>
          <td>{{ $row->name }}</td> 
          <td>{{ $row->mobile }}</td> 
          <td>{{ $row->email }}</td> 
          <td>{{ $row->service }}</td> 
          <td>{{ $row->city }}</td> 
          <td>{{ $row->message }}</td> 
          <td>{{ $row->status }}</td> 
          <td>
            <a href="{{ route('admin.partnerwithus.edit',['id'=>$row->id]) }}" title="edit" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a> 
			      <a href="{{ route('admin.partnerwithus.delete',['id'=>$row->id]) }}" title="delete" class="action-icon" onclick="return myFunction();"><i class="mdi mdi-trash-can"></i></a>
          </td>
        </tr>
        @endforeach
      @else
        <tr>  
          <td colspan="10">No data found..</td>
        </tr>
      @endif
      
    </tbody>
    <!--end::Table body-->
  </table>
  <!--end::Table-->
  <div class="clearfix"><br/></div>
  <div align="left">{!! $result !!}</div>
</div>