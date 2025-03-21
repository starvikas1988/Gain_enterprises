@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.roles')}}">Role</a></li>
                    <li class="breadcrumb-item active">Add Role</li>
                </ol>
            </div>
            <h4 class="page-title">Add Role</h4>
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
                        <form accept="{{route('admin.role.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label for="simpleinput" class="form-label">Name English</label>
                                    <input type="text" id="simpleinput" name="name" value="{{old('name')}}" class="form-control maintitle" placeholder="Name">
                                </div>    

                                <div class="col-md-6 mb-3">
                                    <label for="simpleinput" class="form-label">Slug</label>
                                    <input type="text" id="simpleinput" name="slug" value="{{old('slug')}}" class="form-control slugtitle" placeholder="Slug">
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
