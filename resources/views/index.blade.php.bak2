<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Simple - Connecting Maps and People</title>
        <!-- Styles -->
        @include('layouts.frontpage.styles')  
        <link rel="stylesheet" href="https://unpkg.com/@glidejs/glide@3.7.1/dist/css/glide.core.min.css" /> 
        <link rel="stylesheet" href="https://unpkg.com/@glidejs/glide@3.7.1/dist/css/glide.theme.min.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
        
    </head>
    <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
        @include('layouts.frontpage.preloader')

        <!-- Start Navbar Area -->
        @include('layouts.frontpage.navbar')
        <!-- End Navbar Area -->

        <!-- Start Banner Area -->
        <div class="hero-main"> 
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border-0 rounded-3 p-5 position-relative mb-4" style="background-color: #4936F5 !important;">
                            <img src="assets/images/shape-3.png" class="position-absolute top-0 end-0" alt="shape">
                            <h1 class="text-white fw-bold d-block mb-2">Temukan Lokasi Dengan Simple</h1>
                            <h3 class="fw-normal text-white mb-5">Jelajahi lebih dari 10.000+ UMKM lokal, dari industri rumahan sampai supplier berskala industri yang ada di sekitar Anda.</h3>
                             
                            <!-- Start Search Form -->
                            <div class="search-form-container mb-1">
                                <form action="#" method="GET" class="search-form">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg rounded-start" name="keyword" placeholder="Cari lokasi, UMKM, atau kategori..." aria-label="Cari">
                                        
                                        <button class="btn btn-secondary btn-lg rounded-end" type="submit">
                                            <i class="ri-search-line me-1"></i> Cari
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- End Search Form -->
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner Area -->

          
        <!-- Start Key Features Area -->
        <div class="key-features-area pb-50">
            <div class="container"> 
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="glide small-slider">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">
                                    <li class="glide__slide">
                                        <div class="card">
                                            <img src="https://picsum.photos/1200/500?random=1" class="card-img-top" alt="...">
                                            <div class="card-body">
                                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                          </div>
                                    </li>
                                    <li class="glide__slide">
                                        <div class="card">
                                            <img src="https://picsum.photos/1200/500?random=1" class="card-img-top" alt="...">
                                            <div class="card-body">
                                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                          </div>
                                    </li>
                                    <li class="glide__slide">
                                        <div class="card">
                                            <img src="https://picsum.photos/1200/500?random=1" class="card-img-top" alt="...">
                                            <div class="card-body">
                                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                          </div>
                                    </li>
                                    <li class="glide__slide">
                                        <div class="card">
                                            <img src="https://picsum.photos/1200/500?random=1" class="card-img-top" alt="...">
                                            <div class="card-body">
                                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                          </div> 
                                    </li>
                                    <li class="glide__slide">
                                        <div class="card">
                                            <img src="https://picsum.photos/1200/500?random=1" class="card-img-top" alt="...">
                                            <div class="card-body">
                                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                          </div>
                                    </li>
                                </ul>
                            </div>
                            
                        </div> 
                    </div> 
                   
                    
                </div>
            </div>
        </div>
        <!-- End Key Features Area -->

        <!-- Start Tailor Area -->
        <div class="tailor-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div id="index-map"></div>
                    </div>
                   

                </div>
            </div> 
        </div>
        <!-- End Tailor Area -->
 
        
 
        <!-- Start Unlock Area -->
        <div class="unlock-area ptb-150 position-relative z-1" id="admin">
            <div class="container">
                <div class="border-bottom pb-150">
                    <div class="row">
                        <div class="unlock-content">
                            <h2>Unlock a world of possibilities with Trezo Dashboard.</h2>
                            <p>Experience the difference with Trezo Dashboard. Sign up for a free trial today and see how our intuitive platform can revolutionize your data analysis process.</p>
                            <a href="pricing-plan" class="btn btn-primary-div py-2 px-4 fs-16 fw-medium rounded-3 text-white">
                                <i class="ri-user-line fs-18"></i>
                                <span class="ms-1">Get started - It is free</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <img src="assets/images/landing/shape-1.png" class="shape shape-5" alt="shape">
            <img src="assets/images/landing/shape-2.png" class="shape shape-6" alt="shape">
        </div>
        <!-- End Unlock Area -->

        <!-- Start Forter Area -->
        <div class="footers-area pb-125 position-relative z-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-single-item mb-4">
                            <a href="#" class="footer-logo d-inline-block mb-4">
                                <img src="assets/images/landing/logo.svg" alt="logo">
                            </a>
                            <p class="mb-4 pb-lg-2">With customizable dashboards tailored to your needs, collaborate effortlessly with your team and stay ahead with real-time updates.</p>

                            <ul class="ps-0 mb-0 list-unstyled d-flex flex-wrap gap-3">
                                <li>
                                    <a href="https://www.facebook.com/" target="_blank" class="text-decoration-none fs-20 text-primary">
                                        <i class="ri-facebook-fill"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.twitter.com/" target="_blank" class="text-decoration-none fs-20 text-primary">
                                        <i class="ri-twitter-x-line"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/" target="_blank" class="text-decoration-none fs-20 text-primary">
                                        <i class="ri-linkedin-fill"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.dribbble.com/" target="_blank" class="text-decoration-none fs-20 text-primary">
                                        <i class="ri-dribbble-line"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-single-item mb-4 ms-lg-5 ps-lg-5">
                            <h3 class="mb-md-4 mb-3 fw-semibold">Our Products</h3>
                            <ul class="ps-0 mb-0 list-unstyled">
                                <li class="mb-2 pb-1">
                                    <a href="#" class="text-decoration-none">Trezo Dashboard</a>
                                </li>
                                <li class="mb-2 pb-1">
                                    <a href="#" class="text-decoration-none">Tagus Admin</a>
                                </li>
                                <li class="mb-2 pb-1">
                                    <a href="#" class="text-decoration-none">eCademy LMS</a>
                                </li>
                                <li class="mb-0">
                                    <a href="#" class="text-decoration-none">Admash Template</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-single-item mb-4 ms-lg-5 ps-lg-4">
                            <h3 class="mb-md-4 mb-3 fw-semibold">Quick Links</h3>
                            <ul class="ps-0 mb-0 list-unstyled">
                                <li class="mb-2 pb-1">
                                    <a href="#" class="text-decoration-none">Home</a>
                                </li>
                                <li class="mb-2 pb-1">
                                    <a href="#" class="text-decoration-none">Features</a>
                                </li>
                                <li class="mb-2 pb-1">
                                    <a href="#" class="text-decoration-none">Testimonials</a>
                                </li>
                                <li class="mb-0">
                                    <a href="#" class="text-decoration-none">Our Team</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-single-item mb-4">
                            <h3 class="mb-md-4 mb-3 fw-semibold">Privacy Policy</h3>
                            <ul class="ps-0 mb-0 list-unstyled">
                                <li class="mb-2 pb-1">
                                    <a href="#" class="text-decoration-none">Terms & Conditions</a>
                                </li>
                                <li class="mb-2 pb-1">
                                    <a href="#" class="text-decoration-none">Cookie Policy</a>
                                </li>
                                <li class="mb-2 pb-1">
                                    <a href="#" class="text-decoration-none">Notice at Collection</a>
                                </li>
                                <li class="mb-0">
                                    <a href="#" class="text-decoration-none">Privacy Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Forter Area -->

        <!-- Start CopyRight Area -->
        <div class="copyright-area bg-white text-center py-4">
            <div class="container">
                <p class="fs-14">© <span class="text-primary-div">Trezo</span> is Proudly Owned by <a href="https://envytheme.com/" target="_blank" class="text-decoration-none text-primary">EnvyTheme</a></p>
            </div>
        </div>
        <!-- End CopyRight Area -->

        <!-- Start Back To Up Area -->
		<button type="button" id="backtotop"> 
			<i class="ri-arrow-up-s-line"></i>
		</button>
		<!-- End Back To Up Area -->

        @include('layouts.frontpage.scripts')  
        <script src="https://unpkg.com/@glidejs/glide@3.7.1/dist/glide.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
        <script>
             
	const map = L.map('index-map').setView([51.505, -0.09], 13);

const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

const marker = L.marker([51.5, -0.09]).addTo(map);

const circle = L.circle([51.508, -0.11], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 500
}).addTo(map);

const polygon = L.polygon([
    [51.509, -0.08],
    [51.503, -0.06],
    [51.51, -0.047]
]).addTo(map);



        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() { 

                new Glide('.small-slider', {
                    type: 'carousel', 
                    perView : 4,
                    breakpoints: {
                    1024: {
                    perView: 3
                    },
                    600: {
                    perView: 2
                    }
                    },
                    gap: 10,
                    animationDuration: 800
                }).mount();
            });
        </script>
    </body>
</html>
