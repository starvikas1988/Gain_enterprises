@extends('layouts.employee') {{-- Change layout to employee panel --}}

@section('content')

<!-- Start Page Title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('employee.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">My Profile</li>
                </ol>
            </div>
            <h4 class="page-title">My Profile</h4>
        </div>
    </div>
</div>
<!-- End Page Title -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p class="text-muted font-14">
                    @include('employee.include.messages') {{-- Use employee messages include --}}
                </p>

                <div class="tab-content">
                    <form action="{{route('employee.updateprofile')}}" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ Auth::guard('employee')->user()->name }}">
                            </div>   

                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ Auth::guard('employee')->user()->email }}" disabled>
                            </div>    

                            <div class="col-md-4 mb-3">
                                <label for="mobile" class="form-label">Mobile</label>
                                <input type="text" id="mobile" name="mobile" class="form-control" value="{{ Auth::guard('employee')->user()->mobile }}" disabled>
                            </div>    

                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea id="address" name="address" class="form-control" placeholder="Address">{{ Auth::guard('employee')->user()->address }}</textarea>
                            </div>                              

                        </div>

                        <div class="row">
                            <div class="col-offset-8 col-md-4">
                                <button type="submit" class="btn d-grid btn-primary">SUBMIT</button>
                            </div>
                        </div>

                    </form>                     
                </div> <!-- End preview -->
            </div> <!-- End card-body -->
        </div> <!-- End card -->
    </div><!-- End col -->
</div><!-- End row -->

@endsection
