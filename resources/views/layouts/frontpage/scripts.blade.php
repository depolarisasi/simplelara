 
<!-- Initialize Feather Icons -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
     
    
    // Back to top button functionality
    const backToTopButton = document.getElementById('backtotop');
    if (backToTopButton) {
      // Initially hide the button
      backToTopButton.style.display = 'none';
      
      // Show/hide the button based on scroll position
      window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
          backToTopButton.style.display = 'block';
        } else {
          backToTopButton.style.display = 'none';
        }
      });
      
      // Scroll to top when clicked
      backToTopButton.addEventListener('click', function() {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
    }
  });

  

// Initialize icons if available
document.addEventListener('DOMContentLoaded', function() { 
    
    // Initialize any other components or functionality
    const themeToggle = document.getElementById('theme-toggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            // Toggle between light and dark theme
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            
            // Save preference to localStorage
            localStorage.setItem('theme', newTheme);
        });
    }
    
    // Check for saved theme preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.documentElement.setAttribute('data-theme', savedTheme);
    } else {
        // Default to light theme
        document.documentElement.setAttribute('data-theme', 'light');
    }
});
</script>