@extends('layouts.restaurant')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('restaurant.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">My Profile</li>
                </ol>
            </div>
            <h4 class="page-title">My Profile</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p class="text-muted font-14">
                    @include('restaurant.include.messages')
                </p>

                <div class="tab-content">
                        <form action="{{route('restaurant.updateprofile')}}" method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label for="simpleinput" class="form-label">Name</label>
                                    <input type="text" id="simpleinput" name="name" class="form-control" value="{{$user->name}}">
                                </div>   

                                <div class="col-md-4 mb-3">
                                    <label for="example-email" class="form-label">Email</label>
                                    <input type="email" id="example-email" name="email" class="form-control" value="{{$user->email}}" placeholder="Email" disabled>
                                </div>    

                                <div class="col-md-4 mb-3">
                                    <label for="example-mobile" class="form-label">Mobile</label>
                                    <input type="text" id="example-mobile" name="mobile" class="form-control" value="{{$user->mobile}}" placeholder="Mobile" disabled>
                                </div>    

                                <div class="col-md-12 mb-3">
                                    <label for="example-address" class="form-label">Address</label>
                                    <textarea id="example-address" name="address" class="form-control" placeholder="Address">{{$user->address}}</textarea>
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
