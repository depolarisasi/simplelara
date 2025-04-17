<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collections - Simple</title>
    
    <!-- Styles -->
    @include('layouts.frontpage.styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.frontpage.preloader')

    <!-- Navbar -->
    @include('layouts.frontpage.navbar')
    @include('layouts.frontpage.bottomnav')

    <!-- Collections Header -->
    <div class="container mx-auto px-4 py-8 mt-16">
        <h1 class="text-3xl font-bold">Your Collections</h1>
        <p class="text-gray-600 mt-2">Save and organize your favorite locations</p>
    </div>

    <!-- Collections Tabs -->
    <div class="container mx-auto px-4">
        <div class="tabs tabs-boxed mb-6">
            <a class="tab tab-active">All Collections</a>
            <a class="tab">Favorites</a>
            <a class="tab">Recently Viewed</a>
            <a class="tab">Custom Lists</a>
        </div>
    </div>

    <!-- Collections Grid -->
    <div class="container mx-auto px-4 py-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Collection Card 1 -->
            <div class="card bg-base-100 shadow-xl">
                <figure>
                    <img src="https://picsum.photos/400/200?random=10" alt="Collection" class="w-full h-48 object-cover" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">
                        Favorite Cafes
                        <div class="badge badge-secondary">8 places</div>
                    </h2>
                    <p>My collection of the best coffee shops in Jakarta</p>
                    <div class="flex -space-x-4 mt-2">
                        <div class="avatar">
                            <div class="w-8 h-8 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="https://picsum.photos/100/100?random=1" />
                            </div>
                        </div>
                        <div class="avatar">
                            <div class="w-8 h-8 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="https://picsum.photos/100/100?random=2" />
                            </div>
                        </div>
                        <div class="avatar">
                            <div class="w-8 h-8 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="https://picsum.photos/100/100?random=3" />
                            </div>
                        </div>
                        <div class="avatar placeholder">
                            <div class="w-8 h-8 rounded-full bg-neutral-focus text-neutral-content ring ring-primary ring-offset-base-100 ring-offset-2">
                                <span class="text-xs">+5</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-actions justify-end mt-4">
                        <button class="btn btn-primary btn-sm">View Collection</button>
                    </div>
                </div>
            </div>

            <!-- Collection Card 2 -->
            <div class="card bg-base-100 shadow-xl">
                <figure>
                    <img src="https://picsum.photos/400/200?random=11" alt="Collection" class="w-full h-48 object-cover" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">
                        Weekend Getaways
                        <div class="badge badge-secondary">5 places</div>
                    </h2>
                    <p>Places to visit during weekends near Jakarta</p>
                    <div class="flex -space-x-4 mt-2">
                        <div class="avatar">
                            <div class="w-8 h-8 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="https://picsum.photos/100/100?random=4" />
                            </div>
                        </div>
                        <div class="avatar">
                            <div class="w-8 h-8 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="https://picsum.photos/100/100?random=5" />
                            </div>
                        </div>
                        <div class="avatar">
                            <div class="w-8 h-8 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="https://picsum.photos/100/100?random=6" />
                            </div>
                        </div>
                        <div class="avatar placeholder">
                            <div class="w-8 h-8 rounded-full bg-neutral-focus text-neutral-content ring ring-primary ring-offset-base-100 ring-offset-2">
                                <span class="text-xs">+2</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-actions justify-end mt-4">
                        <button class="btn btn-primary btn-sm">View Collection</button>
                    </div>
                </div>
            </div>

            <!-- Collection Card 3 -->
            <div class="card bg-base-100 shadow-xl">
                <figure>
                    <img src="https://picsum.photos/400/200?random=12" alt="Collection" class="w-full h-48 object-cover" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">
                        Best Restaurants
                        <div class="badge badge-secondary">12 places</div>
                    </h2>
                    <p>Top-rated restaurants in Jakarta for special occasions</p>
                    <div class="flex -space-x-4 mt-2">
                        <div class="avatar">
                            <div class="w-8 h-8 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="https://picsum.photos/100/100?random=7" />
                            </div>
                        </div>
                        <div class="avatar">
                            <div class="w-8 h-8 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="https://picsum.photos/100/100?random=8" />
                            </div>
                        </div>
                        <div class="avatar">
                            <div class="w-8 h-8 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="https://picsum.photos/100/100?random=9" />
                            </div>
                        </div>
                        <div class="avatar placeholder">
                            <div class="w-8 h-8 rounded-full bg-neutral-focus text-neutral-content ring ring-primary ring-offset-base-100 ring-offset-2">
                                <span class="text-xs">+9</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-actions justify-end mt-4">
                        <button class="btn btn-primary btn-sm">View Collection</button>
                    </div>
                </div>
            </div>

            <!-- Create New Collection Card -->
            <div class="card bg-base-100 shadow-xl border-2 border-dashed border-gray-300">
                <div class="card-body flex flex-col items-center justify-center min-h-[300px]">
                    <div class="text-5xl text-gray-400 mb-4">
                        <i data-feather="plus-circle"></i>
                    </div>
                    <h2 class="card-title text-gray-600">Create New Collection</h2>
                    <p class="text-gray-500 text-center">Organize your favorite places into custom collections</p>
                    <div class="card-actions mt-4">
                        <button class="btn btn-outline">Create Collection</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer p-10 bg-neutral text-neutral-content mt-16">
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