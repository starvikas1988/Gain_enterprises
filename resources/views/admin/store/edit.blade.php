@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.stores') }}">Store</a></li>
                    <li class="breadcrumb-item active">Edit Store</li>
                </ol>
            </div>
            <h4 class="page-title">Edit Store</h4>
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
                    <form action="{{ route('admin.store.update', ['id' => $store->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Store Name</label>
                                <input type="text" name="name" value="{{ old('name', $store->name) }}" class="form-control" placeholder="Store Name">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email', $store->email) }}" class="form-control" placeholder="Email">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone', $store->phone) }}" class="form-control inputnum" placeholder="Phone Number">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" name="location" value="{{ old('location', $store->location) }}" class="form-control" placeholder="Location">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="A" {{ $store->status == 'A' ? 'selected' : '' }}>Active</option>
                                    <option value="D" {{ $store->status == 'D' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="offset-md-4 col-md-3">
                                <a href="{{ route('admin.stores') }}" class="btn d-grid btn-secondary">BACK</a>
                            </div>
                            <div class="col-md-3">
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
