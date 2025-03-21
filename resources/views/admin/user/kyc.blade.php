@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.users')}}">Customer</a></li>
                    <li class="breadcrumb-item active">Update Kyc</li>
                </ol>
            </div>
            <h4 class="page-title">Update Kyc</h4>
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
                        <form accept="{{route('admin.user.kyc.update',['id'=>$user[0]->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="simpleinput" class="form-label">Id Proof</label>
                                    <input type="text" id="simpleinput" name="idtext" value="{{old('idtext', $user[0]->id_proof_text)}}" class="form-control" placeholder="Id Proof">
                                </div>  
								<div class="col-md-6 mb-3">
                                    <label for="simpleinput" class="form-label">Id Proof File</label>
									@if($user[0]->id_proof_file)
										<a href="{{asset($user[0]->id_proof_file)}}" target="_blank" class="btn btn-success">Open file to click here</a>
									@else
									<p class="text-danger">File not found</p>
									@endif
                                </div>  
								<div class="col-md-6 mb-3">
                                    <label for="simpleinput" class="form-label">Address Proof</label>
                                    <input type="text" id="simpleinput" name="addresstext" value="{{old('addresstext', $user[0]->address_proof_text)}}" class="form-control" placeholder="Address Proof">
                                </div> 
								<div class="col-md-6 mb-3">
                                    <label for="simpleinput" class="form-label">Address Proof File</label>
                                    @if($user[0]->address_proof_file)
										<a href="{{asset($user[0]->address_proof_file)}}" target="_blank" class="btn btn-success">Open file to click here</a>
									@else
									<p class="text-danger">File not found</p>
									@endif
                                </div> 

								<div class="col-md-4 mb-3">
                                    <label for="status" class="form-label">Status</label>
									<select class="form-select" name="status">
										<option value="">Select Status</option>
										<option value="Pending" {{ ('Pending'==$user[0]->status?'selected':'')}}>Pending</option>
										<option value="Approved" {{ ('Approved'==$user[0]->status?'selected':'')}}>Approve</option>
										<option value="Rejected" {{ ('Rejected'==$user[0]->status?'selected':'')}}>Reject</option>
									</select>
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
