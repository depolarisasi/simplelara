@extends('layouts.auth.auth')

@section('title','Forgot Password')

@section('content')
    <!--begin::Form-->
    <form class="form w-100" method="POST" action="{{ route('password.email') }}">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">Forgot Password</h1>
            <!--end::Title-->
            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password</div>
            <!--end::Subtitle=-->
        </div>
        <!--begin::Heading-->
        
        @if (session('status'))
            <div class="alert alert-success mb-10" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <!--begin::Separator-->
        <div class="separator separator-content my-14"></div>
        <!--end::Separator-->

        <!--begin::Input group=-->
        <div class="fv-row mb-10">
            <!--begin::Email-->
            <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus class="form-control bg-transparent @error('email') is-invalid @enderror" />
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!--end::Email-->
        </div>
        <!--end::Input group=-->

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_password_reset_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span class="indicator-label">Send Reset Link</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Submit button-->

        <!--begin::Sign up-->
        <div class="text-gray-500 text-center fw-semibold fs-6 mb-3">
            Remember your password? 
            <a href="{{ route('login') }}" class="link-primary">Sign In</a>
        </div>
        <!--end::Sign up-->
        
        <!--begin::Sign up-->
        <div class="text-gray-500 text-center fw-semibold fs-6">
            Don't have an account? 
            <a href="{{ route('register') }}" class="link-primary">Sign Up</a>
        </div>
        <!--end::Sign up-->
    </form>
    <!--end::Form-->
@endsection
 