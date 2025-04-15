@extends('layouts.auth.auth')

@section('title','Confirm Password')

@section('content')
    <!--begin::Form-->
    <form class="form w-100" method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">Confirm Password</h1>
            <!--end::Title-->
            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">This is a secure area of the application. Please confirm your password before continuing.</div>
            <!--end::Subtitle=-->
        </div>
        <!--begin::Heading-->
        
        <!--begin::Separator-->
        <div class="separator separator-content my-14"></div>
        <!--end::Separator-->

        <div class="fv-row mb-8">
            <!--begin::Password-->
            <input type="password" placeholder="Password" name="password" required autocomplete="current-password" class="form-control bg-transparent @error('password') is-invalid @enderror" />
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!--end::Password-->
        </div>

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_confirm_password_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span class="indicator-label">Confirm</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Submit button-->

        <!--begin::Links-->
        <div class="text-gray-500 text-center fw-semibold fs-6 mb-3">
            <a href="{{ route('login') }}" class="link-primary">Back to login</a>
        </div>
        <!--end::Links-->
    </form>
    <!--end::Form-->
@endsection
