@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Reset Password </h4>
    <form action="{{ route('restaurant.password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ request('email') }}">
        <div class="mb-3">
            <label>New Password</label>
            <input type="email" class="form-control" name="password" value="{{ request('email') }}" readonly>
        </div>
        <div class="mb-3">
            <label>New Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>
@endsection
