// Andrew.Devlog - Production Build Sync
import './bootstrap';
window.VITE_SYNC_VERSION = Date.now();

document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle
    const mobileBtn = document.getElementById('mobile-menu-btn');
    if (mobileBtn) {
        mobileBtn.addEventListener('click', () => {
            document.body.classList.toggle('mobile-menu-open');
            mobileBtn.classList.toggle('open');
        });
    }

    // Close menu when clicking links
    const mobileLinks = document.querySelectorAll('.mobile-link');
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            document.body.classList.remove('mobile-menu-open');
            if (mobileBtn) mobileBtn.classList.remove('open');
        });
    });

    // Pill Logic for Desktop
    const pill = document.getElementById('nav-pill');
    const links = document.querySelectorAll('.nav-link');

    const updatePill = (element) => {
        if (!element || !pill) return;
        const rect = element.getBoundingClientRect();
        const parentRect = element.parentElement.getBoundingClientRect();

        pill.style.width = `${rect.width}px`;
        pill.style.left = `${rect.left - parentRect.left}px`;
        pill.style.opacity = '1';
        pill.style.transform = 'scale(1)';
    };

    if (pill) {
        const activeLink = document.querySelector('.nav-link[data-active="true"]');
        if (activeLink) {
            setTimeout(() => updatePill(activeLink), 300);
        }

        links.forEach(link => {
            link.addEventListener('mouseenter', () => updatePill(link));
            link.addEventListener('mouseleave', () => {
                const currentActive = document.querySelector('.nav-link[data-active="true"]');
                updatePill(currentActive);
            });
        });
    }

    // Scroll Logic for Navbar
    const nav = document.getElementById('main-nav');
    if (nav) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    }
});
