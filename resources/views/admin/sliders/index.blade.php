@extends('layouts.admin.app') 
@section('title', 'App Slider') 
@section('styles')
<style>
    /* Loading Overlay */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s, opacity 0.2s linear;
    }
    
    .loading-overlay.show {
        visibility: visible;
        opacity: 1;
    }
    
    .loading-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: white;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    /* Button loading state */
    .btn-loading {
        position: relative;
        pointer-events: none;
        color: transparent !important;
    }
    
    .btn-loading:after {
        content: '';
        position: absolute;
        width: 1rem;
        height: 1rem;
        top: calc(50% - 0.5rem);
        left: calc(50% - 0.5rem);
        border: 2px solid #fff;
        border-radius: 50%;
        border-right-color: transparent;
        animation: btn-spinner 0.75s linear infinite;
    }
    
    @keyframes btn-spinner {
        to {
            transform: rotate(360deg);
        }
    }
</style>
@endsection
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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Kelola App Slider</h1>
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
                        <li class="breadcrumb-item text-muted">App Slider</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3"> 
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_slider">
                        <i class="fas fa-plus"></i> Tambah Slider
                    </button>
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
                 <!--begin::Row-->
                 <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Slider</h3>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
    
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
    
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="sliders-table">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="15%">Gambar</th>
                                        <th>Judul</th>
                                        <th>Caption</th>
                                        <th>Tipe</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $slider)
                                    <tr>
                                        <td>{{ $slider->id }}</td>
                                        <td> 
                                        <a class="d-block overlay" data-fslightbox="lightbox-basic" href="{{ $slider->getImageUrl() }}">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" 
                                                style="background-image:url('{{ $slider->getImageUrl() }}'); height: 175px; background-size: cover; background-position: center center;">
                                            </div>
                                            <!--end::Image-->

                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                <i class="bi bi-eye-fill text-white fs-3x"></i>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Overlay--> 
                                        </td>
                                        <td>{{ $slider->slider_title }}</td>
                                        <td>{{ $slider->slider_caption }}</td>
                                        <td>
                                            <span class="badge badge-{{ $slider->slider_type == 'Big' ? 'primary' : 'info' }}">
                                                {{ $slider->slider_type }}
                                            </span>
                                        </td>
                                        <td> 
                                            <button type="button" class="btn btn-sm btn-warning edit-slider" data-id="{{ $slider->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger delete-slider" data-id="{{ $slider->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 <!--end::Row-->
             
        </div>
             <!--end::Container--> 
    </div>
     <!--end::Content-->

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-icon">
        <span class="spinner-border text-primary" role="status"></span>
    </div>
</div>

