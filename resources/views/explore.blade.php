<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"> <title>Halaman Jelajah Peta (Explore)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
         /* Custom CSS for layout and components */
         body {
            font-family: 'Inter', sans-serif;
            overflow: hidden; /* Prevent default body scrolling */
            height: 100vh; /* Ensure body takes full viewport height */
         }
         /* Ensure map container fills the screen behind other elements */
         .map-container {
             position: fixed;
             top: 0;
             left: 0;
             right: 0;
             bottom: 0; /* Takes full screen */
             z-index: 0; /* Lowest layer */
         }
         /* Styling for the bottom sheet */
         .bottom-sheet {
             position: fixed;
             bottom: 0;
             left: 0;
             right: 0;
             max-height: 60%; /* Allow sheet to take more height if needed */
             min-height: 100px; /* Minimum height when collapsed (optional) */
             background-color: white;
             border-top-left-radius: 1rem; /* rounded-t-2xl */
             border-top-right-radius: 1rem;
             box-shadow: 0 -4px M12px rgba(0,0,0,0.1);
             overflow-y: auto; /* Enable scrolling for list inside */
             z-index: 20; /* Above map, below modal potentially */
             transition: transform 0.3s ease-out;
             /* transform: translateY(calc(100% - 100px)); */ /* Start partially visible (optional) */
         }
         /* Optional: Handle for dragging the bottom sheet */
         .bottom-sheet-handle {
             width: 40px;
             height: 4px;
             background-color: #d1d5db; /* bg-gray-300 */
             border-radius: 2px; /* rounded-full */
             margin: 8px auto;
             cursor: grab; /* Indicate draggable */
         }
         /* Styling for map control buttons */
         .map-controls {
             position: fixed;
             /* Adjust position based on search bar height + desired margin */
             top: calc(3.5rem + 20px); /* Example: 3.5rem search + 20px margin */
             right: 10px;
             z-index: 10; /* Above map, below search/bottom sheet */
             display: flex;
             flex-direction: column;
             gap: 8px; /* Space between buttons */
         }
         .map-control-button {
             background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent */
             border: 1px solid #d1d5db; /* border-gray-300 */
             border-radius: 9999px; /* rounded-full */
             width: 40px;
             height: 40px;
             display: flex;
             justify-content: center;
             align-items: center;
             box-shadow: 0 1px 3px rgba(0,0,0,0.1);
             cursor: pointer;
             color: #374151; /* text-gray-700 */
         }
         .map-control-button:hover {
             background-color: white;
             border-color: #9ca3af; /* border-gray-400 */
         }
         /* Ensure content below fixed elements is not hidden initially */
         /* Not strictly needed if map fills background and bottom sheet covers bottom */

    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>
