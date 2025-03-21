
<div class="table-responsive">
  <!--begin::Table-->
  <table class="table table-centered mb-0">
    <!--begin::Table head-->
    <thead>
      <thead class="table-light">
        <th>Sl No.</th>
        <th>Type</th>
        <th>Title</th>
        <th>Message</th>
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
    </thead>
    <tbody> 
      @php $serial = $serial[0]; @endphp
      @if($result->isNotEmpty())
        @foreach($result as $key => $row)        
        <tr>
          <td>{{ $serial+$key }}</td>
          <td>@if($row->notification_type=='Customer') {!! '<span class="badge bg-success">'.$row->notification_type.'</span>' !!} @else {!! '<span class="badge bg-primary">'.$row->notification_type.'</span>' !!} @endif</td> 
          <td>{{ $row->title }}</td> 
          <td>{{ $row->message }}</td>
		  <td>
			  @if($row->image)
			  	<img src="{!! asset($row->image) !!}" width="35" />
			  @endif
		  </td> 
          <td>{{ $row->status }}</td> 
          <td>
			 <a href="{{ route('admin.notification.delete',['id'=>$row->id]) }}" title="delete" onclick="return myFunction();" data-confirm="Are you sure to delete this item?" class="action-icon"><i class="mdi mdi-trash-can"></i></a>
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