<!--begin::Header-->
<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-animation="false" data-kt-sticky-offset="{default: '0px', lg: '0px'}">
    <!--begin::Header container-->
    <div class="app-container container-fluid d-flex align-items-stretch flex-stack mt-lg-8" id="kt_app_header_container">
        <!--begin::Sidebar toggle-->
        <div class="d-flex align-items-center d-block d-lg-none ms-n3" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px me-1" id="kt_app_sidebar_mobile_toggle">
                <i class="ki-outline ki-abstract-14 fs-2"></i>
            </div>
            <!--begin::Logo image-->
            <a href="index.html">
                <img alt="Logo" src="{{asset('assets/media/logos/logo.png')}}" class="h-25px theme-light-show" />
                <img alt="Logo" src="{{asset('assets/media/logos/logo.png')}}" class="h-25px theme-dark-show" />
            </a>
            <!--end::Logo image-->
        </div>
        <!--end::Sidebar toggle-->
        <!--begin::Navbar-->
        <div class="app-navbar flex-lg-grow-1" id="kt_app_header_navbar">
            <div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1 me-1 me-lg-0">
                 
            </div> 
            <!--begin::My apps links-->
            <div class="app-navbar-item ms-1 ms-md-3">
                <!--begin::Menu- wrapper-->
                <div class="btn btn-icon btn-custom btn-color-gray-500 btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                    <i class="ki-outline ki-notification-on fs-2"></i>
                </div>
                <!--begin::My apps-->
                <div class="menu menu-sub menu-sub-dropdown menu-column w-100 w-sm-350px" data-kt-menu="true">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">Notification</div>
                            <!--end::Card title--> 
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body py-5">
                            <!--begin::Scroll-->
                            <div class="mh-450px scroll-y me-n5 pe-5">
                                <!--begin::Row-->
                                <div class="row g-2">
                                  
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Scroll-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::My apps-->
                <!--end::Menu wrapper-->
            </div>
            <!--end::My apps links-->
            <!--begin::Action-->
            <div class="app-navbar-item ms-1 ms-md-3">
                <a href="{{url('/')}}" class="btn btn-flex btn-icon align-self-center fw-bold btn-secondary w-30px w-md-100 h-30px h-md-35px px-4 ms-3" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">
                    <i class="ki-outline ki-crown-2 fs-3"></i>
                    <span class="d-none d-md-inline ms-2 fs-7">Visit Website</span>
                </a>
            </div>
            <!--end::Action-->
        </div>
        <!--end::Navbar-->
    </div>
    <!--end::Header container-->
</div>
<!--end::Header-->