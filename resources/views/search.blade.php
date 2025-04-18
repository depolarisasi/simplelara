<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visual Halaman Hasil Pencarian (Update 7 - Perbaikan Komentar)</title> <script src="https://cdn.tailwindcss.com"></script>
    <style>
         body { font-family: 'Inter', sans-serif; }
         /* Verification Badge Icons */
         .badge-gold { @apply text-yellow-500; }
         .badge-silver { @apply text-gray-400; }
         .badge-bronze { @apply text-amber-600; }

         /* Quick Info Tag Style */
         .info-tag {
             @apply inline-block bg-gray-100 text-gray-600 text-[10px] px-1.5 py-0.5 rounded-md mr-1 mb-1;
         }

         /* Basic Modal Styling (for mobile) */
         .modal-overlay {
             @apply fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-40 lg:hidden; /* Hidden on large screens */
         }
         .modal-content {
             @apply bg-white rounded-lg shadow-xl p-6 w-11/12 max-w-md max-h-[80vh] overflow-y-auto;
         }

         /* Simple Toggle Switch Styling */
         .toggle-label {
             @apply relative block overflow-hidden h-5 rounded-full bg-gray-300 cursor-pointer w-10 transition-colors duration-200 ease-in-out;
         }
         .toggle-checkbox + .toggle-label::before {
             content: '';
             @apply absolute block w-5 h-5 rounded-full bg-white border-4 border-transparent shadow top-1/2 transform -translate-y-1/2 transition-transform duration-200 ease-in-out;
             left: 0px; box-sizing: border-box;
         }
         .toggle-checkbox:checked + .toggle-label { @apply bg-blue-500; }
         .toggle-checkbox:checked + .toggle-label::before { @apply translate-x-full; }
         .toggle-checkbox { @apply absolute opacity-0 w-0 h-0; }

         /* Styling for Loading Skeleton */
         .skeleton-card { @apply bg-white border border-gray-200 rounded-lg p-3 flex space-x-3; }
         .skeleton-img { @apply w-20 h-20 rounded bg-gray-200 animate-pulse; }
         .skeleton-line { @apply h-4 bg-gray-200 rounded animate-pulse mb-2; }

    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100">

    <div class="container mx-auto max-w-md md:max-w-2xl lg:max-w-6xl bg-white lg:bg-transparent shadow-lg lg:shadow-none min-h-screen">
        <nav class="bg-white p-3 flex justify-between items-center sticky top-0 z-20 border-b lg:rounded-t-lg">
             <button class="text-gray-600 hover:text-blue-500" aria-label="Kembali">
                 <i class="fas fa-arrow-left"></i>
             </button>
             <input type="text" value="Makanan enak" placeholder="🔍 Cari..." class="flex-grow mx-3 p-1.5 px-3 rounded-full border border-gray-300 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500" aria-label="Kolom Pencarian">
             <button id="filter-button" class="text-gray-600 hover:text-blue-500 p-2 rounded-full hover:bg-gray-100 lg:hidden" aria-label="Buka Filter" aria-controls="filter-modal" aria-expanded="false">
                 <i class="fas fa-filter"></i>
             </button>
        </nav>

        <div id="active-filters-display" class="px-4 py-1.5 text-xs text-gray-600 bg-gray-50 border-b lg:hidden">
             </div>

        <div class="lg:flex lg:gap-6 lg:p-4"> <aside class="hidden lg:block lg:w-1/4 xl:w-1/5 p-4 bg-white border border-gray-200 rounded-lg shadow-sm self-start sticky top-[77px]"> <h2 id="desktop-filter-title" class="text-lg font-semibold mb-4">Filter & Urutkan</h2>
                 <form id="desktop-filter-form" class="space-y-6">
                    <fieldset>
                        <legend class="text-sm font-medium mb-2">Urutkan Berdasarkan</legend>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="sort" value="relevance" class="form-radio text-blue-500 focus:ring-blue-500" checked>
                                <span class="ml-2 text-sm text-gray-700">Relevansi</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="sort" value="distance" class="form-radio text-blue-500 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Jarak Terdekat</span>
                            </label>
                             <label class="flex items-center">
                                <input type="radio" name="sort" value="rating" class="form-radio text-blue-500 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Rating Tertinggi</span>
                            </label>
                        </div>
                    </fieldset>
                     <fieldset>
                        <legend class="text-sm font-medium mb-2">Tampilkan Hanya</legend>
                         <div class="space-y-3">
                             <label class="flex items-center justify-between cursor-pointer">
                                 <span class="text-sm text-gray-700">Sedang Buka</span>
                                 <input type="checkbox" id="desktop-toggle-open" name="filter_open" class="toggle-checkbox" role="switch" aria-checked="false">
                                 <span class="toggle-label" aria-hidden="true"></span>
                             </label>
                             <label class="flex items-center justify-between cursor-pointer">
                                 <span class="text-sm text-gray-700">Ada Promo</span>
                                  <input type="checkbox" id="desktop-toggle-promo" name="filter_promo" class="toggle-checkbox" role="switch" aria-checked="false">
                                  <span class="toggle-label" aria-hidden="true"></span>
                             </label>
                              <label class="flex items-center justify-between cursor-pointer">
                                 <span class="text-sm text-gray-700">Verified</span>
                                  <input type="checkbox" id="desktop-toggle-verified" name="filter_verified_only" class="toggle-checkbox" role="switch" aria-checked="false">
                                  <span class="toggle-label" aria-hidden="true"></span>
                             </label>
                         </div>
                    </fieldset>
                     <fieldset>
                        <legend class="text-sm font-medium mb-2">Tingkat Verifikasi</legend>
                         <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="verification" value="any" class="form-radio text-blue-500 focus:ring-blue-500" checked>
                                <span class="ml-2 text-sm text-gray-700">Semua</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="verification" value="gold" class="form-radio text-blue-500 focus:ring-blue-500">
                                <span class="ml-1 badge-gold" title="Gold"><i class="fas fa-check-circle"></i></span>
                                <span class="ml-1 text-sm text-gray-700">Gold</span>
                            </label>
                             <label class="flex items-center">
                                <input type="radio" name="verification" value="silver" class="form-radio text-blue-500 focus:ring-blue-500">
                                 <span class="ml-1 badge-silver" title="Silver"><i class="fas fa-check-circle"></i></span>
                                <span class="ml-1 text-sm text-gray-700">Silver</span>
                            </label>
                             <label class="flex items-center">
                                <input type="radio" name="verification" value="bronze" class="form-radio text-blue-500 focus:ring-blue-500">
                                 <span class="ml-1 badge-bronze" title="Bronze"><i class="fas fa-check-circle"></i></span>
                                <span class="ml-1 text-sm text-gray-700">Bronze</span>
                            </label>
                        </div>
                    </fieldset>
                      <div>
                         <button type="button" class="w-full text-left text-sm text-gray-700 p-2 border rounded hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 flex justify-between items-center" onclick="console.log('Tombol Pilih Kategori (Desktop) diklik')">
                             <span>Pilih Kategori</span>
                             <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                         </button>
                     </div>
                     <div class="mt-6 pt-4 border-t flex flex-col sm:flex-row justify-between gap-2">
                          <button id="desktop-reset-filters" type="button" class="w-full sm:w-auto text-sm text-center text-gray-600 hover:text-gray-800 px-4 py-1.5 rounded hover:bg-gray-100 transition-colors border sm:border-none">Reset</button>
                          <button id="desktop-apply-filters" type="button" class="w-full sm:w-auto bg-blue-500 text-white px-6 py-1.5 rounded-lg text-sm hover:bg-blue-600 transition-colors">Terapkan</button>
                      </div>
                 </form>
            </aside>

            <section class="p-4 lg:p-0 lg:w-3/4 xl:w-4/5" id="search-results-container">
                <p class="text-sm text-gray-600 mb-4">Menampilkan 15 hasil untuk "Makanan enak"</p>

                 <div id="loading-state" class="space-y-4 hidden">
                    <p class="text-center text-gray-500"><i class="fas fa-spinner fa-spin mr-2"></i> Memuat hasil...</p>
                    <div class="skeleton-card lg:hidden"> <div class="skeleton-img"></div>
                        <div class="flex-grow space-y-2"> <div class="skeleton-line w-3/4"></div> <div class="skeleton-line w-1/2"></div> <div class="skeleton-line w-full"></div> <div class="skeleton-line w-5/6"></div> </div>
                    </div>
                     <div class="skeleton-card lg:hidden">
                        <div class="skeleton-img"></div>
                        <div class="flex-grow space-y-2"> <div class="skeleton-line w-3/4"></div> <div class="skeleton-line w-1/2"></div> <div class="skeleton-line w-full"></div> <div class="skeleton-line w-5/6"></div> </div>
                    </div>
                </div>

                <div id="empty-state" class="text-center py-10 text-gray-500 hidden">
                    <i class="fas fa-box-open fa-3x mb-4 text-gray-400"></i>
                    <p class="font-semibold mb-1">Oops! Hasil tidak ditemukan.</p>
                    <p class="text-sm">Coba gunakan kata kunci lain atau ubah filter pencarian Anda.</p>
                </div>

                <div id="results-grid" class="space-y-4 lg:space-y-0 lg:grid lg:grid-cols-1 xl:grid-cols-2 lg:gap-4">
                    <div class="bg-white border border-gray-200 rounded-lg p-3 flex space-x-3 hover:shadow-md transition-shadow duration-200">
                         <img src="https://placehold.co/80x80/e2e8f0/94a3b8?text=Gambar+1" alt="Warung Makan Sedap" class="w-20 h-20 rounded object-cover flex-shrink-0" loading="lazy">
                         <div class="flex-grow">
                             <div class="flex justify-between items-start mb-1"> <h3 class="text-md font-semibold text-gray-800">Warung Makan Sedap</h3> <span class="badge-gold flex-shrink-0 ml-2" title="Verified Gold"><i class="fas fa-check-circle"></i></span> </div>
                             <p class="text-xs text-gray-500 mb-1">Makanan / Rumahan</p>
                             <div class="mb-1"> <span class="info-tag">Wifi Gratis</span> <span class="info-tag">Parkir Motor</span> <span class="info-tag">Halal</span> </div>
                             <p class="text-xs text-gray-600 mb-2"><i class="fas fa-map-marker-alt mr-1 text-red-500 w-3 text-center"></i> Jl. Merdeka No. 10 (± 500m)</p>
                             <div class="flex justify-between items-center mt-1">
                                 <p class="text-xs text-green-600 font-medium">Buka <span class="text-gray-500 font-normal">• Tutup 22:00</span></p>
                                 <div class="flex space-x-2 text-gray-500"> <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Lihat di Peta" onclick="console.log('Tombol Lihat Peta diklik untuk: Warung Makan Sedap')"><i class="fas fa-map-marked-alt"></i></button> <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Telepon" onclick="console.log('Tombol Telepon diklik untuk: Warung Makan Sedap')"><i class="fas fa-phone"></i></button> <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Rute" onclick="console.log('Tombol Rute diklik untuk: Warung Makan Sedap')"><i class="fas fa-directions"></i></button> </div>
                             </div>
                         </div>
                     </div>
                     <div class="bg-white border border-gray-200 rounded-lg p-3 flex space-x-3 hover:shadow-md transition-shadow duration-200">
                         <img src="https://placehold.co/80x80/f0f9ff/60a5fa?text=Gambar+2" alt="Kedai Kopi Senja" class="w-20 h-20 rounded object-cover flex-shrink-0" loading="lazy">
                          <div class="flex-grow">
                              <div class="flex justify-between items-start mb-1"> <h3 class="text-md font-semibold text-gray-800">Kedai Kopi Senja</h3> <span class="badge-bronze flex-shrink-0 ml-2" title="Verified Bronze"><i class="fas fa-check-circle"></i></span> </div>
                             <p class="text-xs text-gray-500 mb-1">Minuman / Kopi</p>
                              <div class="mb-1"> <span class="info-tag">Area Merokok</span> <span class="info-tag">Musik Live</span> </div>
                             <p class="text-xs text-gray-600 mb-2"><i class="fas fa-map-marker-alt mr-1 text-red-500 w-3 text-center"></i> Jl. Kenangan No. 25 (± 1.2km)</p>
                              <div class="flex justify-between items-center mt-1">
                                 <p class="text-xs text-red-600 font-medium">Tutup <span class="text-gray-500 font-normal">• Buka 10:00</span></p>
                                  <div class="flex space-x-2 text-gray-500"> <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Lihat di Peta" onclick="console.log('Tombol Lihat Peta diklik untuk: Kedai Kopi Senja')"><i class="fas fa-map-marked-alt"></i></button> <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Telepon" onclick="console.log('Tombol Telepon diklik untuk: Kedai Kopi Senja')"><i class="fas fa-phone"></i></button> <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Rute" onclick="console.log('Tombol Rute diklik untuk: Kedai Kopi Senja')"><i class="fas fa-directions"></i></button> </div>
                             </div>
                         </div>
                     </div>
                     <div class="bg-white border border-gray-200 rounded-lg p-3 flex space-x-3 hover:shadow-md transition-shadow duration-200">
                         <img src="https://placehold.co/80x80/fff7ed/f97316?text=Gambar+3" alt="Resto Keluarga Bahagia" class="w-20 h-20 rounded object-cover flex-shrink-0" loading="lazy">
                          <div class="flex-grow">
                             <div class="flex justify-between items-start mb-1"> <h3 class="text-md font-semibold text-gray-800">Resto Keluarga Bahagia</h3> <span class="text-xs text-gray-400 italic flex-shrink-0 ml-2" title="Belum Terverifikasi">Non-Verified</span> </div>
                             <p class="text-xs text-gray-500 mb-1">Makanan / Indonesia</p>
                              <div class="mb-1"> <span class="info-tag">Ramah Anak</span> <span class="info-tag">Parkir Mobil</span> </div>
                             <p class="text-xs text-gray-600 mb-2"><i class="fas fa-map-marker-alt mr-1 text-red-500 w-3 text-center"></i> Jl. Harmoni Blok C1 (± 2.5km)</p>
                              <div class="flex justify-between items-center mt-1">
                                 <p class="text-xs text-green-600 font-medium">Buka <span class="text-gray-500 font-normal">• Tutup 21:00</span></p>
                                  <div class="flex space-x-2 text-gray-500"> <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Lihat di Peta" onclick="console.log('Tombol Lihat Peta diklik untuk: Resto Keluarga Bahagia')"><i class="fas fa-map-marked-alt"></i></button> <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Telepon" onclick="console.log('Tombol Telepon diklik untuk: Resto Keluarga Bahagia')"><i class="fas fa-phone"></i></button> <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Rute" onclick="console.log('Tombol Rute diklik untuk: Resto Keluarga Bahagia')"><i class="fas fa-directions"></i></button> </div>
                             </div>
                         </div>
                     </div>
                     <div class="bg-white border border-gray-200 rounded-lg p-3 flex space-x-3 hover:shadow-md transition-shadow duration-200">
                         <img src="https://placehold.co/80x80/f3f4f6/6b7280?text=Gambar+4" alt="Toko Kue Ceria" class="w-20 h-20 rounded object-cover flex-shrink-0" loading="lazy">
                          <div class="flex-grow">
                             <div class="flex justify-between items-start mb-1"> <h3 class="text-md font-semibold text-gray-800">Toko Kue Ceria</h3> <span class="badge-silver flex-shrink-0 ml-2" title="Verified Silver"><i class="fas fa-check-circle"></i></span> </div>
                             <p class="text-xs text-gray-500 mb-1">Makanan / Kue & Roti</p>
                              <div class="mb-1"> <span class="info-tag">Terima Pesanan</span> <span class="info-tag">Pembayaran Digital</span> </div>
                             <p class="text-xs text-gray-600 mb-2"><i class="fas fa-map-marker-alt mr-1 text-red-500 w-3 text-center"></i> Jl. Pelangi No. 5 (± 3.1km)</p>
                              <div class="flex justify-between items-center mt-1">
                                 <p class="text-xs text-green-600 font-medium">Buka <span class="text-gray-500 font-normal">• Tutup 19:00</span></p>
                                  <div class="flex space-x-2 text-gray-500"> <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Lihat di Peta" onclick="console.log('Tombol Lihat Peta diklik untuk: Toko Kue Ceria')"><i class="fas fa-map-marked-alt"></i></button> <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Telepon" onclick="console.log('Tombol Telepon diklik untuk: Toko Kue Ceria')"><i class="fas fa-phone"></i></button> <button class="hover:text-blue-500 transition-colors duration-150 p-1" aria-label="Rute" onclick="console.log('Tombol Rute diklik untuk: Toko Kue Ceria')"><i class="fas fa-directions"></i></button> </div>
                             </div>
                         </div>
                     </div>

                     <div class="text-center pt-4 lg:col-span-1 xl:col-span-2">
                          <button class="bg-blue-500 text-white px-6 py-2 rounded-full text-sm hover:bg-blue-600 transition-colors duration-150" onclick="console.log('Tombol Muat Lebih Banyak diklik')">Muat Lebih Banyak</button>
                      </div>
                 </div> </section> </div> <footer class="bg-gray-200 p-3 text-center mt-6 lg:rounded-b-lg">
             <p class="text-xs text-gray-600">&copy; 2025 NamaApp</p>
         </footer>

    </div> <div id="filter-modal" class="modal-overlay hidden" role="dialog" aria-modal="true" aria-labelledby="modal-title">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-4">
                <h2 id="modal-title" class="text-lg font-semibold">Filter & Urutkan</h2>
                <button id="close-modal-button" type="button" class="text-gray-500 hover:text-gray-700" aria-label="Tutup Modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="mobile-filter-form" class="space-y-6">
                 <fieldset> <legend class="text-sm font-medium mb-2">Urutkan Berdasarkan</legend> <div class="flex flex-wrap gap-x-4 gap-y-2"> <label class="inline-flex items-center"> <input type="radio" name="sort" value="relevance" class="form-radio text-blue-500 focus:ring-blue-500" checked> <span class="ml-2 text-sm text-gray-700">Relevansi</span> </label> <label class="inline-flex items-center"> <input type="radio" name="sort" value="distance" class="form-radio text-blue-500 focus:ring-blue-500"> <span class="ml-2 text-sm text-gray-700">Jarak Terdekat</span> </label> <label class="inline-flex items-center"> <input type="radio" name="sort" value="rating" class="form-radio text-blue-500 focus:ring-blue-500"> <span class="ml-2 text-sm text-gray-700">Rating Tertinggi</span> </label> </div> </fieldset>
                 <fieldset> <legend class="text-sm font-medium mb-2">Tampilkan Hanya</legend> <div class="space-y-3"> <label class="flex items-center justify-between cursor-pointer"> <span class="text-sm text-gray-700">Sedang Buka</span> <input type="checkbox" id="mobile-toggle-open" name="filter_open" class="toggle-checkbox" role="switch" aria-checked="false"> <span class="toggle-label" aria-hidden="true"></span> </label> <label class="flex items-center justify-between cursor-pointer"> <span class="text-sm text-gray-700">Ada Promo</span> <input type="checkbox" id="mobile-toggle-promo" name="filter_promo" class="toggle-checkbox" role="switch" aria-checked="false"> <span class="toggle-label" aria-hidden="true"></span> </label> <label class="flex items-center justify-between cursor-pointer"> <span class="text-sm text-gray-700">Verified</span> <input type="checkbox" id="mobile-toggle-verified" name="filter_verified_only" class="toggle-checkbox" role="switch" aria-checked="false"> <span class="toggle-label" aria-hidden="true"></span> </label> </div> </fieldset>
                 <fieldset> <legend class="text-sm font-medium mb-2">Tingkat Verifikasi</legend> <div class="flex flex-wrap gap-x-4 gap-y-2"> <label class="inline-flex items-center"> <input type="radio" name="verification" value="any" class="form-radio text-blue-500 focus:ring-blue-500" checked> <span class="ml-2 text-sm text-gray-700">Semua</span> </label> <label class="inline-flex items-center"> <input type="radio" name="verification" value="gold" class="form-radio text-blue-500 focus:ring-blue-500"> <span class="ml-1 badge-gold" title="Gold"><i class="fas fa-check-circle"></i></span> <span class="ml-1 text-sm text-gray-700">Gold</span> </label> <label class="inline-flex items-center"> <input type="radio" name="verification" value="silver" class="form-radio text-blue-500 focus:ring-blue-500"> <span class="ml-1 badge-silver" title="Silver"><i class="fas fa-check-circle"></i></span> <span class="ml-1 text-sm text-gray-700">Silver</span> </label> <label class="inline-flex items-center"> <input type="radio" name="verification" value="bronze" class="form-radio text-blue-500 focus:ring-blue-500"> <span class="ml-1 badge-bronze" title="Bronze"><i class="fas fa-check-circle"></i></span> <span class="ml-1 text-sm text-gray-700">Bronze</span> </label> </div> </fieldset>
                 <div> <button type="button" class="w-full text-left text-sm text-gray-700 p-2 border rounded hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 flex justify-between items-center" onclick="console.log('Tombol Pilih Kategori (Mobile) diklik')"> <span>Pilih Kategori</span> <i class="fas fa-chevron-right text-xs text-gray-400"></i> </button> </div>
            </form>
            <div class="mt-6 pt-4 border-t flex justify-end space-x-3">
                <button id="mobile-reset-filters" type="button" class="text-sm text-gray-600 hover:text-gray-800 px-4 py-1.5 rounded hover:bg-gray-100 transition-colors">Reset</button>
                <button id="mobile-apply-filters" type="button" class="bg-blue-500 text-white px-6 py-1.5 rounded-lg text-sm hover:bg-blue-600 transition-colors">Terapkan Filter</button>
            </div>
        </div>
    </div>

    <script>
        // --- DOM Element References ---
        const filterButton = document.getElementById('filter-button');
        const filterModal = document.getElementById('filter-modal');
        const closeModalButton = document.getElementById('close-modal-button');
        const mobileApplyFiltersButton = document.getElementById('mobile-apply-filters');
        const mobileResetFiltersButton = document.getElementById('mobile-reset-filters');
        const mobileFilterForm = document.getElementById('mobile-filter-form');

        const desktopFilterForm = document.getElementById('desktop-filter-form');
        const desktopResetButton = document.getElementById('desktop-reset-filters');
        const desktopApplyButton = document.getElementById('desktop-apply-filters');

        const searchResultsContainer = document.getElementById('search-results-container');
        const resultsGrid = document.getElementById('results-grid');
        const loadingState = document.getElementById('loading-state');
        const emptyState = document.getElementById('empty-state');
        const activeFiltersDisplay = document.getElementById('active-filters-display');

        // --- Modal Logic (Mobile) ---
        function openModal() {
            filterModal?.classList.remove('hidden');
            filterButton?.setAttribute('aria-expanded', 'true');
            // TODO: Implement focus trap for accessibility
        }

        function closeModal() {
            filterModal?.classList.add('hidden');
            filterButton?.setAttribute('aria-expanded', 'false');
            // TODO: Restore focus to the filter button for accessibility
        }

        filterButton?.addEventListener('click', openModal);
        closeModalButton?.addEventListener('click', closeModal);
        filterModal?.addEventListener('click', (event) => { if (event.target === filterModal) closeModal(); });

        // --- Filter Application Logic ---
        function applyFilters(source) { // source can be 'mobile' or 'desktop'
            const form = (source === 'mobile') ? mobileFilterForm : desktopFilterForm;
            if (!form) {
                console.error("Filter form not found for source:", source);
                return;
            };

            const formData = new FormData(form);
            const filters = Object.fromEntries(formData.entries());
            console.log(`Applying filters (${source}):`, filters);

            // ** TODO: Implement actual filtering logic here **
            // This section requires integration with your data source (API call or client-side data)
            // --------------------------------------------------
            // 1. Show Loading State
            showLoadingState();

            // 2. Simulate Network Request / Data Filtering
            console.log("Simulating data fetch/filter...");
            setTimeout(() => {
                // 3. Simulate Receiving Results
                const hasResults = Math.random() > 0.2; // Randomly simulate results found or not

                // 4. Update Display based on simulated results
                if (hasResults) {
                    // TODO: Replace console.log with actual DOM manipulation
                    //       to update the #results-grid with the new data.
                    console.log("Simulated results received. Updating results grid...");
                    showResults(); // Show the results container (assuming it contains the new data)
                } else {
                    console.log("Simulated fetch returned no results.");
                    showEmptyState(); // Show the empty state message
                }

                // 5. Update Active Filters Display
                updateActiveFiltersDisplay(filters);

            }, 1000); // Simulate 1 second network delay
            // --------------------------------------------------

            if (source === 'mobile') {
                closeModal(); // Close modal only after applying mobile filters
            }
        }

        mobileApplyFiltersButton?.addEventListener('click', () => applyFilters('mobile'));
        desktopApplyButton?.addEventListener('click', () => applyFilters('desktop'));

        // --- Filter Reset Logic ---
        function resetFilters(source) {
             const form = (source === 'mobile') ? mobileFilterForm : desktopFilterForm;
             if (!form) return;

             form.reset();
             // Manually update ARIA states for toggles after reset
             form.querySelectorAll('.toggle-checkbox').forEach(toggle => {
                 toggle.setAttribute('aria-checked', toggle.checked);
             });
             console.log(`Filters Reset (${source})`);

             // ** Important UX Decision **:
             // Should resetting filters automatically trigger a new search/apply?
             // Or should the user click "Apply" again?
             // Current implementation requires clicking "Apply" again.
             // To apply immediately, uncomment the next line:
             // applyFilters(source);

             // Clear the active filters display when reset
             updateActiveFiltersDisplay({});
        }

        mobileResetFiltersButton?.addEventListener('click', () => resetFilters('mobile'));
        desktopResetButton?.addEventListener('click', () => resetFilters('desktop'));

        // --- State Management Functions ---
        function showLoadingState() {
            loadingState?.classList.remove('hidden');
            emptyState?.classList.add('hidden');
            resultsGrid?.classList.add('hidden'); // Hide results grid while loading
            console.log("State: Loading");
        }

        function showEmptyState() {
            loadingState?.classList.add('hidden');
            emptyState?.classList.remove('hidden');
            resultsGrid?.classList.add('hidden'); // Keep results hidden
            console.log("State: Empty");
        }

         function showResults() {
            loadingState?.classList.add('hidden');
            emptyState?.classList.add('hidden');
            resultsGrid?.classList.remove('hidden'); // Show results grid
            console.log("State: Showing Results");
        }

        // --- Update Active Filters Display (Example for Mobile) ---
        function updateActiveFiltersDisplay(filters) {
            // This function primarily targets the mobile display area
            if (!activeFiltersDisplay) return;
            let activeFilterText = [];
            // Read filters (use consistent names)
            if (filters.filter_open === 'on') activeFilterText.push('Buka');
            if (filters.filter_promo === 'on') activeFilterText.push('Promo');
            if (filters.filter_verified_only === 'on') {
                 activeFilterText.push(`Verified`); // Simplified display
            } else if (filters.verification && filters.verification !== 'any') {
                 activeFilterText.push(`Verified: ${filters.verification}`);
            }
            if (filters.sort && filters.sort !== 'relevance') {
                activeFilterText.push(`Urut: ${filters.sort === 'distance' ? 'Jarak' : 'Rating'}`);
            }
            // TODO: Add category filter display if implemented

            if (activeFilterText.length > 0) {
                 // Added type="button" to the Ubah button
                 activeFiltersDisplay.innerHTML = `Filter: ${activeFilterText.join(', ')} <button type="button" class="ml-2 text-blue-500 underline" onclick="openModal()">Ubah</button>`;
                 activeFiltersDisplay.classList.remove('hidden');
            } else {
                 activeFiltersDisplay.innerHTML = '';
                 activeFiltersDisplay.classList.add('hidden');
            }
        }


        // --- Initialize Toggle ARIA states ---
        function initializeToggles(form) {
            form?.querySelectorAll('.toggle-checkbox').forEach(toggle => {
                // Set initial ARIA state based on HTML 'checked' attribute
                toggle.setAttribute('aria-checked', toggle.checked);
                // Add listener to update ARIA state on change
                toggle.addEventListener('change', function() {
                    this.setAttribute('aria-checked', this.checked);
                });
            });
        }
        initializeToggles(mobileFilterForm);
        initializeToggles(desktopFilterForm);

        // --- Initial Page State ---
        // Ensure only the results grid is visible on initial load
        showResults();
        // Clear any potentially cached active filter display
        updateActiveFiltersDisplay({});

    </script>

</body>
</html>
