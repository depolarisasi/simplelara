@extends('layouts.admin.app')
@section('title', 'Location Map')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
<style>
    #map {
        height: 700px;
        width: 100%;
        border-radius: 8px;
    }
    .location-popup .location-name {
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 5px;
    }
    .location-popup .location-type {
        color: #5e6278;
        font-size: 14px;
        margin-bottom: 8px;
    }
    .location-popup .location-address {
        margin-bottom: 8px;
        font-size: 14px;
    }
    .location-popup .location-actions {
        margin-top: 10px;
    }
    .popup-thumbnail {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
        margin-bottom: 10px;
    }
    .cluster-icon {
        background-color: #3498db;
        color: white;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        font-weight: bold;
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
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Locations Map</h1>
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
                        <a href="{{ route('administrator.location.index') }}" class="text-muted text-hover-primary">Locations</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Map View</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar wrapper-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">All Location Points</h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('administrator.location.index') }}" class="btn btn-sm btn-light-primary me-2">
                        <i class="ki-duotone ki-black-left fs-2"></i>Back to List
                    </a>
                    <a href="{{ route('administrator.location.create') }}" class="btn btn-sm btn-primary">
                        <i class="ki-duotone ki-plus fs-2"></i>Add Location
                    </a>
                </div>
            </div>
            
            <div class="card-body border-top p-9">
                <div class="row mb-6">
                    <div class="col-lg-12">
                        <div id="map"></div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="min-w-150px">Name</th>
                                        <th class="min-w-150px">Type</th>
                                        <th class="min-w-150px">Address</th>
                                        <th class="min-w-100px">Province</th>
                                        <th class="min-w-100px">City</th>
                                        <th class="min-w-100px">Coordinates</th>
                                        <th class="min-w-100px text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($locations as $location)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($location->thumbnail_url)
                                                <div class="symbol symbol-45px me-5">
                                                    <img src="{{ asset('storage/' . $location->thumbnail_url) }}" alt="{{ $location->name }}" />
                                                </div>
                                                @endif
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#" class="text-dark fw-bold text-hover-primary fs-6">{{ $location->name }}</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $location->locationType ? $location->locationType->name : '-' }}</td>
                                        <td>{{ $location->address ?: '-' }}</td>
                                        <td>{{ $location->province ? $location->province->name : '-' }}</td>
                                        <td>{{ $location->city ? $location->city->name : '-' }}</td>
                                        <td>
                                            <span class="text-muted fw-semibold text-muted d-block fs-7">
                                                {{ $location->latitude }}, {{ $location->longitude }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('administrator.location.edit', $location->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <i class="ki-duotone ki-pencil fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm delete-btn" data-id="{{ $location->id }}" data-name="{{ $location->name }}">
                                                <i class="ki-duotone ki-trash fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
<script>
    var map;
    var markers = [];
    
    $(document).ready(function() {
        initializeMap();
        
        // Handle delete button clicks
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            var locationId = $(this).data('id');
            var locationName = $(this).data('name');
            
            Swal.fire({
                title: 'Hapus Lokasi?',
                text: `Anda yakin ingin menghapus lokasi "${locationName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send delete request
                    $.ajax({
                        url: "{{ url('administrator/location/delete') }}/" + locationId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if(response.success) {
                                Swal.fire(
                                    'Deleted!',
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
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan saat menghapus data',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
    
    function initializeMap() {
        // Initialize the map centered on Indonesia
        map = L.map('map').setView([-2.5489, 118.0149], 5);
        
        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);
        
        // Initialize marker cluster group
        var markerClusterGroup = L.markerClusterGroup({
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            removeOutsideVisibleBounds: true
        });
        
        // Add markers for all locations
        @foreach($locations as $location)
        @if($location->latitude && $location->longitude)
        (function() {
            var lat = {{ $location->latitude }};
            var lng = {{ $location->longitude }};
            var popupContent = `
                <div class="location-popup">
                    @if($location->thumbnail_url)
                    <img src="{{ asset('storage/' . $location->thumbnail_url) }}" alt="{{ $location->name }}" class="popup-thumbnail">
                    @endif
                    <div class="location-name">{{ $location->name }}</div>
                    <div class="location-type">{{ $location->locationType ? $location->locationType->name : 'No Type' }}</div>
                    <div class="location-address">{{ $location->address ?: 'No Address' }}</div>
                    <div class="location-address">
                        {{ $location->city ? $location->city->name . ', ' : '' }}
                        {{ $location->province ? $location->province->name : '' }}
                    </div>
                    <div class="location-actions">
                        <a href="{{ route('administrator.location.edit', $location->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    </div>
                </div>
            `;
            
            var marker = L.marker([lat, lng]).bindPopup(popupContent);
            markerClusterGroup.addLayer(marker);
            markers.push(marker);
        })();
        @endif
        @endforeach
        
        // Add marker cluster group to map
        map.addLayer(markerClusterGroup);
        
        // Fit map bounds to include all markers if there are any
        if (markers.length > 0) {
            var group = L.featureGroup(markers);
            map.fitBounds(group.getBounds().pad(0.1));
        }
    }
</script>
@endsection 