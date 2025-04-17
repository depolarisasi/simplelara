<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search - Simple</title>
    
    <!-- Styles -->
    @include('layouts.frontpage.styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body> 

    <!-- Navbar -->
    @include('layouts.frontpage.navbar')
    @include('layouts.frontpage.bottomnav')

    <!-- Search Section -->
    <div class="container mx-auto px-4 py-4 mt-16">
      <div class="form-control">
        <div class="input-group">
          <input type="text" placeholder="Search locations..." class="input input-bordered w-full" />
          <button class="btn btn-square">
            <i data-feather="search"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Category Filters -->
    <div class="container mx-auto px-4 py-2">
      <div class="dropdown">
        <label tabindex="0" class="btn m-1">Categories</label>
        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
          <li><a>Restaurants</a></li>
          <li><a>Cafes</a></li>
          <li><a>Shopping</a></li>
          <li><a>Services</a></li>
          <li><a>Entertainment</a></li>
        </ul>
      </div>
    </div>

    <!-- Subcategory Filter Chips -->
    <div class="container mx-auto px-4 py-2">
      <div class="flex overflow-x-auto space-x-2 py-2">
        <div class="badge badge-outline badge-lg">All</div>
        <div class="badge badge-primary badge-lg">Coffee</div>
        <div class="badge badge-outline badge-lg">Fast Food</div>
        <div class="badge badge-outline badge-lg">Fine Dining</div>
        <div class="badge badge-outline badge-lg">Bakery</div>
        <div class="badge badge-outline badge-lg">Street Food</div>
        <div class="badge badge-outline badge-lg">Dessert</div>
        <!-- More filter chips -->
      </div>
    </div>

    <!-- Search Results -->
    <div class="container mx-auto px-4 py-4">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Result Card 1 -->
        <div class="card card-side bg-base-100 shadow-xl">
          <figure class="w-1/3">
            <img src="https://picsum.photos/200/300?random=1" alt="Location" class="h-full object-cover" />
          </figure>
          <div class="card-body p-4">
            <h2 class="card-title text-lg">Coffee Shop</h2>
            <p class="text-sm">0.5 km away</p>
            <p class="text-sm">123 Main Street, Jakarta</p>
            <div class="flex space-x-2 mt-2">
              <a href="tel:+123456789" class="btn btn-circle btn-xs">
                <i data-feather="phone" class="w-3 h-3"></i>
              </a>
              <a href="https://example.com" class="btn btn-circle btn-xs">
                <i data-feather="globe" class="w-3 h-3"></i>
              </a>
              <a href="https://wa.me/123456789" class="btn btn-circle btn-xs">
                <i data-feather="message-circle" class="w-3 h-3"></i>
              </a>
            </div>
          </div>
        </div>
        
        <!-- Result Card 2 -->
        <div class="card card-side bg-base-100 shadow-xl">
          <figure class="w-1/3">
            <img src="https://picsum.photos/200/300?random=2" alt="Location" class="h-full object-cover" />
          </figure>
          <div class="card-body p-4">
            <h2 class="card-title text-lg">Restaurant</h2>
            <p class="text-sm">1.2 km away</p>
            <p class="text-sm">456 Oak Street, Jakarta</p>
            <div class="flex space-x-2 mt-2">
              <a href="tel:+123456789" class="btn btn-circle btn-xs">
                <i data-feather="phone" class="w-3 h-3"></i>
              </a>
              <a href="https://example.com" class="btn btn-circle btn-xs">
                <i data-feather="globe" class="w-3 h-3"></i>
              </a>
              <a href="https://wa.me/123456789" class="btn btn-circle btn-xs">
                <i data-feather="message-circle" class="w-3 h-3"></i>
              </a>
            </div>
          </div>
        </div>
        
        <!-- Result Card 3 -->
        <div class="card card-side bg-base-100 shadow-xl">
          <figure class="w-1/3">
            <img src="https://picsum.photos/200/300?random=3" alt="Location" class="h-full object-cover" />
          </figure>
          <div class="card-body p-4">
            <h2 class="card-title text-lg">Bakery</h2>
            <p class="text-sm">0.8 km away</p>
            <p class="text-sm">789 Pine Street, Jakarta</p>
            <div class="flex space-x-2 mt-2">
              <a href="tel:+123456789" class="btn btn-circle btn-xs">
                <i data-feather="phone" class="w-3 h-3"></i>
              </a>
              <a href="https://example.com" class="btn btn-circle btn-xs">
                <i data-feather="globe" class="w-3 h-3"></i>
              </a>
              <a href="https://wa.me/123456789" class="btn btn-circle btn-xs">
                <i data-feather="message-circle" class="w-3 h-3"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Pagination -->
      <div class="btn-group grid grid-cols-2 mt-8">
        <button class="btn btn-outline">Previous</button>
        <button class="btn btn-outline">Next</button>
      </div>
    </div>

    <!-- Footer -->
    <div class="footer p-10 bg-neutral text-neutral-content">
      <div>
        <span class="footer-title">Services</span> 
        <a class="link link-hover">Branding</a>
        <a class="link link-hover">Design</a>
        <a class="link link-hover">Marketing</a>
        <a class="link link-hover">Advertisement</a>
      </div> 
      <div>
        <span class="footer-title">Company</span> 
        <a class="link link-hover">About us</a>
        <a class="link link-hover">Contact</a>
        <a class="link link-hover">Jobs</a>
        <a class="link link-hover">Press kit</a>
      </div> 
      <div>
        <span class="footer-title">Legal</span> 
        <a class="link link-hover">Terms of use</a>
        <a class="link link-hover">Privacy policy</a>
        <a class="link link-hover">Cookie policy</a>
      </div>
    </div>
    <div class="footer footer-center p-4 bg-base-300 text-base-content">
      <div>
        <p>© 2025 Simple - All rights reserved</p>
      </div>
    </div>

    <!-- Scripts -->
    @include('layouts.frontpage.scripts')
    
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Initialize Feather icons
        feather.replace();
      });
    </script>
</body>
</html>