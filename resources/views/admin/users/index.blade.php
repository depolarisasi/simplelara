@extends('layouts.admin.app')
@section('title', 'User')   
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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">User</h1>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">New User</button>
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
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search Customers" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->  
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0"> 
                                    <th class="min-w-125px">User Name</th>
                                    <th>Role</th>
                                    <th>Last Login</th>
                                    <th>Sign Up Date</th>
                                    <th class="text-end min-w-70px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                
                                @foreach($users as $user)
                                <tr> 
                                    <td class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="{{url('administrator/user/'.$user->id)}}">
                                                <div class="symbol-label">
                                                    <img src="{{$user->avatar_url ? Storage::disk('s3')->url($user->avatar_url) : asset('assets/media/avatars/300-1.jpg')}}" alt="{{$user->name}}" class="w-100">
                                                </div>
                                            </a>
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::User details-->
                                        <div class="d-flex flex-column">
                                            <a href="{{url('administrator/user/'.$user->id)}}" class="text-gray-800 text-hover-primary mb-1">{{$user->name}}</a>
                                            <span>{{$user->email}}</span>
                                        </div>
                                        <!--begin::User details-->
                                    </td> 
                                    <td>
                                        <span class="badge badge-secondary">{{$user->role ?? 'N/A'}}</span>
                                    </td> 
                                    <td>{{$user->last_login ? $user->last_login->format('d M Y, h:i a') : '-'}}</td> 
                                    <td>{{$user->created_at->format('d M Y, h:i a')}}</td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                        <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{url('administrator/user/'.$user->id)}}" class="menu-link px-3">View</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{url('administrator/user/edit/'.$user->id)}}" class="menu-link px-3">Edit</a>
                                            </div>
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div data-id="{{$user->id}}" class="menu-link delete-user px-3" >Delete</div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Modals-->
                <!--begin::Modal - Customers - Add-->
                <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content rounded">
                            <div class="modal-header pb-0 border-0 justify-content-end">
                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            
                            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                <form action="{{url('administrator/user/store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-13 text-center">
                                        <h1 class="mb-3">Add User</h1>
                                        <div class="text-muted fw-semibold fs-5">
                                            Add new user
                                        </div>
                                    </div>
                                    
                                    <div class="fv-row mb-7">
                                        <label class="d-block fw-semibold fs-6 mb-5">Profile Picture</label> 
                                        <!-- Image container -->
                                        <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                                            <!-- Preview area -->
                                            <div class="image-input-wrapper w-125px h-125px" 
                                                 style="background-image: url({{asset('assets/media/avatars/300-6.jpg')}})">
                                            </div>
                                    
                                            <!-- Change Button -->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" 
                                                   data-kt-image-input-action="change" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Change Profile Picture">
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
                                                  title="Cancel Avatar">
                                                  <i class="ki-solid ki-cross"></i>
                                            </span>
                                    
                                            <!-- Remove Button -->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" 
                                                  data-kt-image-input-action="remove" 
                                                  data-bs-toggle="tooltip" 
                                                  title="Remove Avatar">
                                                  <i class="ki-solid ki-cross"></i>
                                            </span>
                                        </div>
                                        
                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                    </div>
                                    <!-- Name Input -->
                                    <div class="d-flex flex-column mb-8 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span class="required">Name </span>
                                        </label>
                                        <input 
                                            type="text"  name="name"
                                            class="form-control form-control-solid" 
                                            placeholder="Full Name"
                                        /> 
                                    </div>
                
                                    <!-- Email Input -->
                                    <div class="d-flex flex-column mb-8 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span class="required">Email</span>
                                        </label>
                                        <input 
                                            type="email" name="email" 
                                            class="form-control form-control-solid" 
                                            placeholder="Email Address"
                                        /> 
                                    </div>
                
                                    <!-- Password Input -->
                                    <div class="d-flex flex-column mb-8 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span>Password</span> 
                                        </label>
                                        <input 
                                            type="password"  
                                            class="form-control form-control-solid" 
                                            placeholder="Password"
                                            name="password"
                                        /> 
                                    </div>
                                    <div class="d-flex flex-column mb-8 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span>Phone Number</span> 
                                        </label>
                                        <input 
                                            type="text"  
                                            class="form-control form-control-solid" 
                                            placeholder="Phone Number"
                                            name="phone"
                                        /> 
                                    </div>
                 
                                    <div class="d-flex flex-column mb-8 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span>Role</span> 
                                        </label>
                                        <select class="form-select" name="role">
                                            <option value="">Select Role</option>
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach 
                                        </select>
                                    </div> 
                
                                    <div class="text-center">
                                        <button 
                                            type="button" 
                                            class="btn btn-light me-3" 
                                            data-bs-dismiss="modal"
                                        >
                                            Batal
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <span class="indicator-label">Submit</span> 
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Modal - Customers - Add-->
                 
                <!--end::Modals-->
            </div>
            <!--end::Content container-->  
    </div>
    <!--end::Content-->
     
@endsection
 

@section('scripts')  
<script>
$(document).ready(function() {
    $('#table_user').DataTable({
        "paging":   true,
        "ordering": true,
    } );
} );

$(function() {
        // Delete Permission
        $(document).on('click', '.delete-user', function() {
            var userId = $(this).data('id');
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data role akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('administrator/user/delete') }}/" + userId,
                        type: 'GET',
                          
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Terhapus!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            var response = JSON.parse(xhr.responseText);
                            Swal.fire(
                                'Error!',
                                response.message || 'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
});
</script>
 
@endsection 