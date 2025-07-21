@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.drivers') }}">Driver</a></li>
                    <li class="breadcrumb-item active">Add Driver</li>
                </ol>
            </div>
            <h4 class="page-title">Add Driver</h4>
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
                    <form action="{{ route('admin.driver.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control inputnum" placeholder="Phone Number">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="license_number" class="form-label">License Number</label>
                                <input type="text" id="license_number" name="license_number" value="{{ old('license_number') }}" class="form-control" placeholder="License Number">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                <input type="text" id="vehicle_type" name="vehicle_type" value="{{ old('vehicle_type') }}" class="form-control" placeholder="Vehicle Type">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea id="address" name="address" class="form-control" rows="2" placeholder="Address">{{ old('address') }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="offset-md-8 col-md-4">
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
