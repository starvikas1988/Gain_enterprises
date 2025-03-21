@extends('layouts.app')

@section('content')


<!-- page header start -->
<section class="wrapper image-wrapper bg-image text-white" data-image-src="assets/img/page-bg.webp">
    <div class="container pt-7 pb-20 text-center">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="display-1 mb-3 text-white">Sign In</h1>
                <nav class="d-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb text-white">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sign In</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- page header end -->

<!-- page body start here -->
<section class="wrapper bg-light">
    <div class="container pb-12">
        <div class="row">
            <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto mt-n20">
                <div class="card">
                    <div class="card-body p-11 text-center">
                        <h2 class="mb-3 text-center">Sign In</h2>
                        <p class="lead mb-6 text-start">@include('admin.include.messages')</p>
                        @if(Session::has('error'))
                        <div class="alert alert-danger">
                          {{ Session::get('error')}}
                        </div>
                        @endif    
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
							<div class="LoginForm">
                        		<div class="sentSuccess" style="display: none;"></div>
								<div class="form-floating mb-4">
									<input class="form-control @error('mobile') is-invalid @enderror inputnum" id="mobile" value="{{ old('mobile') }}" type="text" name="mobile" autofocus required />
									@error('mobile')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
									<label for="mobile">Mobile</label>
								</div>
								<div class="form-floating mb-4">
									<div id="recaptcha-container"></div>
								</div>
								<div class="form-floating mb-4">
									<button type="button" class="btn btn-primary login-btn" onclick="phoneSendAuth();">Submit</button>
								</div>
							</div> 
							
							<div class="VerificationForm" style="display: none;">
								<div class="sentSuccess" style="display: none;"></div>         
								<div class="form-floating mb-4">
									<input id="verificationCode" type="text" class="form-control @error('verificationcode') is-invalid @enderror" name="verificationcode" required placeholder="Verification code" minlength="6" maxlength="6">
									@error('verificationcode')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
									<label for="verificationCode">Verification code</label>
								</div>
								<div class="form-floating mb-4">
									<button type="button" class="btn btn-primary login-btn" onclick="codeverify()">Verify</button>
								</div>
							</div>
							
                        </form>

                        <p class="mb-0">Don't have an account? <a href="{{route('register')}}" class="hover">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page body end here -->

@endsection

@section('script')
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<script>
const firebaseConfig = {
  apiKey: "AIzaSyC5xdNoeiwBLg8VT2GEDU41xawXoHu4_JE",
  authDomain: "sovafinserv-709de.firebaseapp.com",
  projectId: "sovafinserv-709de",
  storageBucket: "sovafinserv-709de.appspot.com",
  messagingSenderId: "417305439179",
  appId: "1:417305439179:web:2ace5d157783151de7e44e",
  measurementId: "G-KS360X677D"
};
firebase.initializeApp(firebaseConfig);
</script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
window.onload=function () {
    $('.VerificationForm').hide();
    render();
};
function render() {
    window.recaptchaVerifier=new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
}
function phoneSendAuth() {
    var number = $("#mobile").val();
    var chktype = 'signin';
	var code = '+91';
    $.ajax({
        url: '{{ route("numberexistcheck") }}',
        type: 'POST',
        dataType: 'JSON',
        data:{number:number,chktype:chktype},
        success: function(resp){
            if (resp){
                var number = $("#mobile").val();
                var number = code+number;
                firebase.auth().signInWithPhoneNumber(number,window.recaptchaVerifier).then(function (confirmationResult) {
                    window.confirmationResult=confirmationResult;
                    coderesult=confirmationResult;
                    console.log(coderesult);
                    $(".sentSuccess").html('<div class="alert alert-success">Otp sent to your mobile number.</div>');
                    $(".sentSuccess").show();
                    $('.LoginForm').hide();
                    $('.VerificationForm').show();
                }).catch(function (error) {
                    $(".sentSuccess").html('<div class="alert alert-success">'+error.message+'</div>');
                    $(".sentSuccess").show();
                });
            } else {
                $(".sentSuccess").html('<div class="alert alert-danger">Number already registered</div>');
                $(".sentSuccess").show();
            }
        },
        error: function (xhr) {
            $('.sentSuccess').html('');
            $.each(xhr.responseJSON.errors, function(key,value) {
                $('.sentSuccess').append('<div class="alert alert-danger">'+value+'</div');
            }); 
        },
    })

    
}
function codeverify() {
    var code = $("#verificationCode").val();
    coderesult.confirm(code).then(function (result) {
        console.log(result);
        var user=result.user;
        const mobile = $("#mobile").val();
        $.ajax({
            url: '{{ route("customsignin") }}',
            type: 'POST',
            dataType: 'JSON',
            data:{mobile:mobile},
            success: function(resp){
                if (resp.status){
                    $(".sentSuccess").html('<div class="alert alert-success">you are register Successfully.</div>');
                    $(".sentSuccess").show();
                    window.location.href = resp.redirect_location;
                } else {
                    $(".sentSuccess").html('<div class="alert alert-danger">'+resp.message+'</div>');
                    $(".sentSuccess").show();
                }
            },
            error: function (xhr) {
                $('.sentSuccess').html('');
                $.each(xhr.responseJSON.errors, function(key,value) {
                    $('.sentSuccess').append('<div class="alert alert-danger">'+value+'</div');
                }); 
            },
        })        
    }).catch(function (error) {
        $(".sentSuccess").html('<div class="alert alert-danger">'+error.message+'</div>');
        $(".sentSuccess").show();
    });
}
</script>   
@endsection


