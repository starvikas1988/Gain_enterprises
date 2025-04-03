@extends('layouts.employee')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('employee.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </div>
            <h4 class="page-title">Change Password</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <p class="text-muted font-14">
                    @include('employee.include.messages')
                </p>
                <div class="tab-content">
					<form action="{{route('employee.passwordchange')}}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12 mb-3">
								<label for="simpleinput" class="form-label">Old Password</label>
								<input type="text" id="simpleinput" name="current_password" class="form-control" autocomplete="current-password">
							</div>   

							<div class="col-md-12 mb-3">
								<label for="example-email" class="form-label">New Password</label>
								<input type="text" id="example-email" name="new_password" class="form-control" autocomplete="current-password">
							</div>    

							<div class="col-md-12 mb-3">
								<label for="example-mobile" class="form-label">Confirm Password</label>
								<input type="text" id="example-mobile" name="new_confirm_password" class="form-control" autocomplete="current-password">
							</div>
						</div>

						<div class="row">
							<div class="col-offset-8 col-md-4">
								<button type="submit" class="btn d-grid btn-primary">SUBMIT</button>
							</div>
						</div>

					</form>                     
                </div> <!-- end tab-content-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->


@endsection
