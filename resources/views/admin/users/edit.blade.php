@extends('layouts.admin.app') 
@section('title', 'Edit User')   
@section('content')

<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar pt-2 pt-lg-10">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <!--begin::Toolbar wrapper-->
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Edit User</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{url('administrator')}}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item--> 
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">User</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3"> 
                <a class="btn btn-secondary btn-sm" href="{{ url('administrator/user') }}">
                    <i class="ki-solid ki-arrow-left">
                    </i> Kembali</a>
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar wrapper-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->

<div id="kt_app_content" class="app-content flex-column-fluid"> 
    <div id="kt_app_content_container" class="app-container container-fluid"> 
            <div class="card">  
                <div class="card-header">
                    <h3 class="card-title">Edit User: {{ $user->name }}</h3> 
                </div>

              <div class="card-body">
                <form action="{{ route('administrator.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Avatar Input -->
                    <div class="mb-8 fv-row">
                        <label class="d-block fw-semibold fs-6 mb-3">Foto Profil</label>
                        <div class="image-input image-input-outline" 
                            data-kt-image-input="true" 
                            style="background-image: url('{{ asset('assets/media/avatars/blank.png') }}')">
                            <!-- Image Preview -->
                            <div class="image-input-wrapper w-125px h-125px" 
                                style="background-image: url('{{ $user->avatar_url ?  Storage::disk('s3')->url($user->avatar_url) : asset('assets/media/avatars/300-1.jpg') }}')">
                            </div>
                            
                            <!-- Change Button -->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" 
                                data-kt-image-input-action="change" 
                                data-bs-toggle="tooltip" 
                                title="Ganti Foto Profil">
                                <i class="ki-solid ki-pencil fs-7"></i>
                                <input type="file" 
                                    name="avatar_url" 
                                    accept=".png, .jpg, .jpeg" 
                                    class="d-none">
                                <input type="hidden" name="avatar_url_remove">
                            </label>
                    
                            <!-- Cancel Button -->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" 
                                data-kt-image-input-action="cancel" 
                                data-bs-toggle="tooltip" 
                                title="Batal">
                                <i class="ki-solid ki-cross"></i>
                            </span>
                    
                            <!-- Remove Button -->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" 
                                data-kt-image-input-action="remove" 
                                data-bs-toggle="tooltip" 
                                title="Hapus Avatar">
                                <i class="ki-solid ki-cross"></i>
                            </span>
                        </div>
                        
                        <div class="form-text">Format yang diizinkan: png, jpg, jpeg.</div>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Name</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control form-control-solid @error('name') is-invalid @enderror" 
                            placeholder="Full Name"
                            value="{{ old('name', $user->name) }}" 
                            required
                        />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Email</span>
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control form-control-solid @error('email') is-invalid @enderror" 
                            placeholder="Email"
                            value="{{ old('email', $user->email) }}" 
                            required
                        />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Password</span>
                            <small class="ms-2 text-muted">(Kosongkan jika tidak ingin mengubah password)</small>
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control form-control-solid @error('password') is-invalid @enderror" 
                            placeholder="Password Baru"
                        />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Phone Number</span>
                        </label>
                        <input 
                            type="text" 
                            name="phone" 
                            class="form-control form-control-solid @error('phone') is-invalid @enderror" 
                            placeholder="Phone Number"
                            value="{{ old('phone', $user->phone) }}"
                        />
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Role</span>
                        </label>
                        <select class="form-select" name="role">
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{$role->id}}" {{ old('role', $user->role) == $role->id ? 'selected' : '' }}>{{$role->name}}</option>
                            @endforeach 
                        </select>

                        
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> 
                    <div class="text-center"> 
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Update</span>
                        </button>
                    </div>
              </div>
              
            </div>
</div> 
@endsection
 