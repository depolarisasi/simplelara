@extends('layouts.admin.app') 
@section('title', 'Create Location') 

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    #map {
        height: 400px;
        width: 100%;
        border-radius: 8px;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .social-media-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .social-media-section h4 {
        margin-bottom: 20px;
        color: #5e6278;
    }
    .operation-hours-table th,
    .operation-hours-table td {
        padding: 10px;
    }
    .tab-content {
        padding-top: 20px;
    }
</style>
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Create Location</h1>
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
                    <li class="breadcrumb-item text-muted">Create</li>
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
                    <h3 class="fw-bold m-0">Location Details</h3>
                </div>
            </div>
            
            <div class="card-body border-top p-9">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form action="{{ route('administrator.location.store') }}" method="POST" enctype="multipart/form-data" id="location-form">
                    @csrf
                    <input type="hidden" name="operation_hours" id="operation_hours_json">
                    
                    <!-- Nav tabs for better organization -->
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#basic_info">Basic Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#location_details">Location Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#social_media">Social Media</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#features">Features</a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="myTabContent">
                        <!-- Basic Information Tab -->
                        <div class="tab-pane fade show active" id="basic_info" role="tabpanel">
                            <div class="row mb-6">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label required fw-semibold fs-6">Name</label>
                                        <input type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="Location Name" required value="{{ old('name') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label required fw-semibold fs-6">Location Type</label>
                                        <select name="location_type_id" class="form-control form-control-lg form-control-solid" required>
                                            <option value="">Select Type</option>
                                            @foreach($locationTypes as $type)
                                                <option value="{{ $type->id }}" {{ old('location_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-6">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label fw-semibold fs-6">Address</label>
                                        <textarea name="address" class="form-control form-control-lg form-control-solid" rows="3" placeholder="Full Address">{{ old('address') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-6">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label fw-semibold fs-6">Phone</label>
                                        <input type="text" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone Number" value="{{ old('phone') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label fw-semibold fs-6">Email</label>
                                        <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Email Address" value="{{ old('email') }}" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-6">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label required fw-semibold fs-6">Owner</label>
                                        <select name="owner_id" class="form-control form-control-lg form-control-solid" required>
                                            <option value="">Select Owner</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('owner_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label fw-semibold fs-6">Thumbnail</label>
                                        <input type="file" name="thumbnail" class="form-control form-control-lg form-control-solid" accept="image/*" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-6">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label fw-semibold fs-6">Operation Hours</label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered operation-hours-table">
                                                <thead>
                                                    <tr>
                                                        <th>Day</th>
                                                        <th>Open</th>
                                                        <th>Close</th>
                                                        <th>Closed</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $operationHours = old('operation_hours') ? json_decode(old('operation_hours'), true) : [];
                                                        if (!is_array($operationHours)) {
                                                            $operationHours = [];
                                                        }
                                                    @endphp
                                                    
                                                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                                    @php
                                                        $dayLower = strtolower($day);
                                                        $isClosed = isset($operationHours[$dayLower]['closed']) && $operationHours[$dayLower]['closed'] ? true : false;
                                                        $openTime = isset($operationHours[$dayLower]['open']) ? $operationHours[$dayLower]['open'] : '';
                                                        $closeTime = isset($operationHours[$dayLower]['close']) ? $operationHours[$dayLower]['close'] : '';
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $day }}</td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm flatpickr-time operation-hours-time" data-day="{{ $dayLower }}" data-type="open" value="{{ $openTime }}" placeholder="Pilih Jam" {{ $isClosed ? 'disabled' : '' }} />
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm flatpickr-time operation-hours-time" data-day="{{ $dayLower }}" data-type="close" value="{{ $closeTime }}" placeholder="Pilih Jam" {{ $isClosed ? 'disabled' : '' }} />
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input day-closed" type="checkbox" value="1" data-day="{{ $dayLower }}" {{ $isClosed ? 'checked' : '' }} />
                                                            </div>
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
                        
                        <!-- Location Details Tab -->
                        <div class="tab-pane fade" id="location_details" role="tabpanel">
                            <div class="row mb-6">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label required fw-semibold fs-6">Province</label>
                                        <select name="province_id" id="province_id" class="form-control form-control-lg form-control-solid" required>
                                            <option value="">Select Province</option>
                                            @foreach($provinces as $province)
                                                <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label required fw-semibold fs-6">City</label>
                                        <select name="city_id" id="city_id" class="form-control form-control-lg form-control-solid" required {{ old('province_id') ? '' : 'disabled' }}>
                                            <option value="">Select City</option>
                                            @if(old('city_id'))
                                                <option value="{{ old('city_id') }}" selected>Saved City Selection</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-6">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label fw-semibold fs-6">District</label>
                                        <input type="text" name="district" class="form-control form-control-lg form-control-solid" placeholder="District" value="{{ old('district') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label fw-semibold fs-6">Subdistrict</label>
                                        <input type="text" name="subdistrict" class="form-control form-control-lg form-control-solid" placeholder="Subdistrict" value="{{ old('subdistrict') }}" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-6">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label fw-semibold fs-6">Postal Code</label>
                                        <input type="text" name="postal_code" class="form-control form-control-lg form-control-solid" placeholder="Postal Code" value="{{ old('postal_code') }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label fw-semibold fs-6">Hotel Star (if applicable)</label>
                                        <select name="hotel_star" class="form-control form-control-lg form-control-solid" id="hotel_star_field">
                                            <option value="">Not Applicable</option>
                                            <option value="1" {{ old('hotel_star') == 1 ? 'selected' : '' }}>⭐ 1 Star</option>
                                            <option value="2" {{ old('hotel_star') == 2 ? 'selected' : '' }}>⭐⭐ 2 Stars</option>
                                            <option value="3" {{ old('hotel_star') == 3 ? 'selected' : '' }}>⭐⭐⭐ 3 Stars</option>
                                            <option value="4" {{ old('hotel_star') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ 4 Stars</option>
                                            <option value="5" {{ old('hotel_star') == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ 5 Stars</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-6">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label required fw-semibold fs-6">Location on Map</label>
                                        <div id="map"></div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label class="fw-semibold fs-6">Latitude</label>
                                                <input type="text" id="latitude" name="latitude" class="form-control form-control-lg form-control-solid" value="{{ old('latitude', -2.5489) }}" readonly required />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="fw-semibold fs-6">Longitude</label>
                                                <input type="text" id="longitude" name="longitude" class="form-control form-control-lg form-control-solid" value="{{ old('longitude', 118.0149) }}" readonly required />
                                            </div>
                                        </div>
                                        <div class="form-text text-muted mt-2">Klik pada peta untuk mengubah koordinat lokasi</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Media Tab -->
                        <div class="tab-pane fade" id="social_media" role="tabpanel">
                            <div class="social-media-section">
                                <h4>Social Media Profiles</h4>
                                
                                <div class="row mb-6">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-form-label fw-semibold fs-6">Website</label>
                                            <input type="url" name="website" class="form-control form-control-lg form-control-solid" placeholder="https://example.com" value="{{ old('website') }}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-form-label fw-semibold fs-6">Instagram</label>
                                            <div class="input-group">
                                                <span class="input-group-text">@</span>
                                                <input type="text" name="instagram" class="form-control form-control-lg form-control-solid" placeholder="username" value="{{ old('instagram') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-6">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-form-label fw-semibold fs-6">TikTok</label>
                                            <div class="input-group">
                                                <span class="input-group-text">@</span>
                                                <input type="text" name="tiktok" class="form-control form-control-lg form-control-solid" placeholder="username" value="{{ old('tiktok') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-form-label fw-semibold fs-6">YouTube</label>
                                            <input type="text" name="youtube" class="form-control form-control-lg form-control-solid" placeholder="Channel URL or Name" value="{{ old('youtube') }}" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-6">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-form-label fw-semibold fs-6">LinkedIn</label>
                                            <input type="text" name="linkedin" class="form-control form-control-lg form-control-solid" placeholder="LinkedIn Profile" value="{{ old('linkedin') }}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-form-label fw-semibold fs-6">Facebook</label>
                                            <input type="text" name="facebook" class="form-control form-control-lg form-control-solid" placeholder="Facebook Page" value="{{ old('facebook') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Features Tab -->
                        <div class="tab-pane fade" id="features" role="tabpanel">
                            <div class="row mb-6">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="fw-semibold fs-6 mb-2">Is Viral</label>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" name="is_viral" id="is_viral" {{ old('is_viral') ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="is_viral">
                                                Mark as Viral
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="fw-semibold fs-6 mb-2">Is Legend</label>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" name="is_legend" id="is_legend" {{ old('is_legend') ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="is_legend">
                                                Mark as Legend
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="fw-semibold fs-6 mb-2">Is Featured</label>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" {{ old('is_featured') ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="is_featured">
                                                Mark as Featured
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-5">
                        <a href="{{ route('administrator.location.index') }}" class="btn btn-light me-3">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Create Location</span>
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    var map;
    var marker;

    $(document).ready(function() {
        // Initialize operation hours
        var operationHours = {};
        
        // Initialize Flatpickr for time inputs
        $(".flatpickr-time").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minuteIncrement: 15,
            allowInput: true,
            disableMobile: true,
            onChange: function(selectedDates, dateStr, instance) {
                updateOperationHours();
            }
        });
        
        // Setup tab events for Leaflet map
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            if ($(e.target).attr('href') === '#location_details') {
                if (!map) {
                    initializeMap();
                } else {
                    // Force redraw the map
                    setTimeout(function() {
                        map.invalidateSize();
                    }, 100);
                }
            }
        });
        
        // Initialize map if we're already on the location details tab
        if ($('#location_details').hasClass('active')) {
            initializeMap();
        }
        
        function initializeMap() {
            // Get coordinates from fields
            var lat = $('#latitude').val() || -2.5489;
            var lng = $('#longitude').val() || 118.0149;
            var zoom = (lat == -2.5489) ? 5 : 15;
            
            // Initialize map centered on Indonesia
            map = L.map('map', {
                preferCanvas: true  // Use Canvas renderer for better performance
            }).setView([lat, lng], zoom);
            
            // Add tile layer with proper attribution
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
                // Preload tiles for better performance
                updateWhenIdle: false,
                updateWhenZooming: true,
                updateInterval: 500
            }).addTo(map);
            
            // Set initial marker if custom location
            if (lat != -2.5489) {
                marker = L.marker([lat, lng]).addTo(map);
            }
            
            // Handle map click to set marker and coordinates
            map.on('click', function(e) {
                if (marker) {
                    map.removeLayer(marker);
                }
                
                marker = L.marker(e.latlng).addTo(map);
                
                $('#latitude').val(e.latlng.lat);
                $('#longitude').val(e.latlng.lng);
            });
            
            // Force redraw after initialization
            setTimeout(function() {
                map.invalidateSize();
            }, 100);
        }
        
        // Handle operation hours
        $('.day-closed').on('change', function() {
            var day = $(this).data('day');
            if ($(this).is(':checked')) {
                $('.operation-hours-time[data-day="' + day + '"]').prop('disabled', true);
            } else {
                $('.operation-hours-time[data-day="' + day + '"]').prop('disabled', false);
            }
            updateOperationHours();
        });
        
        // Update operation hours on time selection change
        $('.operation-hours-hour, .operation-hours-minute').on('change', function() {
            updateOperationHours();
        });
        
        // Function to update operation hours JSON
        function updateOperationHours() {
            var operationHours = {};
            
            $('.operation-hours-table tbody tr').each(function() {
                var day = $(this).find('td:first').text().toLowerCase();
                var isClosed = $(this).find('.day-closed').is(':checked');
                
                if (isClosed) {
                    operationHours[day] = { closed: true };
                } else {
                    var openTime = $(this).find('.operation-hours-time[data-type="open"]').val();
                    var closeTime = $(this).find('.operation-hours-time[data-type="close"]').val();
                    
                    if (openTime || closeTime) {
                        operationHours[day] = {
                            open: openTime || '',
                            close: closeTime || '',
                            closed: false
                        };
                    }
                }
            });
            
            // Set JSON in hidden field
            $('#operation_hours_json').val(JSON.stringify(operationHours));
        }
        
        // Update on form submit
        $('#location-form').on('submit', function() {
            updateOperationHours();
            return true;
        });
        
        // Province and city dependent dropdown
        $('#province_id').on('change', function() {
            var provinceId = $(this).val();
            if (provinceId) {
                $('#city_id').prop('disabled', true);
                
                $.ajax({
                    url: '{{ url("administrator/location/get-cities") }}/' + provinceId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#city_id').empty();
                        $('#city_id').append('<option value="">Select City</option>');
                        
                        $.each(data, function(key, value) {
                            var selected = (value.id == "{{ old('city_id') }}") ? 'selected' : '';
                            $('#city_id').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                        });
                        
                        $('#city_id').prop('disabled', false);
                    },
                    error: function() {
                        alert('Failed to load cities');
                        $('#city_id').prop('disabled', false);
                    }
                });
            } else {
                $('#city_id').empty();
                $('#city_id').append('<option value="">Select City</option>');
                $('#city_id').prop('disabled', true);
            }
        });
        
        // Show hotel star field only for hotel type
        $('select[name="location_type_id"]').on('change', function() {
            // Change the "2" to the ID of your hotel location type
            // You'll need to adjust this based on your actual data
            if ($(this).val() == "2") { // Assuming 2 is the ID for "Hotel"
                $('#hotel_star_field').closest('.col-lg-6').show();
            } else {
                $('#hotel_star_field').val('');
                $('#hotel_star_field').closest('.col-lg-6').hide();
            }
        }).trigger('change');
        
        // Initialize operation hours
        updateOperationHours();
        
        // Trigger province change if there is a selected province
        if ($('#province_id').val()) {
            $('#province_id').trigger('change');
        }
    });
</script>
@endsection 