// Initialize Lucide Icons
document.addEventListener('DOMContentLoaded', () => {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Initialize Counters
    initCounters();

    // Initialize Intersection Observers
    initObservers();

    // Initialize Carousel
    initCarousel();

    // Initialize Back to Top
    initBackToTop();

    // Initialize Parallax
    initParallax();
});

// FAQ Toggle
function toggleFaq(button) {
    const item = button.closest('.faq-item');
    const isActive = item.getAttribute('data-active') === 'true';

    // Close all items
    document.querySelectorAll('.faq-item').forEach(el => {
        el.setAttribute('data-active', 'false');
        el.classList.remove('border-copper/30', 'shadow-[0_20px_50px_-15px_rgba(200,104,47,0.15)]');

        const title = el.querySelector('button span');
        if (title) {
            title.classList.remove('text-copper', 'border-copper');
            title.classList.add('text-navy', 'border-transparent');
        }

        const icon = el.querySelector('.faq-icon');
        if (icon) {
            icon.classList.remove('bg-copper/10', 'text-copper', 'rotate-180');
            icon.classList.add('bg-slate-50', 'text-slate-400');
        }

        const content = el.querySelector('.faq-content');
        if (content) {
            content.style.maxHeight = '0';
            content.style.opacity = '0';
            content.classList.remove('pb-8', 'pt-2');
            content.classList.add('pb-0', 'pt-0');
        }
    });

    // If the clicked item was not active, open it
    if (!isActive) {
        item.setAttribute('data-active', 'true');
        item.classList.add('border-copper/30', 'shadow-[0_20px_50px_-15px_rgba(200,104,47,0.15)]');

        const title = item.querySelector('button span');
        if (title) {
            title.classList.remove('text-navy', 'border-transparent');
            title.classList.add('text-copper', 'border-copper');
        }

        const icon = item.querySelector('.faq-icon');
        if (icon) {
            icon.classList.remove('bg-slate-50', 'text-slate-400');
            icon.classList.add('bg-copper/10', 'text-copper', 'rotate-180');
        }

        const content = item.querySelector('.faq-content');
        if (content) {
            content.classList.remove('pb-0', 'pt-0');
            content.classList.add('pb-8', 'pt-2');
            content.style.maxHeight = content.scrollHeight + 50 + 'px';
            content.style.opacity = '1';
        }
    }
}

// Form Submission Simulation
function handleFormSubmit(event) {
    event.preventDefault();
    const btn = event.target.querySelector('button[type="submit"]');
    const successDiv = document.getElementById('formSuccess');

    if (!btn) return;

    // Disable button during submit transition
    btn.setAttribute('disabled', 'true');
    btn.innerHTML = '<span class="flex items-center justify-center gap-2"><svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> در حال ارسال...</span>';

    setTimeout(() => {
        if (successDiv) {
            successDiv.classList.remove('hidden');
        }
        btn.innerHTML = '<span class="relative flex items-center justify-center gap-2">پیام با موفقیت ارسال شد <i data-lucide="check-circle" class="w-5 h-5"></i></span>';
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        event.target.reset();
    }, 1200);
}

// Counter Up Animation
function initCounters() {
    const counters = document.querySelectorAll('.counter-up');
    if (counters.length === 0) return;

    const counterObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const finalValue = parseInt(target.getAttribute('data-target'));
                const duration = 2000; // ms
                const stepTime = 20; // ms
                const steps = duration / stepTime;
                const increment = finalValue / steps;
                let current = 0;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= finalValue) {
                        target.innerText = new Intl.NumberFormat('fa-IR').format(finalValue);
                        clearInterval(timer);
                    } else {
                        target.innerText = new Intl.NumberFormat('fa-IR').format(Math.floor(current));
                    }
                }, stepTime);
                observer.unobserve(target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => {
        counterObserver.observe(counter);
    });
}

// Observers (Fade Up & Scroll Reveal)
function initObservers() {
    const fadeUpElements = document.querySelectorAll('.about-fade-up, .ads-fade-up, .fade-up-element, .faq-fade-up, .contact-fade-up');
    const fadeUpObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove('opacity-0', 'translate-y-10');
                entry.target.classList.add('opacity-100', 'translate-y-0');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });

    fadeUpElements.forEach(el => fadeUpObserver.observe(el));

    const revealElements = document.querySelectorAll('.scroll-reveal');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    revealElements.forEach(el => revealObserver.observe(el));
}

