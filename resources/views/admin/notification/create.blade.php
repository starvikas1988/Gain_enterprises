@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.notifications')}}">Notifications</a></li>
                    <li class="breadcrumb-item active">Add Notification</li>
                </ol>
            </div>
            <h4 class="page-title">Add Notification</h4>
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
                        <form accept="{{route('admin.notification.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
								
								<div class="col-md-6 mb-3">
                                    <label for="simpleinput" class="form-label">Member Type</label>
									<select class="form-select" name="membertype" id="membertype"> 
										<option value="Customer" selected>Customer</option>
										<option value="All">All</option>
									</select>
                                </div>
								
								<div class="col-md-6 mb-3 suser">
                                    <label for="simpleinput" class="form-label">Select Customer</label>
									<select class="form-select livecustomer" multiple="" name="suser[]">
										<option value="">Select Customer</option>
									</select>
                                </div>
								
								<div class="col-md-6 mb-3 svendor" style="display:none;">
                                    <label for="simpleinput" class="form-label">Select Vendor</label>
									<select class="form-select livevendor" multiple="" name="svendor[]">
										<option value="">Select Vendor</option>
									</select>
                                </div>

                               <div class="col-md-6 mb-3">
                                    <label for="simpleinput" class="form-label">Title</label>
									<input type="text" id="simpleinput" name="title" value="{{old('title')}}" class="form-control" placeholder="Title" required>
                                </div>

								<div class="col-md-6 mb-3">
                                    <label for="imgInp" class="form-label">Image</label>
                                    <input type="file" id="imgInp" name="userfile" class="form-control" >
									<div class=""><img id="blah" width="200" /></div>
                                </div> 
								
								<div class="col-md-12 mb-3">
                                    <label for="simpleinput" class="form-label">Message</label>
									<textarea rows="4" name="message" class="form-control"  required></textarea>
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
$('select[name=membertype]').change(function(){
	if(this.value=='Customer'){
		$('.suser').show();
		$('.svendor').hide();
	} else {
		$('.suser').hide();
		$('.svendor').hide();
	}
});
</script>
@endsection