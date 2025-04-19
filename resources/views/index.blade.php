@extends('layouts.frontpage.app')
@section('title', 'Explore Nearby')
@section('styles')

<link rel="stylesheet" href="https://unpkg.com/@glidejs/glide@3.7.1/dist/css/glide.core.min.css" /> 
<link rel="stylesheet" href="https://unpkg.com/@glidejs/glide@3.7.1/dist/css/glide.theme.min.css" />
<style> 
    /* Styling for Loading Skeleton */
    .skeleton-card { @apply bg-white border border-gray-200 rounded-lg p-3 flex space-x-3; }
    .skeleton-img { @apply w-20 h-20 rounded bg-gray-200 animate-pulse; }
    .skeleton-line { @apply h-4 bg-gray-200 rounded animate-pulse mb-2; }

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
      height: 250px; /* Tinggi default untuk mobile */
      width: 100%;
      overflow: hidden; /* Pastikan tidak ada overflow */
    }
    
    .hero-slider .glide__track,
    .hero-slider .glide__slides,
    .hero-slider .glide__slide {
      height: 100%; /* Full height dari slider */
    }
    
    .hero-slider .glide__slide {
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    
    .hero-slider .glide__slide img {
      width: auto; /* Width auto */
      height: 100%; /* Height 100% dari container */
      object-fit: cover;
      object-position: center;
      min-width: 100%; /* Pastikan gambar paling tidak menutupi seluruh slide */
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
      .hero-slider {
        height: 400px; /* Tinggi untuk large devices */
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
<div class="container mx-auto px-5 md:px-10">
  <div class="glide hero-slider">
    <div class="glide__track" data-glide-el="track">
      <ul class="glide__slides">
        @foreach ($sliders as $slider)
        <li class="glide__slide"> 
          <img src="{{ $slider->getImageUrl() }}" alt="{{ $slider->slider_title }}">
        </li>
        @endforeach
         
      </ul>
    </div>
    
    <div class="glide__bullets" data-glide-el="controls[nav]">
      @foreach ($sliders as $loop => $slider)
      <button class="glide__bullet" data-glide-dir="{{ $loop->index }}"></button>
      @endforeach 
    </div>
    
    <div class="glide__arrows" data-glide-el="controls">
      <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="ri-arrow-left-s-line"></i></button>
      <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="ri-arrow-right-s-line"></i></button>
    </div>
  </div>
</div>

<!-- Small Slider -->
<div class="container mx-auto flex px-5 md:px-10">
  <div class="glide small-slider">
    <div class="glide__track" data-glide-el="track">
      <ul class="glide__slides">
        <li class="glide__slide">  
          <a href="#"> 
            <div class="flex justify-between items-center">
              <div class="text-md font-bold mb-2 mr-2">Semua yang dicari ada disini</div> 
              <button href="#" class="btn btn-xs btn-neutral btn-outline btn-circle"><i class="ri-arrow-right-s-line"></i></button>
            </div>
            <img src="https://picsum.photos/400/150?random=4" class="w-full h-auto rounded-md" alt="Small Image 1">
            <div class="text-md mb-2 mr-2">Belanja berkali-kali tetap hemat</div>
          </a> 
        </li>
        <li class="glide__slide"> 
          <a href="#"> 
            <div class="flex justify-between items-center">
              <div class="text-md font-bold mb-2 mr-2">Semua yang dicari ada disini</div> 
              <button href="#" class="btn btn-xs btn-neutral btn-outline btn-circle"><i class="ri-arrow-right-s-line"></i></button>
            </div>
            <img src="https://picsum.photos/400/150?random=5" class="w-full h-auto rounded-md" alt="Small Image 1">
            <div class="text-md mb-2 mr-2">Belanja berkali-kali tetap hemat</div>
          </a> 
        </li>
        <li class="glide__slide"> 
          <a href="#"> 
            <div class="flex justify-between items-center">
              <div class="text-md font-bold mb-2 mr-2">Semua yang dicari ada disini</div> 
              <button href="#" class="btn btn-xs btn-neutral btn-outline btn-circle"><i class="ri-arrow-right-s-line"></i></button>
            </div>
            <img src="https://picsum.photos/400/150?random=5" class="w-full h-auto rounded-md" alt="Small Image 1">
            <div class="text-md mb-2 mr-2">Belanja berkali-kali tetap hemat</div>
          </a> 
        </li>
        <li class="glide__slide"> 
          <a href="#"> 
            <div class="flex justify-between items-center">
              <div class="text-md font-bold mb-2 mr-2">Semua yang dicari ada disini</div> 
              <button href="#" class="btn btn-xs btn-neutral btn-outline btn-circle"><i class="ri-arrow-right-s-line"></i></button>
            </div>
            <img src="https://picsum.photos/400/150?random=5" class="w-full h-auto rounded-md" alt="Small Image 1">
            <div class="text-md mb-2 mr-2">Belanja berkali-kali tetap hemat</div>
          </a> 
        </li>
      </ul>
    </div>
  </div>
</div>
 

  <div class="container mx-auto px-5 md:px-10 pb-8"> 
      <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
        <!-- Column 1: Nearby Locations -->  
        <div>
            <h2 class="font-bold mb-2">Top Search</h2>
            <ul class="space-y-4">
              <li class="flex-grow items-center space-x-3">
                <div class="bg-white border border-gray-200 rounded-lg p-3 flex space-x-3 hover:card-border transition-shadow duration-200">
                  <img src="https://placehold.co/100x100/e2e8f0/94a3b8?text=Gambar+1" alt="Warung Makan Sedap" class="w-20 h-20 rounded object-cover flex-shrink-0" loading="lazy">
                  <div class="flex-grow">
                      <div class="flex justify-between items-start mb-1"> <h3 class="text-md font-semibold text-gray-800">Warung Makan Sedap <span class="text-primary flex-shrink-0" title="Verified Gold"><i class="ri-checkbox-circle-line"></i></span></h3></div>
                      <p class="text-xs text-gray-500 mb-1">± 0.5km &middot; Makanan / Rumahan</p>  
                      <div class="flex justify-between items-center">
                          <div class="flex space-x-2 text-gray-500"> 
                            <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Lihat di Peta" onclick="alert('Tombol Lihat Peta diklik untuk: Warung Makan Sedap')"><i class="ri-map-2-line"></i></button> 
                            <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Telepon" onclick="alert('Tombol Telepon diklik untuk: Warung Makan Sedap')"><i class="ri-phone-line"></i></button> 
                            <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="WA" onclick="alert('Tombol WA diklik untuk: Warung Makan Sedap')"><i class="ri-whatsapp-line"></i></button> 
                          </div>
                          <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="WA" onclick="alert('Tombol WA diklik untuk: Warung Makan Sedap')"><i class="ri-bookmark-line"></i></button> 
                      </div>
                  </div>
              </div>
              </li> 
            </ul> 
        </div>
        <!-- Column 2: Legend -->
        <div>
          <h2 class="font-bold mb-2">Top Search</h2>
          <ul class="space-y-4">
            <li class="flex-grow items-center space-x-3">
              <div class="bg-white border border-gray-200 rounded-lg p-3 flex space-x-3 hover:card-border transition-shadow duration-200">
                <img src="https://placehold.co/100x100/e2e8f0/94a3b8?text=Gambar+1" alt="Warung Makan Sedap" class="w-20 h-20 rounded object-cover flex-shrink-0" loading="lazy">
                <div class="flex-grow">
                    <div class="flex justify-between items-start mb-1"> <h3 class="text-md font-semibold text-gray-800">Warung Makan Sedap <span class="text-primary flex-shrink-0" title="Verified Gold"><i class="ri-checkbox-circle-line"></i></span></h3></div>
                    <p class="text-xs text-gray-500 mb-1">± 0.5km &middot; Makanan / Rumahan</p>  
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-2 text-gray-500"> 
                          <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Lihat di Peta" onclick="alert('Tombol Lihat Peta diklik untuk: Warung Makan Sedap')"><i class="ri-map-2-line"></i></button> 
                          <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Telepon" onclick="alert('Tombol Telepon diklik untuk: Warung Makan Sedap')"><i class="ri-phone-line"></i></button> 
                          <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="WA" onclick="alert('Tombol WA diklik untuk: Warung Makan Sedap')"><i class="ri-whatsapp-line"></i></button> 
                        </div>
                        <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="WA" onclick="alert('Tombol WA diklik untuk: Warung Makan Sedap')"><i class="ri-bookmark-line"></i></button> 
                    </div>
                </div>
            </div>
            </li> 
          </ul> 
      </div>
        
        <!-- Column 3: New Viral Locations -->
        <div>
          <h2 class="font-bold mb-2">Top Search</h2>
          <ul class="space-y-4">
            <li class="flex-grow items-center space-x-3">
              <div class="bg-white border border-gray-200 rounded-lg p-3 flex space-x-3 hover:card-border transition-shadow duration-200">
                <img src="https://placehold.co/100x100/e2e8f0/94a3b8?text=Gambar+1" alt="Warung Makan Sedap" class="w-20 h-20 rounded object-cover flex-shrink-0" loading="lazy">
                <div class="flex-grow">
                    <div class="flex justify-between items-start mb-1"> <h3 class="text-md font-semibold text-gray-800">Warung Makan Sedap <span class="text-primary flex-shrink-0" title="Verified Gold"><i class="ri-checkbox-circle-line"></i></span></h3></div>
                    <p class="text-xs text-gray-500 mb-1">± 0.5km &middot; Makanan / Rumahan</p>  
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-2 text-gray-500"> 
                          <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Lihat di Peta" onclick="alert('Tombol Lihat Peta diklik untuk: Warung Makan Sedap')"><i class="ri-map-2-line"></i></button> 
                          <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Telepon" onclick="alert('Tombol Telepon diklik untuk: Warung Makan Sedap')"><i class="ri-phone-line"></i></button> 
                          <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="WA" onclick="alert('Tombol WA diklik untuk: Warung Makan Sedap')"><i class="ri-whatsapp-line"></i></button> 
                        </div>
                        <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="WA" onclick="alert('Tombol WA diklik untuk: Warung Makan Sedap')"><i class="ri-bookmark-line"></i></button> 
                    </div>
                </div>
            </div>
            </li> 
          </ul> 
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
                peek: {
                before: 0,
                after: 50 //
              },
            breakpoints: {
              1024: {
                perView: 2, 
                peek: {
                before: 0,
                after: 75 //
              }
              },
              600: {
                perView: 1,
                peek: {
                before: 0,
                after: 50 //
              }
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
