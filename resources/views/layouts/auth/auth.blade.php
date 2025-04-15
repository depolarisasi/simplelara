<!DOCTYPE html> 
<html lang="en"> 
	<head> 
		<title>@yield('title', 'Authentication') - Simple</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Tailwind CSS & Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="tailwind, tailwindcss, metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="@section('title') - Simple" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Metronic by Keenthemes" />
		<link rel="canonical" href="http://preview.keenthemes.comauthentication/layouts/overlay/sign-in.html" />
		 @include('layouts.auth.authstyles')
         @yield('styles')
		<!--end::Global Stylesheets Bundle-->
	 
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
		 
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Page bg image-->
			<style>body { background-image: url('{{ asset('assets/media/auth/bg10.jpeg') }}'); } [data-bs-theme="dark"] body { background-image: url('{{ asset('assets/media/auth/bg10-dark.jpeg') }}'); }</style>
			<!--end::Page bg image-->

			<!--begin::Authentication -->
			<div class="d-flex flex-column flex-column-fluid min-vh-100 justify-content-center align-items-center p-10">
				<!--begin::Card wrapper-->
				<div class="d-flex flex-center">
					<!--begin::Card-->
					<div class="bg-body w-md-600px p-10 rounded shadow">
						@yield('content')
					</div>
					<!--end::Card-->
				</div>
				<!--end::Card wrapper-->
			</div>
			<!--end::Authentication-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->   
        @include('sweetalert::alert')
		@include('layouts.auth.authscripts')
        @yield('scripts')
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>