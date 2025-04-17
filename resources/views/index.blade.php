@extends('layouts.frontpage.app')
@section('title', 'Explore Nearby')
@section('styles')

<link rel="stylesheet" href="https://unpkg.com/@glidejs/glide@3.7.1/dist/css/glide.core.min.css" /> 
<link rel="stylesheet" href="https://unpkg.com/@glidejs/glide@3.7.1/dist/css/glide.theme.min.css" />
<style>
    .price-tag {
      position: relative;
      display: inline-block;
    }
    .price-tag::before {
      content: "$";
      font-size: 12px;
      position: relative;
      top: -2px;
    }
    .discount-badge {
      position: absolute;
      top: 10px;
      left: 10px;
      z-index: 10;
    }
    
    /* Style untuk fullwidth slider */
    .fullwidth-slider {
      width: 100vw;
      position: relative;
      left: 50%;
      right: 50%;
      margin-left: -50vw;
      margin-right: -50vw;
      overflow: hidden;
    }
    
    .fullwidth-slider .glide__track {
      width: 100%;
    }
    
    .fullwidth-slider .glide__slides {
      width: 100%;
    }
    
    .hero-slider {
      /* height: 240px; */
      width: 100%;
    }
    
    .hero-slider .glide__slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
    }
    
    @media (min-width: 768px) {
      .hero-slider {
        height: 480px;
      }
    }
    
    /* Perbaikan untuk kontrol slider */
    .glide__arrows {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 100%;
      z-index: 10;
    }
    
    .glide__bullets {
      position: absolute;
      bottom: 20px;
      width: 100%;
      z-index: 10;
      display: flex;
      justify-content: center;
    }
    
    /* Small slider styling */
    .small-slider { 
      width: 100%;
      padding: 20px 0;
    }
    
    /* Style untuk food category slider */
    .food-category-swiper {
      width: 100%;
      overflow: hidden;
      padding: 10px 0;
    }
    
    .food-category-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 5px;
      cursor: pointer;
      transition: transform 0.2s;
    }
    
    .food-category-item:hover {
      transform: translateY(-5px);
    }
    
    .food-category-img {
      width: 64px;
      height: 64px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 8px;
      border: 2px solid transparent;
      transition: border-color 0.2s;
    }
    
    .food-category-item:hover .food-category-img {
      border-color: #7e22ce; /* Color primary (dapat disesuaikan) */
    }
    
    .food-category-name {
      font-size: 14px;
      font-weight: 500;
      margin-top: 5px;
      color: #333;
      transition: color 0.2s;
    }
    
    .food-category-item:hover .food-category-name {
      color: #7e22ce; /* Color primary (dapat disesuaikan) */
    }
    
    .food-category-item.active .food-category-img {
      border-color: #7e22ce;
      box-shadow: 0 0 0 2px rgba(126, 34, 206, 0.2);
    }
    
    .food-category-item.active .food-category-name {
      font-weight: 700;
      color: #7e22ce;
    }
    
    @media (min-width: 768px) {
      .food-category-img {
        width: 100px;
        height: 100px;
      }
      
      .food-category-name {
        font-size: 16px;
      }
    }
    
    /* Style untuk swiper category */
    .swiper-category {
        width: 100%;
        overflow: hidden;
    }
    
    .swiper-category .swiper-slide {
        width: auto !important;
        margin-right: 10px;
    }
    
    .swiper-category .badge {
        cursor: pointer;
        font-size: 14px;
        padding: 8px 16px;
        white-space: nowrap;
    }
    
    .swiper-category .badge:hover {
        opacity: 0.9;
    }
</style>
@endsection
@section('content') 
<!-- Hero Fullwidth Slider -->
<div class="h-18 md:hidden"></div>
<div class="fullwidth-slider px-5">
  <div class="glide hero-slider">
    <div class="glide__track" data-glide-el="track">
      <ul class="glide__slides">
        <li class="glide__slide"> 
          <img src="https://picsum.photos/1600/800?random=1" alt="Hero Image 1">
        </li>
        <li class="glide__slide"> 
          <img src="https://picsum.photos/1600/800?random=2" alt="Hero Image 2">
        </li>
        <li class="glide__slide"> 
          <img src="https://picsum.photos/1600/800?random=3" alt="Hero Image 3">
        </li>
      </ul>
    </div>
    
    <div class="glide__bullets" data-glide-el="controls[nav]">
      <button class="glide__bullet" data-glide-dir="=0"></button>
      <button class="glide__bullet" data-glide-dir="=1"></button>
      <button class="glide__bullet" data-glide-dir="=2"></button>
    </div>
    
    <div class="glide__arrows" data-glide-el="controls">
      <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="ri-arrow-left-line"></i></button>
      <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="ri-arrow-right-line"></i></button>
    </div>
  </div>
