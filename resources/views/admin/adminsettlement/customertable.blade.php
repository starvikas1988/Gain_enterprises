
<div class="table-responsive">
  <!--begin::Table-->
  <table class="table table-centered table-nowrap mb-0">    
      <thead class="table-light">
        <th>Sl No.</th>
        <th>Customer</th>
		<th>Wallet Type</th>
        <th>Txn Type</th>
        <th>Amount</th>
        <th>Date</th>
        <th>Message</th>
        <th>Payment Type</th>
        <th>Created At</th>
    </thead>
    <tbody> 
      @php $serial = $serial[0]; @endphp
      @if($result->isNotEmpty())
        @foreach($result as $key => $row)        
        <tr>
          <td>{{ $serial+$key }}</td>
          <td>{{ $row->customer->name }}<br>{{ $row->customer->email }}</td>  
		  <td>{{ $row->wallet_type }}</td> 
          <td>{{ $row->txn_type }}</td> 
          <td>{{ $row->amount }}</td> 
          <td>{{ $row->txn_date }}</td> 
          <td>{{ $row->message }}</td> 
          <td>{{ $row->payment_type }}</td>
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