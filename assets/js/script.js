// script.js
function activateIcon(id) {
    const icons = document.querySelectorAll('.sidebar-icon');
    icons.forEach(icon => icon.classList.remove('active'));
    
    const selectedIcon = document.getElementById(id);
    selectedIcon.classList.add('active');
}