// Announcements Carousel
function initCarousel() {
    const carousel = document.getElementById('announcements-carousel');
    if (!carousel) return;

    let isDown = false;
    let startX;
    let scrollLeft;
    let autoplayInterval;

    const nextBtn = document.getElementById('ann-next-btn');
    const prevBtn = document.getElementById('ann-prev-btn');

    const slideNext = () => {
        const slideWidth = carousel.clientWidth;
        if (carousel.scrollLeft <= -(carousel.scrollWidth - slideWidth - 10)) {
            carousel.scrollTo({ left: 0, behavior: 'smooth' });
        } else {
            carousel.scrollBy({ left: -slideWidth, behavior: 'smooth' });
        }
    };

    const slidePrev = () => {
        const slideWidth = carousel.clientWidth;
        if (carousel.scrollLeft >= -10) {
            carousel.scrollTo({ left: -(carousel.scrollWidth - slideWidth), behavior: 'smooth' });
        } else {
            carousel.scrollBy({ left: slideWidth, behavior: 'smooth' });
        }
    };

    if (nextBtn) {
        nextBtn.addEventListener('click', (e) => {
            e.preventDefault();
            stopAutoplay();
            slideNext();
            startAutoplay();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', (e) => {
            e.preventDefault();
            stopAutoplay();
            slidePrev();
            startAutoplay();
        });
    }

    const startAutoplay = () => {
        autoplayInterval = setInterval(slideNext, 4000);
    };

    const stopAutoplay = () => clearInterval(autoplayInterval);

    carousel.addEventListener('mousedown', (e) => {
        isDown = true;
        carousel.classList.add('active');
        startX = e.pageX - carousel.offsetLeft;
        scrollLeft = carousel.scrollLeft;
        stopAutoplay();
    });

    carousel.addEventListener('mouseleave', () => {
        isDown = false;
        carousel.classList.remove('active');
        startAutoplay();
    });

    carousel.addEventListener('mouseup', () => {
        isDown = false;
        carousel.classList.remove('active');
        startAutoplay();
    });

    carousel.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - carousel.offsetLeft;
        const walk = (x - startX) * 2;
        carousel.scrollLeft = scrollLeft - walk;
    });

    carousel.addEventListener('touchstart', () => {
        stopAutoplay();
    }, { passive: true });

    carousel.addEventListener('touchend', () => {
        startAutoplay();
    });

    startAutoplay();
}

// Back to Top Button
function initBackToTop() {
    const backToTopBtn = document.getElementById('back-to-top');
    if (!backToTopBtn) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 600) {
            backToTopBtn.classList.remove('opacity-0', 'translate-y-10', 'pointer-events-none');
            backToTopBtn.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
        } else {
            backToTopBtn.classList.add('opacity-0', 'translate-y-10', 'pointer-events-none');
            backToTopBtn.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
        }
    });

    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Parallax Effects on Scroll
function initParallax() {
    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        const heroHeader = document.querySelector('header');
        
        // 1. Hero Parallax
        if (heroHeader) {
            const heroHeight = heroHeader.offsetHeight;
            if (scrollY <= heroHeight) {
                const ratio = scrollY / heroHeight;

                const bgImg = heroHeader.querySelector('.hero-bg-image');
                if (bgImg) {
                    bgImg.style.transform = `translateY(${scrollY * 0.3}px) scale(${1 + ratio * 0.05})`;
                }

                const textContainer = heroHeader.querySelector('.hero-text-container');
                if (textContainer) {
                    textContainer.style.transform = `translateY(${scrollY * 0.38}px)`;
                    textContainer.style.opacity = `${1 - ratio * 1.5}`;
                }

                const pattern = heroHeader.querySelector('.hero-pattern-left');
                if (pattern) {
                    pattern.style.transform = `scaleX(-1) translateY(${scrollY * 0.22}px)`;
                    pattern.style.opacity = `${0.55 - ratio * 0.8}`;
                }

                const glow = heroHeader.querySelector('.hero-glow-accent');
                if (glow) {
                    glow.style.transform = `translateY(${scrollY * 0.45}px)`;
                    glow.style.opacity = `${0.35 - ratio * 0.9}`;
                }
            }
        }

        // 2. About Section Parallax
        const aboutSection = document.getElementById('about');
        if (aboutSection) {
            const rect = aboutSection.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            if (rect.top <= windowHeight && rect.bottom >= 0) {
                const scrollProgress = 1 - (rect.bottom / (windowHeight + rect.height));

                const glowElements = aboutSection.querySelectorAll('.bg-copper\\/10, .bg-navy\\/5');
                glowElements.forEach((el, index) => {
                    const direction = index === 0 ? 1 : -1;
                    el.style.transform = `translateY(${scrollProgress * 200 * direction}px)`;
                });

                const parallaxItems = aboutSection.querySelectorAll('.about-parallax-item');
                if (parallaxItems.length >= 2) {
                    parallaxItems[0].style.transform = `translateY(${(scrollProgress - 0.5) * -120}px)`;
                    parallaxItems[1].style.transform = `translateY(${(scrollProgress - 0.5) * -60}px)`;
                }
            }
        }

        // 3. Ads Section Parallax
        const adsSection = document.getElementById('ads');
        if (adsSection) {
            const rect = adsSection.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            if (rect.top <= windowHeight && rect.bottom >= 0) {
                const scrollProgress = 1 - (rect.bottom / (windowHeight + rect.height));

                const adsItems = adsSection.querySelectorAll('.ads-parallax-item');
                adsItems.forEach((el, index) => {
                    const parallaxAmount = -60 + (index * 15);
                    el.style.transform = `translateY(${(scrollProgress - 0.5) * parallaxAmount}px)`;
                });
            }
        }

        // 4. News Section Parallax
        const newsSection = document.getElementById('news');
        if (newsSection) {
            const rect = newsSection.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            if (rect.top <= windowHeight && rect.bottom >= 0) {
                const scrollProgress = 1 - (rect.bottom / (windowHeight + rect.height));

                const newsItems = newsSection.querySelectorAll('.news-parallax-item');
                newsItems.forEach((el, index) => {
                    const parallaxAmount = -40 + (index * 20);
                    el.style.transform = `translateY(${(scrollProgress - 0.5) * parallaxAmount}px)`;
                });
            }
        }
    });
}
