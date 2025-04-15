@extends('layouts.admin.app') 
@section('title', 'Edit Role') 
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
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Permission</h1>
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
                    <li class="breadcrumb-item text-muted">Role</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3"> 
                <a class="btn btn-secondary btn-sm" href="{{ url('administrator/role') }}">
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

 <!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid"> 
        <div id="kt_app_content_container" class="app-container container-fluid">
         <!--begin::Container-->  
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Role: {{ $role->name }}</h3>
                    
                </div>
                <form action="{{ route('administrator.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Role Name </span>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name) }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div> 

                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Permission </span>
                            </label>
                             @foreach($permissions as $perms)
                             <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" value="{{$perms->name}}" name="permissions[]" id="check{{$perms->name}}" {{ in_array($perms->name, old('permissions', $rolePermissions)) ? 'checked' : '' }}     />
                                <label class="form-check-label" for="check{{$perms->name}}">
                                    {{$perms->name}}
                                </label>
                            </div>
                             @endforeach
                        </div>
 
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div> 
         </div>
         <!--end::Container--> 
     <!--end::Post-->
</div>
 <!--end::Content-->

 
@endsection
 