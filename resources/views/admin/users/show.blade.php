@extends('layouts.admin.app')

@section('title', 'Detail Pengguna')

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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Detail Pengguna</h1>
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
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('administrator.user.index') }}" class="text-muted text-hover-primary">User</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Detail</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3"> 
                    <a href="{{ route('administrator.user.index') }}" class="btn btn-light">
                        <i class="ki-outline ki-arrow-left fs-2"></i> Kembali
                    </a>
                    <a href="{{ route('administrator.user.edit', $user->id) }}" class="btn btn-primary">
                        <i class="ki-outline ki-pencil fs-2"></i> Edit
                    </a>
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
        <!--begin::Content container--> 
        	<!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h3 class="fw-bold">Detail Pengguna: {{ $user->name }}</h3>
                        </div>
                        <!--begin::Card title-->  
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-flush h-md-100">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="fw-bold">Informasi Dasar</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                            <tbody>
                                                <tr>
                                                    <th class="min-w-150px w-30%">ID</th>
                                                    <td>{{ $user->id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama</th>
                                                    <td>{{ $user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>{{ $user->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Username</th>
                                                    <td>{{ $user->username }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nomor Telepon</th>
                                                    <td>{{ $user->phone ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Role</th>
                                                    <td>
                                                        <span class="badge badge-light-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'merchant' ? 'warning' : 'primary') }} fw-bold">
                                                            {{ ucfirst($user->role) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Terakhir Login</th>
                                                    <td>{{ $user->last_login ? $user->last_login->format('d M Y, h:i a') : 'Belum pernah login' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Dibuat</th>
                                                    <td>{{ $user->created_at->format('d M Y, h:i a') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Terakhir Diperbarui</th>
                                                    <td>{{ $user->updated_at->format('d M Y, h:i a') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-flush h-md-100">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="fw-bold">Roles & Permissions</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-5">
                                            <h5 class="fw-bold">Roles</h5>
                                            @if($user->roles->count() > 0)
                                                @foreach($user->roles as $role)
                                                    <span class="badge badge-light-success fw-bold mb-1">{{ $role->name }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">Tidak ada role</span>
                                            @endif
                                        </div>
                                        
                                        <div class="mb-5">
                                            <h5 class="fw-bold">Permissions</h5>
                                            @if($user->permissions->count() > 0)
                                                @foreach($user->permissions as $permission)
                                                    <span class="badge badge-light-info fw-bold mb-1">{{ $permission->name }}</span>
                                                @endforeach
                                            @else
                                                <p class="text-muted">Tidak ada permission khusus</p>
                                            @endif
                                        </div>
                                        
                                        <div>
                                            <h5 class="fw-bold">Permissions dari Role</h5>
                                            @php
                                                $rolePermissions = collect();
                                                foreach($user->roles as $role) {
                                                    $rolePermissions = $rolePermissions->merge($role->permissions);
                                                }
                                                $rolePermissions = $rolePermissions->unique('id');
                                            @endphp
                                            
                                            @if($rolePermissions->count() > 0)
                                                @foreach($rolePermissions as $permission)
                                                    <span class="badge badge-light-secondary fw-bold mb-1">{{ $permission->name }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">Tidak ada permission dari role</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->  
    </div>
    <!--end::Content-->
@endsection 

@section('scripts')  
<script>
$(document).ready(function() {
    // Script tambahan jika diperlukan
});
</script>
@endsection 