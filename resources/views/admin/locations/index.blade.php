@extends('layouts.admin.app') 
@section('title', 'Locations') 
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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Locations</h1>
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
                        <li class="breadcrumb-item text-muted">Locations</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3"> 
                    <a href="{{ route('administrator.location.map') }}" class="btn btn-light-primary me-2">
                        <i class="ki-duotone ki-geolocation fs-2"></i>Map View
                    </a>
                    <a href="{{ route('administrator.location.create') }}" class="btn btn-primary">
                        <i class="ki-duotone ki-plus fs-2"></i>Add Location
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
       <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-location-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Location" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_locations">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-100px">ID</th>
                                <th class="min-w-150px">Thumbnail</th>
                                <th class="min-w-150px">Name</th>
                                <th class="min-w-150px">Type</th>
                                <th class="min-w-150px">Address</th>
                                <th class="min-w-150px">Province/City</th>
                                <th class="min-w-125px">Featured</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach($locations as $location)
                            <tr>
                                <td>{{ $location->id }}</td>
                                <td>
                                    @if($location->thumbnail_url)
                                    <img src="{{ Storage::disk('s3')->url($location->thumbnail_url) }}" alt="{{ $location->name }}" class="img-thumbnail" width="80">
                                    @else
                                    <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>{{ $location->name }}</td>
                                <td>{{ $location->locationType->name ?? 'N/A' }}</td>
                                <td>{{ Str::limit($location->address, 50) }}</td>
                                <td>{{ $location->province->name ?? 'N/A' }} / {{ $location->city->name ?? 'N/A' }}</td>
                                <td>
                                    @if($location->is_featured)
                                    <span class="badge badge-light-success">Yes</span>
                                    @else
                                    <span class="badge badge-light">No</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('administrator.location.edit', $location->id) }}" class="btn btn-icon btn-warning btn-sm me-1">
                                        <i class="ki-duotone ki-pencil fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <button class="btn btn-icon btn-danger btn-sm delete-location" data-id="{{ $location->id }}">
                                        <i class="ki-duotone ki-trash fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Content-->
@endsection

@section('scripts')   
<script> 
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#kt_table_locations').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true
        });

        // Handle search input
        $('input[data-kt-location-table-filter="search"]').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Delete Location
        $(document).on('click', '.delete-location', function() {
            var locationId = $(this).data('id');
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data lokasi akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('administrator/location/delete') }}/" + locationId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Terhapus!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan saat menghapus data.',
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