<body class="bg-gray-200"> <div id="map" class="map-container bg-gray-300 flex justify-center items-center text-gray-500">
        <p>[ Area Peta Interaktif ]</p>
    </div>

    <div class="fixed top-3 left-3 right-3 z-10"> <div class="relative bg-white rounded-full shadow-md">
             <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                 <i class="fas fa-search"></i>
             </span>
            <input type="text" placeholder="Cari lokasi atau bisnis di peta..." class="w-full p-3 pl-10 pr-10 rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" aria-label="Cari Peta">
             <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-500" aria-label="Filter Peta">
                <i class="fas fa-sliders-h"></i> </button>
        </div>
    </div>

    <div class="map-controls">
        <button type="button" class="map-control-button" aria-label="Perbesar">
            <i class="fas fa-plus"></i>
        </button>
        <button type="button" class="map-control-button" aria-label="Perkecil">
            <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="map-control-button" aria-label="Lokasi Saya">
            <i class="fas fa-location-arrow"></i>
        </button>
        </div>

    <div id="bottom-sheet" class="bottom-sheet">
        <div class="bottom-sheet-handle" aria-label="Geser panel lokasi"></div>

        <div class="p-4 pt-0">
            <h2 class="text-md font-semibold text-gray-700 mb-3">Tempat Terdekat</h2>
            <div id="location-list" class="space-y-3">
                <div class="flex space-x-3 items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer">
                    <img src="https://placehold.co/64x64/e2e8f0/94a3b8?text=Foto+1" alt="Warung Makan Sedap" class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                    <div class="flex-grow overflow-hidden"> <h3 class="text-sm font-semibold text-gray-800 truncate">Warung Makan Sedap</h3>
                        <p class="text-xs text-gray-500 mb-1 truncate">Makanan Rumahan</p>
                        <div class="flex items-center text-xs mb-1">
                            <span class="text-yellow-500"><i class="fas fa-star"></i> 4.5</span>
                            <span class="text-gray-500 ml-2">• 500m</span>
                        </div>
                        <p class="text-xs text-green-600 font-medium">Buka</p>
                    </div>
                     <button type="button" class="text-blue-500 hover:text-blue-700 p-2 flex-shrink-0" aria-label="Rute ke Warung Makan Sedap">
                         <i class="fas fa-directions fa-lg"></i>
                     </button>
                </div>
                 <div class="flex space-x-3 items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer">
                    <img src="https://placehold.co/64x64/f0f9ff/60a5fa?text=Foto+2" alt="Kedai Kopi Senja" class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                    <div class="flex-grow overflow-hidden">
                        <h3 class="text-sm font-semibold text-gray-800 truncate">Kedai Kopi Senja</h3>
                        <p class="text-xs text-gray-500 mb-1 truncate">Minuman & Makanan Ringan</p>
                         <div class="flex items-center text-xs mb-1">
                            <span class="text-yellow-500"><i class="fas fa-star"></i> 4.8</span>
                            <span class="text-gray-500 ml-2">• 1.2km</span>
                        </div>
                        <p class="text-xs text-red-600 font-medium">Tutup</p>
                    </div>
                     <button type="button" class="text-blue-500 hover:text-blue-700 p-2 flex-shrink-0" aria-label="Rute ke Kedai Kopi Senja">
                         <i class="fas fa-directions fa-lg"></i>
                     </button>
                </div>
                </div>
        </div>
    </div>

    <script>
        // ==================================================================
        // !! JAVASCRIPT UNTUK INISIALISASI PETA & INTERAKSI !!
        // ==================================================================

        document.addEventListener('DOMContentLoaded', function() {
            console.log("DOM Loaded. Siap untuk inisialisasi peta.");

            // --- 1. Inisialisasi Peta ---
            // TODO: Ganti bagian ini dengan kode inisialisasi library peta Anda (misal: Leaflet)
            // Contoh Placeholder (Hapus jika menggunakan library asli):
            const mapElement = document.getElementById('map');
            if (mapElement) {
                 console.log("Inisialisasi Peta Placeholder...");
                 // mapElement.innerHTML = '<p>Peta akan dimuat di sini...</p>'; // Hapus jika Leaflet aktif
            }
            /* Contoh Inisialisasi Leaflet (jika library sudah di-load):
            try {
                var map = L.map('map').setView([-6.9175, 107.6191], 13); // Koordinat Bandung

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                console.log("Peta Leaflet berhasil diinisialisasi.");

                // --- 2. Tambahkan Markers ---
                // TODO: Ambil data lokasi (misalnya dari API) dan tambahkan marker ke peta
                // Contoh marker:
                // var marker = L.marker([-6.9039, 107.6186]).addTo(map); // Contoh Gedung Sate
                // marker.bindPopup("<b>Gedung Sate</b><br>Ikon Bandung.").openPopup();

                // --- 3. Handle Klik Marker ---
                // TODO: Tambahkan event listener pada marker untuk menampilkan info detail
                //       atau menyorot item di bottom sheet.
                // marker.on('click', function(e) {
                //     console.log("Marker diklik:", e.latlng);
                //     // Tampilkan info, sorot item di list, dll.
                // });

                // --- 4. Handle Gerakan Peta ---
                // TODO: Tambahkan event listener untuk 'moveend' atau 'zoomend' jika perlu
                //       memuat ulang lokasi di bottom sheet sesuai area peta.
                // map.on('moveend', function() {
                //     var bounds = map.getBounds();
                //     console.log("Peta digerakkan, bounds baru:", bounds);
                //     // Ambil ulang data lokasi untuk bounds ini
                //     // updateLocationList(bounds);
                // });

            } catch (e) {
                console.error("Gagal menginisialisasi peta Leaflet. Pastikan library sudah dimuat.", e);
                if (mapElement) {
                    mapElement.innerHTML = '<p class="text-red-500 p-4">Gagal memuat peta. Periksa koneksi atau konsol error.</p>';
                }
            }
            */

            // --- 5. Handle Kontrol Peta ---
            // TODO: Tambahkan event listener ke tombol kontrol peta (+, -, lokasi)
            //       untuk memanggil fungsi zoom atau lokasi dari library peta.
            document.querySelector('[aria-label="Perbesar"]')?.addEventListener('click', () => {
                console.log("Tombol Perbesar diklik");
                // map?.zoomIn(); // Contoh Leaflet
            });
            document.querySelector('[aria-label="Perkecil"]')?.addEventListener('click', () => {
                console.log("Tombol Perkecil diklik");
                // map?.zoomOut(); // Contoh Leaflet
            });
             document.querySelector('[aria-label="Lokasi Saya"]')?.addEventListener('click', () => {
                console.log("Tombol Lokasi Saya diklik");
                // map?.locate({setView: true, maxZoom: 16}); // Contoh Leaflet
                 // Handle event 'locationfound' dan 'locationerror' dari map
            });

            // --- 6. Handle Interaksi Bottom Sheet ---
            // TODO: Tambahkan logika untuk:
            //       - Memuat data ke #location-list (misalnya saat peta bergerak/zoom)
            //       - Menangani klik pada item di #location-list (misalnya, fokus ke marker di peta)
            //       - (Opsional) Menangani gestur drag pada .bottom-sheet-handle
            const locationList = document.getElementById('location-list');
            locationList?.addEventListener('click', function(event) {
                const card = event.target.closest('.flex.space-x-3'); // Cari elemen kartu terdekat
                if (card) {
                    console.log("Item lokasi diklik:", card.querySelector('h3')?.textContent);
                    // TODO: Dapatkan ID atau koordinat lokasi dari data-* attribute pada card
                    //       Lalu pan/zoom peta ke marker yang sesuai.
                    // const locationId = card.dataset.locationId;
                    // focusMapOnLocation(locationId);
                }
            });

             // --- 7. Handle Pencarian Peta ---
             const searchInput = document.querySelector('input[aria-label="Cari Peta"]');
             searchInput?.addEventListener('keypress', function(event) {
                 if (event.key === 'Enter') {
                     console.log("Melakukan pencarian peta untuk:", searchInput.value);
                     // TODO: Implementasikan geocoding atau pencarian lokasi berdasarkan input
                     //       dan tampilkan hasilnya di peta/list.
                     // searchMapLocation(searchInput.value);
                 }
             });

        }); // End DOMContentLoaded

        // --- Fungsi Helper (Contoh) ---
        // function updateLocationList(bounds) {
        //     console.log("Memperbarui daftar lokasi untuk bounds:", bounds);
        //     const listElement = document.getElementById('location-list');
        //     // TODO: Fetch data for the bounds
        //     // TODO: Clear current list
        //     // TODO: Populate listElement with new location cards
        //     listElement.innerHTML = '<p class="text-gray-500 text-sm p-2">Memuat lokasi...</p>'; // Placeholder
        // }

        // function focusMapOnLocation(locationId) {
        //     console.log("Memfokuskan peta pada lokasi ID:", locationId);
        //     // TODO: Find marker/coordinates based on ID
        //     // TODO: Use map library function to pan/zoom (e.g., map.panTo(latlng))
        // }

        // function searchMapLocation(query) {
        //     console.log("Mencari lokasi:", query);
        //     // TODO: Use geocoding service or internal search
        //     // TODO: Display results (markers, list update)
        // }

    </script>

</body>
</html>
