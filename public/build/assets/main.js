function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.querySelector('.absolute.right-2.top-\\[38px\\]');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.src = '/build/assets/images/icons/eye.svg';
    } else {
        passwordInput.type = 'password';
        eyeIcon.src = '/build/assets/images/icons/eye-off.svg';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('.nav-link');
    const pageTitle = document.getElementById('page-title');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const closeSidebarBtn = document.getElementById('close-sidebar');

    const activeClasses = ['bg-[#2B2B2B]', 'text-white'];
    const inactiveClasses = ['hover:bg-gray-200'];

    // Set page title based on active nav link
    const activeLink = Array.from(navLinks).find(link => link.classList.contains('bg-[#2B2B2B]'));
    if (activeLink && pageTitle) {
        pageTitle.textContent = activeLink.getAttribute('data-title') || 'Dashboard';
    }

    const toggleSidebar = () => {
        sidebar.classList.toggle('-translate-x-full');
        sidebarOverlay.classList.toggle('hidden');
        document.body.classList.toggle('overflow-hidden');
    };

    if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', toggleSidebar);
    if (closeSidebarBtn) closeSidebarBtn.addEventListener('click', toggleSidebar);
    if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);
});
