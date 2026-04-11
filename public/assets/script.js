/**
 * Animations and Interactive Elements
 */

document.addEventListener('DOMContentLoaded', () => {

    // 1. Fade-in-up Observer (scroll trigger)
    const fadeElements = document.querySelectorAll('.fade-in-up-element');
    const fadeObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target); // Hanya animasi 1x saat pertama kali di-scroll
            }
        });
    }, { rootMargin: '0px 0px -50px 0px', threshold: 0.1 });

    fadeElements.forEach(el => fadeObserver.observe(el));

    // 2. Stats Counter Animation (Counting up)
    const counters = document.querySelectorAll('.counter');
    const speed = 200;

    const animateCounters = () => {
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const inc = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(updateCount, 15);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    }

    const counterObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    const statsSection = document.querySelector('.counter')?.closest('section');
    if(statsSection) counterObserver.observe(statsSection);

    // 3. Testimonial Auto-Fade Slider (REMOVED - Replaced by Elfsight Widget)
    // Slider logic removed to avoid errors as the HTML elements were replaced.

    // 4. Portfolio Category Filter System
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Update active state di tombol
            filterBtns.forEach(b => {
                b.classList.remove('bg-primary', 'text-white', 'border-primary');
                b.classList.add('bg-white', 'text-gray-600', 'border-gray-200');
            });
            btn.classList.remove('bg-white', 'text-gray-600', 'border-gray-200');
            btn.classList.add('bg-primary', 'text-white', 'border-primary');

            const filterValue = btn.getAttribute('data-filter');

            // Logika show/hide per item (dengan transisi halus)
            portfolioItems.forEach(item => {
                item.style.transition = 'all 0.4s ease';
                
                if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.classList.remove('hidden');
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 50);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        item.classList.add('hidden');
                    }, 400); // Menunggu transisi CSS selesai
                }
            });
        });
    });

    // 5. Initialize Navbar Scroll
    const initNavbarScroll = () => {
        const nav = document.querySelector('nav');
        if (!nav) return;
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                nav.classList.add('bg-white/95', 'shadow-md');
                nav.classList.remove('bg-white/90');
            } else {
                nav.classList.add('bg-white/90');
                nav.classList.remove('bg-white/95', 'shadow-md');
            }
        });
    };

    initNavbarScroll();

    // 6. Sidebar Active State Switcher (for Outbar)
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        item.addEventListener('click', () => {
            if (!item.hasAttribute('onclick')) {
                navItems.forEach(i => i.classList.remove('active', 'bg-primary-100/50', 'text-primary', 'border-r-4', 'border-primary'));
                item.classList.add('active');
            }
        });
    });
});

/**
 * Toggle Mobile Menu
 */
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuIcon = document.getElementById('mobile-menu-icon');
    
    if (!mobileMenu || !mobileMenuIcon) return;
    
    const isHidden = mobileMenu.classList.contains('hidden');
    
    if (isHidden) {
        // OPEN MENU
        mobileMenu.classList.remove('hidden');
        // Force reflow for height transition
        mobileMenu.offsetHeight; 
        mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
        mobileMenuIcon.classList.replace('fa-bars', 'fa-times');
        
        // Setup specialized click listener to close menu when clicking links
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            if (!link.dataset.hasListener) {
                link.addEventListener('click', () => {
                    closeMobileMenu();
                });
                link.dataset.hasListener = 'true';
            }
        });
    } else {
        // CLOSE MENU
        closeMobileMenu();
    }
}

/**
 * Helper to close mobile menu
 */
function closeMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuIcon = document.getElementById('mobile-menu-icon');
    
    if (!mobileMenu || !mobileMenuIcon) return;
    
    mobileMenu.style.maxHeight = '0';
    mobileMenuIcon.classList.replace('fa-times', 'fa-bars');
    
    setTimeout(() => {
        mobileMenu.classList.add('hidden');
    }, 300);
}

/**
 * Toggle Submenu for Sidebar (Outbar)
 */
function toggleSubmenu(id) {
    const submenu = document.getElementById(id);
    const icon = document.getElementById('icon-' + id);
    const parent = icon?.closest('.nav-item');
    
    if (submenu) {
        submenu.classList.toggle('open');
        if (icon) {
            icon.classList.toggle('rotate-180');
        }
        if (parent) {
            parent.classList.toggle('active');
        }
    }
}
