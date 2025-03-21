
<div class="table-responsive">
  <!--begin::Table-->
  <table class="table table-centered table-nowrap mb-0">
    <!--begin::Table head-->
    <thead>
      <thead class="table-light">
        <th>Sl No.</th>
        <th>Name</th>
        <th>Slug</th>
		<th>Status</th>
        <th>Update At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody> 
      @php $serial = $serial[0]; @endphp
      @if($result->isNotEmpty())
        @foreach($result as $key => $row)
        
        <tr>
          <td>{{ $serial+$key }}</td> 
          <td>{{ $row->name }}</td> 
          <td>{{ $row->slug }}</td> 
		  <td>{{ $row->status }}</td> 
          <td>{{ DATE("d M, Y", strtotime($row->updated_at)) }}</td>
          <td>
            <a href="{{ route('admin.role.permissionlist',['id'=>$row->id]) }}" title="permission" class="action-icon"><i class="mdi mdi-eye"></i></a> 
            <a href="{{ route('admin.role.edit',['id'=>$row->id]) }}" title="edit" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a> 
            <a href="{{ route('admin.role.delete',['id'=>$row->id]) }}" title="delete" class="action-icon" onclick="return myFunction();"><i class="mdi mdi-trash-can"></i></a> 
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