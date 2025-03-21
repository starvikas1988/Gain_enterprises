@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Customer Detail</li>
                </ol>
            </div>
            <h4 class="page-title">Customer Detail</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    
                   
                    <div class="col-xl-3">
                        
                    </div><!-- end col-->
                </div>
               
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Details</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
							<tr>
								<th width="30%">Name</th>
								<td width="70%">{{ $user['name'] }}</td>
							</tr>
							
							<tr>
								<th width="30%">Mobile</th>
								<td width="70%">{{ $user['mobile'] }}</td>
							</tr>
							<tr>
								<th width="30%">Email</th>
								<td width="70%">{{ $user['email'] }}</td>
							</tr>
							<tr>
								<th width="30%">Created At </th>
								<td width="70%">{{  date('d-m-Y',strtotime($user['created_at'])) }}</td>
							</tr>
														
							</thead>
						</table>
					</div>

					<div class="box-footer">
						<a href="{{ route('admin.users') }}" type="submit" class="btn btn-default pull-left">Back</a>
					</div>
				</div>
			</div>
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
@endsection