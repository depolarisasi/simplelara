@extends('layouts.auth.auth')

@section('title','Verify Email')

@section('content')
    <!--begin::Form-->
    <form class="form w-100" method="POST" action="{{ route('verification.send') }}">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">Verify Email Address</h1>
            <!--end::Title-->
            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </div>
            <!--end::Subtitle=-->
        </div>
        <!--begin::Heading-->
        
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success mb-10" role="alert">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif
        
        <!--begin::Separator-->
        <div class="separator separator-content my-14"></div>
        <!--end::Separator-->

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_verify_email_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span class="indicator-label">Resend Verification Email</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Submit button-->

        <!--begin::Logout link-->
        <div class="text-gray-500 text-center fw-semibold fs-6">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link link-primary p-0 m-0">
                    Log Out
                </button>
            </form>
        </div>
        <!--end::Logout link-->
    </form>
    <!--end::Form-->
@endsection 