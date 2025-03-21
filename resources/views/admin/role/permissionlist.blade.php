@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Permission List</li>
                </ol>
            </div>
            <h4 class="page-title">Permission List</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="">
            <div class="">
                <div class="row"><p class="text-muted font-14 respmessage">@include('admin.include.messages')</p></div>
                <div class="row">
                    @if($mainpermission->isNotEmpty())
                        @foreach($mainpermission as $perm)
                            <div class="col-md-3">
                                <form action="{{ route('admin.role.updatepermission',['id'=>$roleid]) }}" class="" method="POST">
                                    @csrf
                                    <div class="card" style="width: 18rem;">
                                      <div class="card-body">
                                        <h5 class="card-title">{{$perm->name}}</h5>
                                      </div>
                                      <ul class="list-group list-group-flush" style="height:400px;overflow-y:scroll;">
                                        @php
                                        $permission = \App\Models\Permission::Where('main_id','=',$perm->id)->get();
                                        @endphp
                                        @if($permission->isNotEmpty())
                                            @foreach($permission as $permsss)
                                            <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-8">{{$permsss->name}}</div>
                                                <div class="col-md-4">
                                                    @php
                                                    $rolepermission = \App\Models\Rolepermission::Where('role_id','=',$roleid)->Where('permission_id','=',$permsss->id)->get();
                                                    @endphp
                                                    <input type="checkbox" name="permission[]" class="checkbox" value="{{$permsss->id}}" {{ (($rolepermission->isNotEmpty())?'checked':'') }}>
                                                </div>
                                            </div>
                                            </li>
                                            @endforeach
                                        @endif
                                      </ul>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
@endsection


@section('script')
<script type="text/javascript">
$(document).on('change', '[name="permission[]"]', function() {
    var checkbox = $(this),
        permissionid = checkbox.val();
    var roleid = '{{$roleid}}';

    if(checkbox.is(':checked'))
    {
        var status='a'; 
    } else {
        var status='d';
    }
    $.ajax({
        url: "{{ route('admin.role.updatepermission',['id'=>$roleid]) }}",
        method:"POST",  
        data:{roleid:roleid,permissionid:permissionid,status:status,'_token':'{{ csrf_token() }}'},  
        dataType:"HTML",                              
        success: function( resp ) {
            $('.respmessage').html('<div class="alert alert-info" role="alert">Updated successfully</div>');
        }
    })
});
</script>
@endsection
