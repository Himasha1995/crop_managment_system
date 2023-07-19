// Hide dropdown when clicking outside
window.addEventListener('click', function(event) {
    const dropdown = document.querySelector('.options-dropdown');
    const profileOptions = document.querySelector('.profile-options');
    
    if (event.target !== dropdown && event.target !== profileOptions) {
      dropdown.style.display = 'none';
    }
  });
  