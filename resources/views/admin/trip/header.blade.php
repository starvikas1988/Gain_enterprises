@extends('layouts.admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Trip List</li>
                </ol>
            </div>
            <h4 class="page-title">Trip List</h4>
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
                        <label for="inputSearch" class="visually-hidden">Search</label>
                        <input type="search" class="form-control" id="s_key" placeholder="Driver Name">
                    </div>

                    <div class="col-xl-3 mb-2">
                        <label for="inputStatus" class="visually-hidden">Status</label>
                        <select class="form-select" id="s_stat" name="status">
                            <option value="" selected>Select Trip Status</option>
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <div class="col-xl-3 mb-2">
                        <label for="inputDate" class="visually-hidden">Date</label>
                        <input type="date" class="form-control" id="s_date" placeholder="Date...">
                    </div>

                    <div class="col-xl-3">
                        <div class="text-xl-end mt-xl-0 mt-2">
                            <a href="{{ route('admin.trip.create') }}" class="btn btn-danger mb-2 me-2">
                                <i class="mdi mdi-map-marker-path me-1"></i> Add Trip
                            </a>
                        </div>
                    </div><!-- end col -->
                </div>

                <div class="row">
                    <p class="text-muted font-14">@include('admin.include.messages')</p>
                </div>

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
    var current_url = '';
    data_table(false);

    $('#s_key').keyup(function(event) {
        event.preventDefault();
        data_table(false);
    });

    $('#s_stat').change(function(event) {
        event.preventDefault();
        data_table(false);
    });

    $('#s_date').change(function(event) {
        event.preventDefault();
        data_table(false);
    });

    $(document).on('click', '.pagination li a', function(event) {
        event.preventDefault();
        var page_url = $(this).attr('href');
        current_url = page_url;
        data_table(page_url);
    });

    function data_table(page_url) {
        var skey = $('#s_key').val();
        var sstat = $('#s_stat').val();
        var sdate = $('#s_date').val();
        var base_url = '{{ route("admin.trips") }}';
        if (page_url) {
            base_url = page_url;
            current_url = page_url;
        }

        $.ajax({
            url: base_url,
            type: 'GET',
            dataType: 'html',
            data: {
                skey: skey,
                sstat: sstat,
                sdate: sdate,
                "_token": "{{ csrf_token() }}"
            },
            success: function(resp) {
                $('#data_table').html(resp);
            }
        });
    }

    $(window).focus(function() {
        data_table(current_url);
    });

    function myFunction() {
        if (!confirm("Are you sure you want to delete this trip?"))
            event.preventDefault();
    }
</script>
@endsection
