
<div class="table-responsive">
  <!--begin::Table-->
  <table class="table table-centered table-nowrap mb-0">
    <!--begin::Table head-->
    <thead>
      <thead class="table-light">
        <th>Sl No.</th>
        <th>Name</th>    
        <th>Contact</th>
        <th>Wallet</th>
        <th>Status</th>		
        <th>DOJ</th>
        <th>Action</th>
    </thead>
    <tbody> 
      @php $serial = $serial[0]; @endphp
      @if($result->isNotEmpty())
        @foreach($result as $key => $row)
        
      		@php 
            $status = '<span class="badge bg-danger">Active</span>';
            if($row->status == 'D'){
              $status = '<span class="badge bg-danger">De-Active</span>';
            } 
      		@endphp
     
        <tr>
          <td>{{ $serial+$key }}</td>           
          <td>{!! $row->name.'<br/>('.$row->referral_code.')' !!}</td>           
          <td>{!! $row->mobile .'<br/>'. $row->email !!}</td>          
          <td>{!! '<i class="fa fa-inr"></i>'.$row->balance !!}</td> 
          <td>{!! $status !!}</td> 		  
          <td>{{ date('d M,Y H:i:s', strtotime($row->created_at)) }}</td> 
          <td>
            <a href="{{ route('admin.user.edit',['id'=>$row->id]) }}" title="edit" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a> 			
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