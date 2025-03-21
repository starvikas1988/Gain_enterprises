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
                    <li class="breadcrumb-item active">Edit Customer</li>
                </ol>
            </div>
            <h4 class="page-title">Edit Customer</h4>
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
                        <form accept="{{route('admin.user.update',['id'=>$user[0]->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="simpleinput" class="form-label">Name</label>
                                    <input type="text" id="simpleinput" name="name" value="{{old('name', $user[0]->name)}}" class="form-control" placeholder="Name">
                                </div>                       
								<div class="col-md-4 mb-3">
                                    <label for="simpleinput" class="form-label">Email</label>
                                    <input type="email" id="simpleinput" name="email" value="{{old('email', $user[0]->email)}}" class="form-control" placeholder="Email">
                                </div>  
								<div class="col-md-4 mb-3">
                                    <label for="simpleinput" class="form-label">Mobile Number</label>
                                    <input type="text" id="simpleinput" name="mobile" value="{{old('mobile', $user[0]->mobile)}}" class="form-control inputnum" placeholder="Mobile Number">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="simpleinput" class="form-label">Balance</label>
                                    <input type="text" id="simpleinput" name="mobile" value="{{old('balance', $user[0]->balance)}}" class="form-control inputnum" disabled placeholder="Balance">
                                </div>

								<div class="col-md-4 mb-3">
                                    <label for="status" class="form-label">Status</label>
									<select class="form-select" name="status">
										<option value="A" {{ ('A'==$user[0]->status?'selected':'')}}>Active</option>
										<option value="D" {{ ('D'==$user[0]->status?'selected':'')}}>De-active</option>
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
