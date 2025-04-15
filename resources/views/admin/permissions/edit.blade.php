@extends('layouts.admin.app') 
@section('title', 'Edit Permission') 

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
                    <li class="breadcrumb-item text-muted">Permission</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3"> 
                <a class="btn btn-secondary btn-sm" href="{{ url('administrator/permission') }}">
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
                <h3 class="card-title">Edit Permission: {{ $permission->name }}</h3>
                
            </div>
            <form action="{{ route('administrator.permission.update', $permission->id) }}" method="POST">
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

                    <div class="form-group mb-3">
                        <label for="name">Nama Permission</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $permission->name) }}" required>
                        <small class="form-text text-muted">Gunakan format kata kerja + subjek, mis: create user, edit post</small>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
            placeholder: 'Pilih roles',
            allowClear: true
        });
    });
</script>
@endsection 