<!-- Modal Add Slider -->
<div class="modal fade" id="kt_modal_add_slider" tabindex="-1" aria-hidden="true">
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
                <form id="kt_add_slider_form" class="form" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Tambah Slider</h1> 
                    </div>
                     
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Judul Slider</span>
                        </label>
                        <input 
                            type="text" name="slider_title"
                            class="form-control form-control-solid" 
                            placeholder="Judul slider"
                        /> 
                    </div>
                    
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Caption</span>
                        </label>
                        <textarea 
                            name="slider_caption"
                            class="form-control form-control-solid" 
                            placeholder="Caption slider"
                            rows="3"
                        ></textarea>
                    </div>
                    
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Tipe Slider</span>
                        </label>
                        <select name="slider_type" class="form-select form-select-solid">
                            <option value="">-- Pilih Tipe --</option>
                            <option value="Big">Big Slider</option>
                            <option value="Small">Small Slider</option>
                        </select>
                    </div>
                    
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Gambar</span>
                        </label>
                        <input 
                            type="file" name="slider_url"
                            class="form-control form-control-solid" 
                            accept="image/*"
                        />
                        <div class="form-text">Format: JPG, PNG, GIF. Ukuran maks: 2MB</div>
                    </div>
                     
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" id="kt_add_slider_submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                            <span class="indicator-progress">Mohon tunggu...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Slider -->
<div class="modal fade" id="kt_modal_edit_slider" tabindex="-1" aria-hidden="true">
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
                <form id="kt_edit_slider_form" class="form" action="#" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="slider_id" id="edit_slider_id">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Edit Slider</h1> 
                    </div>
                     
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Judul Slider</span>
                        </label>
                        <input 
                            type="text" name="slider_title" id="edit_slider_title"
                            class="form-control form-control-solid" 
                            placeholder="Judul slider"
                        /> 
                    </div>
                    
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Caption</span>
                        </label>
                        <textarea 
                            name="slider_caption" id="edit_slider_caption"
                            class="form-control form-control-solid" 
                            placeholder="Caption slider"
                            rows="3"
                        ></textarea>
                    </div>
                    
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Tipe Slider</span>
                        </label>
                        <select name="slider_type" id="edit_slider_type" class="form-select form-select-solid">
                            <option value="">-- Pilih Tipe --</option>
                            <option value="Big">Big Slider</option>
                            <option value="Small">Small Slider</option>
                        </select>
                    </div>
                    
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Gambar Saat Ini</span>
                        </label>
                        <div class="image-preview mb-2">
                            <img id="edit_slider_image_preview" src="" alt="Slider Image" class="img-fluid rounded" style="max-width: 100%; max-height: 200px;">
                        </div>
                    </div>
                    
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Upload Gambar Baru (Opsional)</span>
                        </label>
                        <input 
                            type="file" name="slider_url"
                            class="form-control form-control-solid" 
                            accept="image/*"
                        />
                        <div class="form-text">Format: JPG, PNG, GIF. Ukuran maks: 2MB</div>
                    </div>
                     
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" id="kt_edit_slider_submit" class="btn btn-primary">
                            <span class="indicator-label">Perbarui</span>
                            <span class="indicator-progress">Mohon tunggu...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        new DataTable('#sliders-table', {
            info: false,
            ordering: true,
            paging: true
        });
        
        // Initialize loading overlay functions
        function showLoading() {
            $('#loadingOverlay').addClass('show');
        }
        
        function hideLoading() {
            $('#loadingOverlay').removeClass('show');
        }
        
        // Setup global AJAX events for loading indicator
        $(document).ajaxStart(function() {
            showLoading();
        }).ajaxStop(function() {
            hideLoading();
        });
        
        // Add loading state to button
        function addButtonLoading(btn) {
            $(btn).addClass('btn-loading');
            $(btn).prop('disabled', true);
        }
        
        // Remove loading state from button
        function removeButtonLoading(btn) {
            $(btn).removeClass('btn-loading');
            $(btn).prop('disabled', false);
        }

        // Add Slider Form Submit
        $('#kt_add_slider_form').on('submit', function(e) {
            e.preventDefault();
            
            const submitButton = document.getElementById('kt_add_slider_submit');
            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;
            
            const formData = new FormData(this);
            
            $.ajax({
                url: "{{ url('administrator/slider/store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {
                            $('#kt_modal_add_slider').modal('hide');
                            $('#kt_add_slider_form').trigger('reset');
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            text: response.message,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    
                    $.each(errors, function(key, value) {
                        errorMessage += value + '<br>';
                    });
                    
                    Swal.fire({
                        html: errorMessage,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "OK",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                },
                complete: function() {
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                }
            });
        });
        
        // Edit Slider
        $(document).on('click', '.edit-slider', function() {
            const sliderId = $(this).data('id');
            const btn = $(this);
            
            // Add loading state to button
            addButtonLoading(btn);
            
            $.ajax({
                url: "{{ url('administrator/slider/edit') }}/" + sliderId,
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        const slider = response.data;
                        
                        $('#edit_slider_id').val(slider.id);
                        $('#edit_slider_title').val(slider.slider_title);
                        $('#edit_slider_caption').val(slider.slider_caption);
                        $('#edit_slider_type').val(slider.slider_type);
                        $('#edit_slider_image_preview').attr('src', response.image_url);
                        
                        $('#kt_modal_edit_slider').modal('show');
                    } else {
                        Swal.fire({
                            text: "Gagal mengambil data slider",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                },
                complete: function() {
                    // Remove loading state from button
                    removeButtonLoading(btn);
                }
            });
        });
        
        // Update Slider Form Submit
        $('#kt_edit_slider_form').on('submit', function(e) {
            e.preventDefault();
            
            const submitButton = document.getElementById('kt_edit_slider_submit');
            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;
            
            const formData = new FormData(this);
            const sliderId = $('#edit_slider_id').val();
            
            $.ajax({
                url: "{{ url('administrator/slider/update') }}/" + sliderId,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {
                            $('#kt_modal_edit_slider').modal('hide');
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            text: response.message,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    
                    $.each(errors, function(key, value) {
                        errorMessage += value + '<br>';
                    });
                    
                    Swal.fire({
                        html: errorMessage,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "OK",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                },
                complete: function() {
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                }
            });
        });
        
        // Delete Slider
        $(document).on('click', '.delete-slider', function() {
            const sliderId = $(this).data('id');
            const btn = $(this);
            
            Swal.fire({
                text: "Apakah Anda yakin ingin menghapus slider ini?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Tidak, batal",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-light"
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    // Add loading state to button
                    addButtonLoading(btn);
                    
                    $.ajax({
                        url: "{{ url('administrator/slider/delete') }}/" + sliderId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    text: response.message,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "OK",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function() {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    text: response.message,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "OK",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                                
                                // Remove loading state from button in case of error
                                removeButtonLoading(btn);
                            }
                        },
                        error: function() {
                            Swal.fire({
                                text: "Terjadi kesalahan saat menghapus slider",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "OK",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                            
                            // Remove loading state from button in case of error
                            removeButtonLoading(btn);
                        }
                    });
                }
            });
        });
        
        // Fix for CORS issues with S3 images
        function initializeTemporaryImagesUrls() {
            $('a[data-fslightbox="lightbox-basic"]').each(function() {
                const $link = $(this);
                const imgUrl = $link.attr('href');
                
                // If it's an S3 URL, we'll need to replace with a proxy or generate a signed URL
                if (imgUrl.includes('s3.amazonaws.com') || imgUrl.includes('s3.ap-southeast-2.amazonaws.com')) {
                    // Here we could add code to generate signed URLs or use a proxy
                    // For now, just adding a random param to avoid cached CORS errors
                    // In a real solution you would replace this with a proper signed URL or proxy
                    const updatedUrl = imgUrl + '?v=' + new Date().getTime();
                    $link.attr('href', updatedUrl);
                    
                    // Also update the background image URL
                    const $img = $link.find('.overlay-wrapper');
                    const bgImg = $img.css('background-image');
                    if (bgImg) {
                        const updatedBgImg = bgImg.replace(/url\(['"]?(.*?)['"]?\)/, 'url("' + updatedUrl + '")');
                        $img.css('background-image', updatedBgImg);
                    }
                }
            });
            
            // Refresh FsLightbox after updating URLs
            if (typeof refreshFsLightbox === 'function') {
                refreshFsLightbox();
            }
        }
        
        // Initialize temporary URLs to avoid CORS issues
        initializeTemporaryImagesUrls();
    });
</script>
@endsection 