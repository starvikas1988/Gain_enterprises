@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Driver Detail</li>
                </ol>
            </div>
            <h4 class="page-title">Driver Detail</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

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
                                            <td width="70%">{{ $driver->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td>{{ $driver->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $driver->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>License Number</th>
                                            <td>{{ $driver->license_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vehicle Type</th>
                                            <td>{{ $driver->vehicle_type }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date of Birth</th>
                                            <td>{{ \Carbon\Carbon::parse($driver->date_of_birth)->format('d-m-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td>{{ $driver->address }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ \Carbon\Carbon::parse($driver->created_at)->format('d-m-Y') }}</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="box-footer">
                                <a href="{{ route('admin.drivers') }}" class="btn btn-default pull-left">Back</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
@endsection
