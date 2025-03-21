@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.customersettlements')}}">Settlements</a></li>
                    <li class="breadcrumb-item active">Customer Settlement</li>
                </ol>
            </div>
            <h4 class="page-title">Customer Settlement</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="text-muted font-14">
                    @include('admin.include.messages')
                </p>

                <div class="tab-content">
                        <form accept="{{route('admin.customersettlement.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label for="simpleinput1" class="form-label">Name</label>
                                    <select class="form-select livecustomer" name="id" id="liveUser" required>
                                        <option value="">Select Customer</option>
                                    </select>
                                </div>   
								
								<div class="col-md-4 mb-3">
                                    <label for="simpleinput1" class="form-label">Select Wallet Type</label>
                                    <select class="form-select" id="wallet_type" name="wallet_type" required>
                                        <option value="">Select Wallet Type</option>
                                        <option value="Main">Main Wallet</option>
										<option value="Daily">Daily Wallet</option>
                                        <option value="Monthly">Income Wallet</option>
                                    </select>
                                </div>
								
								<div class="col-md-4 mb-3">
                                    <label for="email" class="form-label">Current Balance</label>
                                    <input type="text" id="currentbalance" class="form-control" placeholder="0" readonly>
                                </div>   
                                
								<div class="col-md-4 mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="text" id="amount" name="amount" value="{{old('amount')}}" class="form-control inputnum" placeholder="Amount">
                                </div>   
                                
								<div class="col-md-4 mb-3">
                                    <label for="txn_date" class="form-label">Request Date</label>
                                    <input type="date" id="txn_date" name="txn_date" value="{{old('txn_date')}}" class="form-control" placeholder="Request Date">
                                </div>  
                                
                                <div class="col-md-4 mb-3">
                                    <label for="simpleinput1" class="form-label">Select Transaction Type</label>
                                    <select class="form-select" id="txn_type" name="txn_type" required>
                                        <option value="">Select Transaction Type</option>
                                        <option value="Credit" selected>Credit</option>
                                        <option value="Debit">Debit</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="paymenttype" class="form-label">Select Payment Type</label>
                                    <select class="form-select" id="paymenttype" name="paymenttype" required>
                                        <option value="">Select Payment Type</option>
                                        <option value="Cash" selected>Cash</option>
                                        <option value="Online">Online</option>
                                        <option value="UPI">UPI</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-8 mb-3">
                                    <label for="message" class="form-label">Message </label>
                                    <textarea id="message" name="message" class="form-control" placeholder="Message">{{old('message')}}</textarea>
                                </div> 
								  
								
                            </div>

                            <div class="row">
                                <div class="col-offset-8 col-md-4">
                                    <button type="submit" class="btn d-grid btn-primary">SUBMIT</button>
                                </div>
                            </div>

                        </form>                     
                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#wallet_type').change(function(){
	var walletType = $(this).val();
	var user = $('#liveUser').find(":selected").val();
	if(walletType.length>0)
	{
		if(user.length>0)
		{
			$.ajax({
			url:'{{ route("balanceByWalletType") }}',
			type: 'POST',
			dataType: 'HTML',
			data: {id:user,walletType:walletType},
			success: function(resp){
				$('#currentbalance').val(resp);
			}
		});
		}
		else
		{
			alert('Select user first to fetch balance!');
			$("#wallet_type").val('');
			$('#currentbalance').val(0);
		}			
	}
	else
	{
		alert('Select wallet type first!');	
		$("#wallet_type").val('');
		$('#currentbalance').val(0);
	}		
});
</script>
@endsection