</div>

<!-- Small Slider -->
<div class="flex px-5">
  <div class="glide small-slider">
    <div class="glide__track" data-glide-el="track">
      <ul class="glide__slides">
        <li class="glide__slide"> 
          <img src="https://picsum.photos/400/150?random=4" alt="Small Image 1">
        </li>
        <li class="glide__slide"> 
          <img src="https://picsum.photos/400/150?random=5" alt="Small Image 2">
        </li>
        <li class="glide__slide"> 
          <img src="https://picsum.photos/400/150?random=6" alt="Small Image 3">
        </li>
        <li class="glide__slide"> 
          <img src="https://picsum.photos/400/150?random=7" alt="Small Image 4">
        </li>
      </ul>
    </div>
  </div>
</div>
 

  <!-- Map Section -->
  <div class="container mx-auto px-5 py-8">
    <h2 class="text-2xl font-bold mb-4">Jelajahi Sekitar</h2>
    <div id="index-map" class="w-full h-[400px] rounded-lg shadow-lg max-w-full z-10"></div>
  </div>

  <!-- Location Categories -->
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-bold">Kategori Makanan</h2>
      <a href="#" class="btn btn-sm btn-outline">
        Lainnya <i class="ri-arrow-right-line ml-1"></i>
      </a>
    </div>
    
    <!-- Food Category Swiper -->
    <div class="swiper mx-auto px-4 py-8 food-category-swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <a href="#" class="food-category-item">
            <img src="https://picsum.photos/64/64?random=20" alt="Satay" class="food-category-img">
            <span class="food-category-name">Satay</span>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="food-category-item">
            <img src="https://picsum.photos/64/64?random=21" alt="Rice" class="food-category-img">
            <span class="food-category-name">Rice</span>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="food-category-item">
            <img src="https://picsum.photos/64/64?random=22" alt="Chicken" class="food-category-img">
            <span class="food-category-name">Chicken</span>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="food-category-item">
            <img src="https://picsum.photos/64/64?random=23" alt="Halal Certified" class="food-category-img">
            <span class="food-category-name">Halal</span>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="food-category-item">
            <img src="https://picsum.photos/64/64?random=24" alt="Japanese" class="food-category-img">
            <span class="food-category-name">Japanese</span>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="food-category-item">
            <img src="https://picsum.photos/64/64?random=25" alt="Italian" class="food-category-img">
            <span class="food-category-name">Italian</span>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="food-category-item">
            <img src="https://picsum.photos/64/64?random=26" alt="Seafood" class="food-category-img">
            <span class="food-category-name">Seafood</span>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="food-category-item">
            <img src="https://picsum.photos/64/64?random=27" alt="Fast Food" class="food-category-img">
            <span class="food-category-name">Fast Food</span>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="food-category-item">
            <img src="https://picsum.photos/64/64?random=28" alt="Vegetarian" class="food-category-img">
            <span class="food-category-name">Vegetarian</span>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="food-category-item">
            <img src="https://picsum.photos/64/64?random=29" alt="Dessert" class="food-category-img">
            <span class="food-category-name">Dessert</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Location Grid -->
  <div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
      <!-- Column 1: Nearby Locations -->
      <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
          <h2 class="card-title">Nearby Locations</h2>
          <ul class="space-y-4">
            <li class="flex items-center space-x-3">
              <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                  <img src="https://picsum.photos/100/100?random=1" alt="Location" />
                </div>
              </div>
              <div>
                <h3 class="font-medium">Coffee Shop</h3>
                <p class="text-sm text-gray-500">0.5 km away</p>
              </div>
            </li>
            <li class="flex items-center space-x-3">
              <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                  <img src="https://picsum.photos/100/100?random=2" alt="Location" />
                </div>
              </div>
              <div>
                <h3 class="font-medium">Restaurant</h3>
                <p class="text-sm text-gray-500">0.8 km away</p>
              </div>
            </li>
            <li class="flex items-center space-x-3">
              <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                  <img src="https://picsum.photos/100/100?random=3" alt="Location" />
                </div>
              </div>
              <div>
                <h3 class="font-medium">Bakery</h3>
                <p class="text-sm text-gray-500">1.2 km away</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
      
      <!-- Column 2: Legend -->
      <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
          <h2 class="card-title">Legend</h2>
          <ul class="space-y-4">
            <li class="flex items-center space-x-3">
              <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                  <img src="https://picsum.photos/100/100?random=4" alt="Location" />
                </div>
              </div>
              <div>
                <h3 class="font-medium">Shopping Mall</h3>
                <p class="text-sm text-gray-500">2.5 km away</p>
              </div>
            </li>
            <li class="flex items-center space-x-3">
              <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                  <img src="https://picsum.photos/100/100?random=5" alt="Location" />
                </div>
              </div>
              <div>
                <h3 class="font-medium">Hotel</h3>
                <p class="text-sm text-gray-500">3.0 km away</p>
              </div>
            </li>
            <li class="flex items-center space-x-3">
              <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                  <img src="https://picsum.photos/100/100?random=6" alt="Location" />
                </div>
              </div>
              <div>
                <h3 class="font-medium">Gym</h3>
                <p class="text-sm text-gray-500">1.8 km away</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
      
      <!-- Column 3: New Viral Locations -->
      <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
          <h2 class="card-title">New Viral Locations</h2>
          <ul class="space-y-4">
            <li class="flex items-center space-x-3">
              <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                  <img src="https://picsum.photos/100/100?random=7" alt="Location" />
                </div>
              </div>
              <div>
                <h3 class="font-medium">Trendy Cafe</h3>
                <p class="text-sm text-gray-500">4.2 km away</p>
              </div>
            </li>
            <li class="flex items-center space-x-3">
              <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                  <img src="https://picsum.photos/100/100?random=8" alt="Location" />
                </div>
              </div>
              <div>
                <h3 class="font-medium">Art Gallery</h3>
                <p class="text-sm text-gray-500">5.0 km away</p>
              </div>
            </li>
            <li class="flex items-center space-x-3">
              <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                  <img src="https://picsum.photos/100/100?random=9" alt="Location" />
                </div>
              </div>
              <div>
                <h3 class="font-medium">Pop-up Market</h3>
                <p class="text-sm text-gray-500">2.7 km away</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
      
      <!-- Column 4: Featured Locations -->
      <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
          <h2 class="card-title">Featured Locations</h2>
          <ul class="space-y-4">
            <li class="flex items-center space-x-3">
              <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                  <img src="https://picsum.photos/100/100?random=10" alt="Location" />
                </div>
              </div>
              <div>
                <h3 class="font-medium">Luxury Hotel</h3>
                <p class="text-sm text-gray-500">6.5 km away</p>
              </div>
            </li>
            <li class="flex items-center space-x-3">
              <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                  <img src="https://picsum.photos/100/100?random=11" alt="Location" />
                </div>
              </div>
              <div>
                <h3 class="font-medium">Fine Dining</h3>
                <p class="text-sm text-gray-500">3.8 km away</p>
              </div>
            </li>
            <li class="flex items-center space-x-3">
              <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                  <img src="https://picsum.photos/100/100?random=12" alt="Location" />
                </div>
              </div>
              <div>
                <h3 class="font-medium">Wellness Spa</h3>
                <p class="text-sm text-gray-500">4.5 km away</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- CTA Section -->
  <div class="bg-primary py-12">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="card card-md card-border bg-base-100 shadow-sm">
          <div class="card-body">
            <h2 class="card-title">Are you a user?</h2>
            <p>Register to save your favorite locations and create collections.</p>
            <div class="card-actions justify-end">
              <a href="/register" class="btn btn-primary">Register Now</a>
            </div>
          </div>
        </div>
        
        <div class="card card-md card-border bg-base-100 shadow-sm">
          <div class="card-body">
            <h2 class="card-title">Are you a business owner?</h2>
            <p>List your business on Simple to reach more customers.</p>
            <div class="card-actions justify-end">
              <a href="/merchant/register" class="btn btn-primary">Register as Merchant</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- This section intentionally left empty as footer is now included in the app layout -->

