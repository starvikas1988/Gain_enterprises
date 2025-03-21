@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Edit Websiteconfig</li>
                </ol>
            </div>
            <h4 class="page-title">Edit Websiteconfig</h4>
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
                        <form action="{{route('admin.websiteconfig.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label for="simpleinput" class="form-label">User App Version</label>
                                    <input type="text" id="simpleinput" name="app_version" value="{{old('app_version', $page[0]->app_version)}}" class="form-control inputnum" placeholder="App Version">
                                </div>   
								
								<div class="col-md-4 mb-3">
                                    <label for="simpleinput" class="form-label">User Maintainance Mode</label>                                    
                                    <select class="form-control" name="maintainance_mode">
                                        <option value="NO" {{ (($page[0]->maintainance_mode == 'NO')?'selected':'') }}>NO</option>
                                        <option value="YES" {{ (($page[0]->maintainance_mode == 'YES')?'selected':'') }}>YES</option>
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
