<!-- Meta -->
<meta name="theme-color" content="#ffffff">

<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ url('/assets/images/favicon.png') }}">

<!-- Icon Libraries -->
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

<!-- Add Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<!-- Add Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
      crossorigin=""/>

<!-- Custom styles -->
<style>
  /* Fix for horizontal overflow */
  html, body {
    overflow-x: hidden;
    max-width: 100%;
  }
  
  /* Ensure proper spacing for fixed navbar */
  body {
    padding-top: 4rem;
  }
  
  @media (max-width: 768px) {
    body {
      padding-top: 0;
      padding-bottom: 4rem; /* Space for bottom nav on mobile */
    }
  }
</style>