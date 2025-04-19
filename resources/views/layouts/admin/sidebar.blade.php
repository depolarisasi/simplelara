<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column mt-lg-4 ps-2 pe-2 ps-lg-7 pe-lg-4" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo flex-shrink-0 d-none d-lg-flex flex-center align-items-center" id="kt_app_sidebar_logo">
        <!--begin::Logo-->
        <a href="{{url('administrator')}}">
            <img alt="Logo" src="{{asset('assets/media/logos/logo.png')}}" class="h-25px d-none d-sm-inline app-sidebar-logo-default theme-light-show" />
            <img alt="Logo" src="{{asset('assets/media/logos/logo.png')}}" class="h-25px theme-dark-show" />
        </a>
        <!--end::Logo-->
        <!--begin::Aside toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
            <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
                <i class="ki-outline ki-abstract-14 fs-1"></i>
            </div>
        </div>
        <!--end::Aside toggle-->
    </div>
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention fw-bold px-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                <!--begin:Menu item-->
                <div class="menu-item @if(Request::is('administrator')) here @endif  menu-accordion ">
                    <a class="menu-link" href="{{url('administrator')}}"> 
                            <span class="menu-icon">
                                <i class="ki-outline ki-category fs-2"></i>
                            </span>
                            <span class="menu-title">Dashboards</span>
                            <span class="menu-arrow"></span> 
                    </a>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item @if(Request::is('administrator/user') || Request::is('administrator/role') || Request::is('administrator/permission')) here  hover show @endif  menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-category fs-2"></i>
                        </span>
                        <span class="menu-title">User</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link @if(Request::is('administrator/user*')) active @endif" href="{{url('administrator/user')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">User</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                                <a class="menu-link @if(Request::is('administrator/role*')) active @endif" href="{{url('administrator/role')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Roles</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link @if(Request::is('administrator/permission*')) active @endif" href="{{url('administrator/permission')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Permissions</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item--> 
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item  @if(Request::is('administrator/location*')) here  hover show @endif menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-some-files fs-2"></i>
                        </span>
                        <span class="menu-title">Locations</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <!--begin:Menu link-->
                                <a class="menu-link @if(Request::is('administrator/location*')) active @endif" href="{{url('administrator/location')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Location</span>
                            </a>
                            <!--end:Menu link-->
                        </div>

                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link @if(Request::is('administrator/location/category*')) active @endif" href="{{url('administrator/location/category')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Categories</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link @if(Request::is('administrator/location/sub-category*')) active @endif" href="{{url('administrator/location/sub-category')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Sub Categories</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link @if(Request::is('administrator/location/type*')) active @endif" href="{{url('administrator/location/type')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Location Types</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                                <a class="menu-link @if(Request::is('administrator/location/map')) active @endif" href="{{url('administrator/location/map')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Location Map View</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item--> 
                         
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                
                <!-- Begin::App Slider Menu Item -->
                <div class="menu-item @if(Request::is('administrator/slider*')) here @endif menu-accordion">
                    <a class="menu-link" href="{{url('administrator/slider')}}"> 
                        <span class="menu-icon">
                            <i class="ki-outline ki-picture fs-2"></i>
                        </span>
                        <span class="menu-title">App Slider</span>
                        <span class="menu-arrow"></span> 
                    </a>
                </div>
                <!-- End::App Slider Menu Item -->
                
                <div class="menu-item  @if(Request::is('administrator/premium*')) here @endif menu-accordion">
                    <a class="menu-link" href="{{url('administrator/premium')}}"> 
                            <span class="menu-icon">
                                <i class="ki-outline ki-category fs-2"></i>
                            </span>
                            <span class="menu-title">Premium</span>
                            <span class="menu-arrow"></span> 
                    </a>
                </div>
                <div class="menu-item  @if(Request::is('administrator/transaction*')) here @endif menu-accordion">
                    <a class="menu-link" href="{{url('administrator/transaction')}}"> 
                            <span class="menu-icon">
                                <i class="ki-outline ki-category fs-2"></i>
                            </span>
                            <span class="menu-title">Transactions</span>
                            <span class="menu-arrow"></span> 
                    </a>
                </div>
                <div class="menu-item  @if(Request::is('administrator/report*')) here @endif menu-accordion">
                    <a class="menu-link" href="{{url('administrator/report')}}"> 
                            <span class="menu-icon">
                                <i class="ki-outline ki-category fs-2"></i>
                            </span>
                            <span class="menu-title">Report</span>
                            <span class="menu-arrow"></span> 
                    </a>
                </div>
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer d-flex align-items-center px-8 pb-10" id="kt_app_sidebar_footer">
        <!--begin::User-->
        <div class="">
            <!--begin::User info-->
            <div class="d-flex align-items-center" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-overflow="true" data-kt-menu-placement="top-start">
                <div class="d-flex flex-center cursor-pointer symbol symbol-circle symbol-40px">
                    <img src="{{Auth::user()->avatar_url ? Storage::disk('s3')->url(Auth::user()->avatar_url) : asset('assets/media/avatars/300-1.jpg')}}" alt="image" />
                </div>
                <!--begin::Name-->
                <div class="d-flex flex-column align-items-start justify-content-center ms-3">
                    <span class="text-gray-500 fs-8 fw-semibold">Hello</span>
                    <a href="#" class="text-gray-800 fs-7 fw-bold text-hover-primary">{{Auth::user()->name}}</a>
                </div>
                <!--end::Name-->
            </div>
            <!--end::User info-->
            <!--begin::User account menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-50px me-5">
                            <img alt="Logo" src="{{Auth::user()->avatar_url ? Storage::disk('s3')->url(Auth::user()->avatar_url) : asset('assets/media/avatars/300-1.jpg')}}" />
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Username-->
                        <div class="d-flex flex-column">
                            <div class="fw-bold d-flex align-items-center fs-5">{{Auth::user()->name}} 
                            <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">{{ auth()->user()->roles->first()?->name ?? 'N/A' }}</span></div>
                            <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{Auth::user()->email}}</a>
                        </div>
                        <!--end::Username-->
                    </div>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                
                
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="{{url('logout')}}" class="menu-link px-5">Log Out</a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::User account menu-->
        </div>
        <!--end::User-->
    </div>
    <!--end::Footer-->
</div>
<!--end::Sidebar-->