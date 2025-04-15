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
        @include('layouts.frontpage.bottomnav')
        <!-- End Navbar Area -->

        <!-- Start Banner Area -->
        <div class="banner-main"> 
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="glide main-slider">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">
                                    <li class="glide__slide">
                                        <img src="https://picsum.photos/1200/400?random=1" alt="Slider Image 1" class="img-fluid w-100">
                                    </li>
                                    <li class="glide__slide">
                                        <img src="https://picsum.photos/1200/400?random=2" alt="Slider Image 2" class="img-fluid w-100">
                                    </li>
                                    <li class="glide__slide">
                                        <img src="https://picsum.photos/1200/400?random=3" alt="Slider Image 3" class="img-fluid w-100">
                                    </li>
                                    <li class="glide__slide">
                                        <img src="https://picsum.photos/1200/400?random=4" alt="Slider Image 4" class="img-fluid w-100">
                                    </li>
                                    <li class="glide__slide">
                                        <img src="https://picsum.photos/1200/400?random=5" alt="Slider Image 5" class="img-fluid w-100">
                                    </li>
                                </ul>
                            </div>
                            <div class="glide__arrows" data-glide-el="controls">
                                <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
                                    <i data-feather="chevron-left"></i>
                                </button>
                                <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
                                    <i data-feather="chevron-right"></i>
                                </button>
                            </div>
                           
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
                    <div class="col-lg-12 py-2">
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
                        <div class="fs-24 text-dark fw-bold mb-2">Jelajahi Sekitar</div>
                        <div id="index-map"></div>
                    </div>
                   

                </div>
            </div> 
        </div>
        <!-- End Tailor Area -->
        <!-- Start Key Features Area -->
        <div class="key-features-area mt-2 pb-50">
            <div class="container"> 
                <div class="row justify-content-center">  
                        <div class="col-8 mb-2">
                            <div class="fs-24 text-dark fw-bold">Kategori Lokasi</div>
                        </div>
                        <div class="col-4 text-end mb-">
                            <a href="#" class="btn btn-sm btn-outline-primary">
                            Lainnya <i class="ri-arrow-right-line ms-1"></i>
                            </a>
                        </div>  
                    <div class="col-lg-2 col-md-2 col-4 mb-1">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-center p-3 hover-shadow">
                                <div class="icon-container mb-1">
                                    <i class="ri-store-2-line fs-1 text-primary"></i>
                                </div>
                                <div class="card-body p-0">
                                    <h5 class="card-title text-dark">Toko</h5>
                                </div>
                            </div>
                        </a>
                    </div> 
                    <div class="col-lg-2 col-md-2 col-4 mb-1">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-center p-3 hover-shadow">
                                <div class="icon-container mb-1">
                                    <i class="ri-store-2-line fs-1 text-primary"></i>
                                </div>
                                <div class="card-body p-0">
                                    <h5 class="card-title text-dark">Toko</h5>
                                </div>
                            </div>
                        </a>
                    </div> 
                    <div class="col-lg-2 col-md-2 col-4 mb-1">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-center p-3 hover-shadow">
                                <div class="icon-container mb-1">
                                    <i class="ri-store-2-line fs-1 text-primary"></i>
                                </div>
                                <div class="card-body p-0">
                                    <h5 class="card-title text-dark">Toko</h5>
                                </div>
                            </div>
                        </a>
                    </div> 
                    <div class="col-lg-2 col-md-2 col-4 mb-1">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-center p-3 hover-shadow">
                                <div class="icon-container mb-1">
                                    <i class="ri-store-2-line fs-1 text-primary"></i>
                                </div>
                                <div class="card-body p-0">
                                    <h5 class="card-title text-dark">Toko</h5>
                                </div>
                            </div>
                        </a>
                    </div> 
                    <div class="col-lg-2 col-md-2 col-4 mb-1">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-center p-3 hover-shadow">
                                <div class="icon-container mb-1">
                                    <i class="ri-store-2-line fs-1 text-primary"></i>
                                </div>
                                <div class="card-body p-0">
                                    <h5 class="card-title text-dark">Toko</h5>
                                </div>
                            </div>
                        </a>
                    </div> 
                    <div class="col-lg-2 col-md-2 col-4 mb-1">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-center p-3 hover-shadow">
                                <div class="icon-container mb-1">
                                    <i class="ri-store-2-line fs-1 text-primary"></i>
                                </div>
                                <div class="card-body p-0">
                                    <h5 class="card-title text-dark">Toko</h5>
                                </div>
                            </div>
                        </a>
                    </div> 
                
                    
                </div>
            </div>
        </div>
        <!-- End Key Features Area -->
        
  
 

        <!-- Start CopyRight Area -->
        <div class="copyright-area bg-white text-center py-4">
            <div class="container">
                <p class="fs-14">© <span class="text-primary-div">Simple</span></p>
            </div>
        </div>
        <!-- End CopyRight Area -->

        <!-- Start Back To Up Area -->
		<button type="button" id="backtotop"> 
			<i class="ri-arrow-up-s-line"></i>
		</button>
		<!-- End Back To Up Area -->

        @include('layouts.frontpage.scripts')  
        @include('layouts.frontpage.bottomnav')
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
                new Glide('.main-slider', {
                    type: 'carousel',
                    autoplay: 3000,
                    perView: 1,
                    gap: 0,
                    animationDuration: 800
                }).mount();

                new Glide('.small-slider', {
                    type: 'slider',
                    autoplay: 3000,
                    perView : 4,
                    peek: {        // Tampilkan sebagian slide tetangga
                    before: 0,   // Jumlah piksel slide sebelumnya yg terlihat
                    after: 50    // Jumlah piksel slide berikutnya yg terlihat (sesuaikan!)
                    },
                    // Alternatif peek: gunakan persentase -> peek: '15%'
                    gap: 15,       // Jarak antar slide (dalam px)
                    bound: true,   // Jika true, peek tidak akan melewati batas awal/akhir jika type='slider'
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
