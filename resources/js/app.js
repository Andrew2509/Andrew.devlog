// Andrew.Devlog - Production Build Sync
import './bootstrap';
import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollSmoother } from 'gsap/ScrollSmoother';
import Lenis from 'lenis';
import { createIcons, icons } from 'lucide';

// Expose libraries globally for blade inline scripts
window.Alpine = Alpine;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.ScrollSmoother = ScrollSmoother;
window.Lenis = Lenis;

// Expose Lucide and all icons for standard lucide.createIcons() usage
window.lucide = {
    createIcons: (config) => {
        return createIcons({
            icons,
            ...config
        });
    }
};

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

Alpine.start();

// Fail-safe: Ensure body is scrollable on load
document.body.classList.remove('mobile-menu-open');

window.VITE_SYNC_VERSION = "2026-04-28-12-07"; // New hash v1207
console.log('Vite Build Active:', window.VITE_SYNC_VERSION);

document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle handled by Alpine.js in navbar component
    // Fail-safe: Ensure scroll is unlocked when page loads or navigation happens
    document.body.classList.remove('mobile-menu-open');
    document.body.style.overflow = '';
    document.documentElement.style.overflow = '';


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
