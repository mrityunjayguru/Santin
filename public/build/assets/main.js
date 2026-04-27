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

    const toggleSidebar = () => {
        sidebar.classList.toggle('-translate-x-full');
        sidebarOverlay.classList.toggle('hidden');
        document.body.classList.toggle('overflow-hidden');
    };

    if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', toggleSidebar);
    if (closeSidebarBtn) closeSidebarBtn.addEventListener('click', toggleSidebar);
    if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);

    // navLinks.forEach(link => {
    //     link.addEventListener('click', (e) => {
    //         // e.preventDefault();
    //         navLinks.forEach(l => {
    //             l.classList.remove(...activeClasses);
    //             l.classList.add(...inactiveClasses);
    //             const icon = l.querySelector('.nav-icon');
    //             if (icon) {
    //                 icon.classList.remove('invert');
    //                 icon.classList.add('opacity-70');
    //             }
    //         });
    //         link.classList.add(...activeClasses);
    //         link.classList.remove(...inactiveClasses);
    //         const clickedIcon = link.querySelector('.nav-icon');
    //         if (clickedIcon) {
    //             clickedIcon.classList.add('invert');
    //             clickedIcon.classList.remove('opacity-70');
    //         }
    //         const title = link.getAttribute('data-title');
    //         if (title && pageTitle) {
    //             pageTitle.textContent = title;
    //         }
    //         if (window.innerWidth < 1024) {
    //             toggleSidebar();
    //         }
    //     });
    // });
});
