@extends('layouts.auth.auth') 
@section('title', 'Sign In')  
@section('content')
    <!--begin::Form-->
    <form class="form w-100" id="kt_sign_in_form"  method="POST" action="{{ route('login') }}">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
            <!--end::Title-->
            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">Explore & Share Your Maps</div>
            <!--end::Subtitle=-->
        </div>
         
        <!--begin::Input group=-->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input type="text" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control bg-transparent @error('email') is-invalid @enderror" />
             @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!--end::Email-->
        </div>
        <!--end::Input group=-->

        <div class="fv-row mb-3">
            <!--begin::Password-->
            <input type="password" placeholder="Password" name="password" required autocomplete="current-password" class="form-control bg-transparent @error('password') is-invalid @enderror" />
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!--end::Password-->
        </div>
        <!--end::Input group=-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
             <!--begin::Remember Me-->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label text-gray-700" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
            <!--end::Remember Me-->
            <!--begin::Link-->
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="link-primary">{{ __('Forgot Password?') }}</a>
            @endif
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">  Sign In 
            </button>
        </div>
        <!--end::Submit button-->

        <!--begin::Sign up-->
        @if (Route::has('register'))
            <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
            <a href="{{ route('register') }}" class="link-primary">Sign up</a></div>
        @endif
        <!--end::Sign up-->
    </form>
    <!--end::Form--> 
@endsection
 