@extends('layouts.app')

@section('content')

<!-- page header start -->
<section class="wrapper image-wrapper bg-image text-white" data-image-src="assets/img/page-bg.webp">
  <div class="container pt-7 pb-20 text-center">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h1 class="display-1 mb-3 text-white">Sign Up</h1>
        <nav class="d-inline-block" aria-label="breadcrumb">
          <ol class="breadcrumb text-white">
            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
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
                      <h2 class="mb-3 text-center">Sign up to Sovafinserv</h2>
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
								<input class="form-control @error('mobile') is-invalid @enderror" id="mobile" value="{{ old('mobile') }}" type="text" name="mobile" autocomplete="mobile" required />
								@error('mobile')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								<label for="mobile">Mobile</label>
							</div>  
							<div class="form-floating mb-4 text-center" align="center">
								<div id="recaptcha-container"></div>
							</div>
							<div class="form-floating mb-4">
								<button type="button" class="btn btn-primary login-btn" onclick="phoneSendAuth();">Submit</button>
							</div>
						 </div> 
						  
						  
                         <div class="VerificationForm" style="display: none;">
                        	<div class="sentSuccess" style="display: none;"></div>
                          	<div class="form-floating mb-4">
								<input class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" type="text" name="name" autocomplete="name" required />
								@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								<label for="name">Name</label>
                          	</div>
                          	<div class="form-floating mb-4">
                            	<input class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" type="text" name="email" autocomplete="email"  />
                            	@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								<label for="email">Email</label>
                          	</div>
                          	<div class="form-outline mb-5">
								<input id="verificationCode" type="text" class="form-control @error('verificationcode') is-invalid @enderror" name="verificationcode" required placeholder="Verification code">
								@error('verificationcode')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<div class="form-group text-center">
								<button type="button" class="btn btn-primary login-btn" onclick="codeverify()">Verify</button>
							</div>
						</div>
						</form>
                        <!-- /form -->
                        <p class="mb-0">Already have an account? <a href="{{route('login')}}" class="hover">Sign in</a></p>
                      </div>
                        <!--/.card-body -->
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
  apiKey: "AIzaSyCv_9Dx4lYBWCQkGID0ugwib-Yi82PaLwM",
  authDomain: "sovafinserv-5ca79.firebaseapp.com",
  projectId: "sovafinserv-5ca79",
  storageBucket: "sovafinserv-5ca79.appspot.com",
  messagingSenderId: "111035931792",
  appId: "1:111035931792:web:df225b952ea7d3a4378c15",
  measurementId: "G-TERM46PTQW"
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
    var chktype = 'signup';
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
        const name = $("input[name=name]").val();
        const email = $("input[name=email]").val();
        $.ajax({
            url: '{{ route("customsignup") }}',
            type: 'POST',
            dataType: 'JSON',
            data:{mobile:mobile,name:name,email:email},
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
