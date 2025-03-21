@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ol>
            </div>
            <h4 class="page-title">Edit User</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <p class="text-muted font-14">
                    @include('admin.include.messages')
                </p>

                <div class="tab-content">
                        <form accept="{{route('admin.admin.update',['id'=>$admin[0]->id])}}" method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="simpleinput" class="form-label">Name</label>
                                    <input type="text" id="simpleinput" name="name" value="{{old('name', $admin[0]->name)}}" class="form-control" placeholder="Name">
                                </div>   

                                <div class="col-md-6 mb-3">
                                    <label for="example-email" class="form-label">Email</label>
                                    <input type="email" name="email" id="example-email" class="form-control" value="{{old('email', $admin[0]->email)}}" placeholder="Email">
                                </div>    

                                <div class="col-md-6 mb-3">
                                    <label for="example-mobile" class="form-label">Mobile</label>
                                    <input type="text" id="example-mobile" name="mobile" class="form-control" value="{{old('mobile', $admin[0]->mobile)}}" placeholder="Mobile">
                                </div>    

                                <div class="col-md-6 mb-3">
                                    <label for="example-city" class="form-label">Role</label>
                                    <select class="form-select select2" data-toggle="select2" name="role[]" data-placeholder="Choose ...">
                                        <option value="">Select Role</option>
                                        @if($role->isNotEmpty())
                                            @foreach($role as $roles)
                                                <option value="{{$roles->id}}" {{ (in_array($roles->id,explode(',',$adminrole[0]->role_id))?'selected':'') }} >{{$roles->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>     

                                <div class="col-md-6 mb-3">
                                    <label for="example-city" class="form-label">Status</label>
                                    <select class="form-select" name="status" >
                                        <option value="">Select Status</option>
                                        <option value="A" {{ ($admin[0]->row_status=='A'?'selected':'') }}>Active</option>
                                        <option value="D" {{ ($admin[0]->row_status=='D'?'selected':'') }}>Deactive</option>
                                    </select>
                                </div>   

                                <div class="col-md-12 mb-3">
                                    <label for="example-address" class="form-label">Address</label>
                                    <textarea id="example-address" name="address" class="form-control" placeholder="Address">{{old('address', $admin[0]->address)}}</textarea>
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
