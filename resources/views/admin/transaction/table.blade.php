
<div class="table-responsive">
  <!--begin::Table-->
  <table class="table table-centered table-nowrap mb-0">    
      <thead class="table-light">
        <th>Sl No.</th>
        <th>Customer</th>
        <th>Opening</th>
        <th>Credit</th>
        <th>Debit</th>
        <th>Closing</th>
        <th>Message</th>
        <th>Date</th>
    </thead>
    <tbody> 
      @php $serial = $serial[0]; @endphp
      @if($result->isNotEmpty())
        @foreach($result as $key => $row)        
        <tr>
          <td>{{ $serial+$key }}</td>
          <td>{{ $row->customer->name }}<br>{{ $row->customer->user_code }}</td> 
          <td>{{ $row->opening }}</td> 
          <td>{{ $row->credit }}</td> 
          <td>{{ $row->debit }}</td> 
          <td>{{ $row->closing }}</td> 
          <td>{{ $row->message }}</td> 
          <td>{{ $row->created_at }}</td>
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