<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Explore - Simple</title>
    
    <!-- Styles -->
    @include('layouts.frontpage.styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
      body, html {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
      }
      
      #search-panel {
        height: 300px;
        transition: height 0.3s ease;
      }
    </style>
</head>
<body> 

    <!-- Navbar -->
    @include('layouts.frontpage.navbar')
    @include('layouts.frontpage.bottomnav')

    <div class="h-screen flex flex-col">
      <!-- Main content area -->
      <div class="flex-1 relative mt-16">
        <!-- Map covering most of the screen -->
        <div id="explore-map" class="w-full h-full"></div>
        
        <!-- Collapsible/Draggable Panel -->
        <div class="absolute bottom-0 left-0 right-0 bg-base-100 rounded-t-xl shadow-xl" id="search-panel">
          <!-- Drag handle -->
          <div class="w-full flex justify-center py-2 cursor-grab" id="drag-handle">
            <div class="w-10 h-1 bg-gray-300 rounded-full"></div>
          </div>
          
          <!-- Search and filters -->
          <div class="p-4">
            <!-- Search box -->
            <div class="form-control">
              <div class="input-group">
                <input type="text" placeholder="Search locations..." class="input input-bordered w-full" />
                <button class="btn btn-square">
                  <i data-feather="search"></i>
                </button>
              </div>
            </div>
            
            <!-- Category filters -->
            <div class="mt-4">
              <div class="dropdown">
                <label tabindex="0" class="btn btn-sm m-1">Categories</label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                  <li><a>Restaurants</a></li>
                  <li><a>Cafes</a></li>
                  <li><a>Shopping</a></li>
                  <li><a>Services</a></li>
                  <li><a>Entertainment</a></li>
                </ul>
              </div>
            </div>
            
            <!-- Subcategory chips -->
            <div class="mt-2">
              <div class="flex overflow-x-auto space-x-2 py-2">
                <div class="badge badge-outline">All</div>
                <div class="badge badge-primary">Coffee</div>
                <div class="badge badge-outline">Fast Food</div>
                <div class="badge badge-outline">Fine Dining</div>
                <div class="badge badge-outline">Bakery</div>
                <!-- More filter chips -->
              </div>
            </div>
            
            <!-- Results list (scrollable) -->
            <div class="mt-4 max-h-[150px] overflow-y-auto">
              <!-- Result items -->
              <div class="card card-side bg-base-100 shadow-sm mb-2">
                <figure class="w-16">
                  <img src="https://picsum.photos/100/100?random=1" alt="Location" class="h-full object-cover" />
                </figure>
                <div class="card-body p-2">
                  <h2 class="card-title text-sm">Coffee Shop</h2>
                  <p class="text-xs">0.5 km away</p>
                </div>
              </div>
              
              <!-- Result item 2 -->
              <div class="card card-side bg-base-100 shadow-sm mb-2">
                <figure class="w-16">
                  <img src="https://picsum.photos/100/100?random=2" alt="Location" class="h-full object-cover" />
                </figure>
                <div class="card-body p-2">
                  <h2 class="card-title text-sm">Restaurant</h2>
                  <p class="text-xs">1.2 km away</p>
                </div>
              </div>
              
              <!-- Result item 3 -->
              <div class="card card-side bg-base-100 shadow-sm mb-2">
                <figure class="w-16">
                  <img src="https://picsum.photos/100/100?random=3" alt="Location" class="h-full object-cover" />
                </figure>
                <div class="card-body p-2">
                  <h2 class="card-title text-sm">Bakery</h2>
                  <p class="text-xs">0.8 km away</p>
                </div>
              </div>
              
              <!-- Result item 4 -->
              <div class="card card-side bg-base-100 shadow-sm mb-2">
                <figure class="w-16">
                  <img src="https://picsum.photos/100/100?random=4" alt="Location" class="h-full object-cover" />
                </figure>
                <div class="card-body p-2">
                  <h2 class="card-title text-sm">Shopping Mall</h2>
                  <p class="text-xs">2.5 km away</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    @include('layouts.frontpage.scripts')
    
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Initialize Feather icons
        feather.replace();
        
        // Initialize map
        const map = L.map('explore-map').setView([-6.2088, 106.8456], 13); // Jakarta coordinates

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
        
        // Initialize draggable panel
        const searchPanel = document.getElementById('search-panel');
        const dragHandle = document.getElementById('drag-handle');

        let isDragging = false;
        let startY = 0;
        let startHeight = 0;

        dragHandle.addEventListener('mousedown', (e) => {
          isDragging = true;
          startY = e.clientY;
          startHeight = parseInt(document.defaultView.getComputedStyle(searchPanel).height, 10);
          
          document.addEventListener('mousemove', onMouseMove);
          document.addEventListener('mouseup', onMouseUp);
        });

        // Touch support for mobile
        dragHandle.addEventListener('touchstart', (e) => {
          isDragging = true;
          startY = e.touches[0].clientY;
          startHeight = parseInt(document.defaultView.getComputedStyle(searchPanel).height, 10);
          
          document.addEventListener('touchmove', onTouchMove);
          document.addEventListener('touchend', onTouchEnd);
        });

        function onMouseMove(e) {
          if (!isDragging) return;
          
          const deltaY = startY - e.clientY;
          const newHeight = startHeight + deltaY;
          
          // Set min and max height
          if (newHeight < 100) {
            searchPanel.style.height = '100px';
          } else if (newHeight > window.innerHeight * 0.8) {
            searchPanel.style.height = `${window.innerHeight * 0.8}px`;
          } else {
            searchPanel.style.height = `${newHeight}px`;
          }
        }

        function onTouchMove(e) {
          if (!isDragging) return;
          
          const deltaY = startY - e.touches[0].clientY;
          const newHeight = startHeight + deltaY;
          
          // Set min and max height
          if (newHeight < 100) {
            searchPanel.style.height = '100px';
          } else if (newHeight > window.innerHeight * 0.8) {
            searchPanel.style.height = `${window.innerHeight * 0.8}px`;
          } else {
            searchPanel.style.height = `${newHeight}px`;
          }
        }

        function onMouseUp() {
          isDragging = false;
          document.removeEventListener('mousemove', onMouseMove);
          document.removeEventListener('mouseup', onMouseUp);
        }

        function onTouchEnd() {
          isDragging = false;
          document.removeEventListener('touchmove', onTouchMove);
          document.removeEventListener('touchend', onTouchEnd);
        }
      });
    </script>
</body>
</html>