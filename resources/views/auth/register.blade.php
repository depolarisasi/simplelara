@extends('layouts.auth.auth')

@section('title','Register To Simple')

@section('content')
    <!--begin::Form-->
    <form class="form w-100" method="POST" action="{{ route('register') }}">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">Sign Up</h1>
            <!--end::Title-->
            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">Explore & Share Your Maps</div>
            <!--end::Subtitle=-->
        </div>
        <!--begin::Heading-->
        
        <!--begin::Separator-->
        <div class="separator separator-content my-14"></div>
        <!--end::Separator-->

        <!--begin::Input group=-->
        <div class="fv-row mb-8">
            <!--begin::Name-->
            <input type="text" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="form-control bg-transparent @error('name') is-invalid @enderror" />
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!--end::Name-->
        </div>
        <!--end::Input group=-->

        <!--begin::Input group=-->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" class="form-control bg-transparent @error('email') is-invalid @enderror" />
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!--end::Email-->
        </div>
        <!--end::Input group=-->

        <div class="fv-row mb-8">
            <!--begin::Password-->
            <input type="password" placeholder="Password" name="password" required autocomplete="new-password" class="form-control bg-transparent @error('password') is-invalid @enderror" />
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!--end::Password-->
        </div>

        <div class="fv-row mb-8">
            <!--begin::Confirm Password-->
            <input type="password" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password" class="form-control bg-transparent" />
            <!--end::Confirm Password-->
        </div>

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span class="indicator-label">Sign Up</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Submit button-->

        <!--begin::Sign in-->
        <div class="text-gray-500 text-center fw-semibold fs-6">
            Already have an account? 
            <a href="{{ route('login') }}" class="link-primary">Sign in</a>
        </div>
        <!--end::Sign in-->
    </form>
    <!--end::Form-->
@endsection
