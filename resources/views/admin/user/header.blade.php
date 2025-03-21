@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Customer List</li>
                </ol>
            </div>
            <h4 class="page-title">Customer List</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-xl-3">
                        <label for="inputPassword2" class="visually-hidden">Search</label>
                        <input type="search" class="form-control" id="s_key" placeholder="Name, Code, Email, Mobile">
                    </div>		
                   <div class="col-xl-3 mb-2">
                        <label for="inputPassword2" class="visually-hidden">Status</label>
						<select class="form-select" id="s_stat" name="status">
							<option value="" selected>Select status</option>
							<option value="A">Active</option>
							<option value="D">In-Active</option>
						</select>
                    </div>
                    <div class="col-xl-3 mb-2">
                        <label for="inputPassword2" class="visually-hidden">Date</label>
                        <input type="date" class="form-control" id="s_date" placeholder="Date...">
                    </div>	
                    <div class="col-xl-3">
                        <div class="text-xl-end mt-xl-0 mt-2">
                         <a href="{{route('admin.user.create')}}" class="btn btn-danger mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add Customer</a> 
                        </div>
                    </div><!-- end col-->
                </div>
                <div class="row"><p class="text-muted font-14">@include('admin.include.messages')</p></div>
                <div class="row">
                    <div id="data_table"></div>
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
@endsection

@section('script')
<script>
    var current_url='';
    data_table(page_url=false);
    $('#s_key').keyup(function(event){
        event.preventDefault();
        data_table(page_url=false);
    });
    $('#s_stat').change(function(event){
        event.preventDefault();
        data_table(page_url=false);
    });    
    $('#s_date').change(function(event){
        event.preventDefault();
        data_table(page_url=false);
    });
    $(document).on('click','.pagination li a',function(event){
        event.preventDefault();
        var page_url = $(this).attr('href');
        current_url = page_url;
        data_table(page_url);
    });

    function data_table(page_url){
        var skey = $('#s_key').val();
        var sstat = $('#s_stat').val();
        var sdate = $('#s_date').val();
        var base_url = '{{ route("admin.users") }}';
        if(page_url)
        {
            base_url = page_url;
            current_url = page_url;
        }
        $.ajax({
            url: base_url,
            type:'GET',
            dataType:'html',
            data:{skey:skey,sstat:sstat,sdate:sdate,"_token": "{{ csrf_token() }}"},
            success:function(resp){
                $('#data_table').html(resp);
            }
        });
    }
    $(window).focus(function() {
        data_table(page_url);
    });
	
	function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
    
</script>
@endsection
