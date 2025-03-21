@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.contacts')}}">Partner with Us</a></li>
                    <li class="breadcrumb-item active">Edit Partner with Us</li>
                </ol>
            </div>
            <h4 class="page-title">Edit Partner with Us</h4>
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
                        <form accept="{{route('admin.partnerwithus.update',['id'=>$contact[0]->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
								<div class="col-md-6 mb-3">
                                    <label for="simpleinput1" class="form-label">Name</label>
                                    <input type="text" id="simpleinput1" name="name" value="{{old('name', $contact[0]->name)}}" class="form-control" placeholder="Name">
                                </div>   
								<div class="col-md-6 mb-3">
                                    <label for="simpleinput1" class="form-label">Mobile Number</label>
                                    <input type="text" id="simpleinput1" name="mobile" value="{{old('mobile', $contact[0]->mobile)}}" class="form-control" placeholder="Mobile number">
                                </div>   
								<div class="col-md-6 mb-3">
                                    <label for="simpleinput" class="form-label">Email</label>
                                    <input type="email" id="simpleinput" name="email" value="{{old('email', $contact[0]->email)}}" class="form-control" placeholder="Email">
                                </div>     
                                <div class="col-md-6 mb-3">
                                    <label for="simpleinput1" class="form-label">Pincode</label>
                                    <input type="text" id="simpleinput1" name="pincode" value="{{old('pincode', $contact[0]->pincode)}}" class="form-control" placeholder="Pincode">
                                </div>     
                                <div class="col-md-6 mb-3">
                                    <label for="simpleinput1" class="form-label">City</label>
                                    <input type="text" id="simpleinput1" name="city" value="{{old('city', $contact[0]->city)}}" class="form-control" placeholder="City">
                                </div>     
                                <div class="col-md-6 mb-3">
                                    <label for="simpleinput1" class="form-label">Service</label>
                                    <input type="text" id="simpleinput1" name="service" value="{{old('city', $contact[0]->service)}}" class="form-control" placeholder="Service">
                                </div>
								<div class="col-md-6 mb-3">
                                    <label for="simpleinput" class="form-label">Message</label>
                                    <input type="text" id="simpleinput" name="message" value="{{old('message', $contact[0]->message)}}" class="form-control" placeholder="Message">
                                </div> 
								<div class="col-md-6 mb-3">
                                    <label for="example-city" class="form-label">Status</label>
                                    <select class="form-select" name="status" required>
                                        <option value="Active" {{ ($contact[0]->status=='Active'?'selected':'') }}>Active</option>
                                        <option value="Deactive" {{ ($contact[0]->status=='Deactive'?'selected':'') }}>Deactive</option>
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
