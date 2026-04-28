// Andrew.Devlog - Production Build Sync
import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

window.VITE_SYNC_VERSION = "2026-04-28-12-07"; // New hash v1207
console.log('Vite Build Active:', window.VITE_SYNC_VERSION);

document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle handled by Alpine.js in navbar component


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