@endsection
@section('scripts') 
  <!-- Add Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

  <script src="https://unpkg.com/@glidejs/glide@3.7.1/dist/glide.min.js"></script>
  <!-- Add Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
          integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
          crossorigin=""></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Inisialisasi Hero Slider (pastikan elemen ada di DOM)
      if (document.querySelector('.hero-slider')) {
        const heroSlider = new Glide('.hero-slider', {
          type: 'carousel',
          autoplay: 5000,
          animationDuration: 800,
          gap: 0,
          perView: 1,
          hoverpause: false
        }).mount();
      }

      // Inisialisasi Small Slider (pastikan elemen ada di DOM)
      if (document.querySelector('.small-slider')) {
        const smallSlider = new Glide('.small-slider', {
            type: 'carousel', 
            perView: 4,
            breakpoints: {
              1024: {
                perView: 4
              },
              600: {
                perView: 2
              }
            },
            gap: 10,
            animationDuration: 800
        }).mount();
      }

      // Food Category Swiper
      if (document.querySelector('.food-category-swiper')) {
        const foodCategorySwiper = new Swiper('.food-category-swiper', {
          slidesPerView: 4.5,
          spaceBetween: 10,
          freeMode: true,
          loop: false,
          grabCursor: true,
          breakpoints: {
            // when window width is >= 640px
            640: {
              slidesPerView: 6.5,
              spaceBetween: 15
            },
            // when window width is >= 768px
            768: {
              slidesPerView: 7.5,
              spaceBetween: 15
            },
            // when window width is >= 1024px
            1024: {
              slidesPerView: 9.5,
              spaceBetween: 20
            }
          }
        });
        
        // Event listener untuk kategori makanan
        document.querySelectorAll('.food-category-item').forEach(item => {
          item.addEventListener('click', function(e) {
            // Prevent default hanya jika kita ingin custom behavior
            // e.preventDefault(); 
            
            // Reset semua item ke default style
            document.querySelectorAll('.food-category-item').forEach(i => {
              i.classList.remove('active');
            });
            
            // Tandai item yang diklik sebagai active
            this.classList.add('active');
            
            const categoryName = this.querySelector('.food-category-name').textContent;
            console.log('Kategori dipilih:', categoryName);
            
            // Disini bisa ditambahkan logika filter atau navigasi berdasarkan kategori
            // window.location.href = '/category/' + categoryName.toLowerCase();
          });
        });
      }

      // Initialize map
      if (document.getElementById('index-map')) {
        const map = L.map('index-map').setView([-6.2088, 106.8456], 13); // Jakarta coordinates

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add sample markers
        const locations = [
          { lat: -6.2088, lng: 106.8456, name: "Coffee Shop", type: "cafe" },
          { lat: -6.2100, lng: 106.8470, name: "Restaurant", type: "food" },
          { lat: -6.2070, lng: 106.8440, name: "Shopping Mall", type: "shopping" },
          { lat: -6.2050, lng: 106.8430, name: "Bakery", type: "food" },
          { lat: -6.2120, lng: 106.8450, name: "Hotel", type: "accommodation" }
        ];

        locations.forEach(location => {
          const marker = L.marker([location.lat, location.lng]).addTo(map);
          marker.bindPopup(`<b>${location.name}</b><br>${location.type}`);
        });
      }
      
      // Back to top button
      const backToTopButton = document.getElementById('backtotop');
      
      if (backToTopButton) {
        window.addEventListener('scroll', () => {
          if (window.pageYOffset > 300) {
            backToTopButton.classList.remove('hidden');
          } else {
            backToTopButton.classList.add('hidden');
          }
        });
        
        backToTopButton.addEventListener('click', () => {
          window.scrollTo({
            top: 0,
            behavior: 'smooth'
          });
        });
      }
      
      // Initialize Feather icons 
      if (typeof feather !== 'undefined') {
        feather.replace();
      }
    });
  </script>
@endsection
