const initMain = () => {
    // Back to Top Logic
    const backToTopBtn = document.getElementById('back-to-top');

    if (backToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTopBtn.classList.remove('opacity-0', 'translate-y-10', 'pointer-events-none');
            } else {
                backToTopBtn.classList.add('opacity-0', 'translate-y-10', 'pointer-events-none');
            }
        });

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Counter Animation
    const counterElement = document.getElementById('experience-counter');
    if (counterElement) {
        let count = 0;
        const target = 32;
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps

        const startCounter = () => {
            const interval = setInterval(() => {
                count += increment;
                if (count >= target) {
                    count = target;
                    clearInterval(interval);
                }
                counterElement.innerText = Math.floor(count);
            }, 16);
        };

        // Trigger when visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    startCounter();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        observer.observe(counterElement);
    }

    // FAQ Accordion Logic
    const faqContainer = document.getElementById('faq-container');
    if (faqContainer) {
        const faqItems = faqContainer.querySelectorAll('.group');
        faqItems.forEach(item => {
            const button = item.querySelector('button');
            const content = item.querySelector('.accordion-content');

            if (button && content) {
                button.addEventListener('click', () => {
                    const isActive = item.classList.contains('active');

                    // Close all others
                    faqItems.forEach(otherItem => {
                        otherItem.classList.remove('active');
                        const otherContent = otherItem.querySelector('.accordion-content');
                        if (otherContent) otherContent.style.maxHeight = '0';
                    });

                    // Toggle current
                    if (!isActive) {
                        item.classList.add('active');
                        content.style.maxHeight = content.scrollHeight + 'px';
                    }
                });
            }
        });
    }

    // Parallax Effect for Pattern
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY;
        const patterns = document.querySelectorAll('.pattern-bg');
        patterns.forEach(pattern => {
            // Check if section is visible to avoid unnecessary calcs
            const rect = pattern.parentElement.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                // Simple parallax: move background slightly opposite to scroll
                const speed = 0.05; // Slower speed for subtle effect
                const yPos = (window.scrollY - pattern.parentElement.offsetTop) * speed;

                // Check for initial flip (scaleX(-1))
                if (pattern.dataset.flipped === undefined) {
                    pattern.dataset.flipped = pattern.style.transform.includes('scaleX(-1)') || pattern.getAttribute('style')?.includes('scaleX(-1)');
                }
                const isFlipped = pattern.dataset.flipped === 'true';

                pattern.style.transform = isFlipped
                    ? `scaleX(-1) translateY(${yPos}px)`
                    : `translateY(${yPos}px)`;
            }
        });
    });

    // Initialize Icons
    // lucide icons removed

    // Mobile Menu Logic
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const closeMobileBtn = document.getElementById('close-mobile-menu');
    const overlay = document.getElementById('mobile-menu-overlay');
    const sidebar = document.getElementById('mobile-menu-sidebar');

    function toggleMobileMenu() {
        if (!overlay || !sidebar) return;

        const isHidden = overlay.classList.contains('hidden');

        if (isHidden) {
            // Open
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.remove('opacity-0'), 10);

            sidebar.classList.remove('translate-x-full', 'opacity-0', 'invisible');

            // Change menu icon to X (Optional)
            if (mobileBtn) {
                mobileBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-[26px] h-[26px]"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>';
            }
        } else {
            // Close
            overlay.classList.add('opacity-0');
            sidebar.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => {
                overlay.classList.add('hidden');
                sidebar.classList.add('invisible');
            }, 300);

            // Change X icon to menu
            if (mobileBtn) {
                mobileBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-[26px] h-[26px]"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>';
            }
        }
    }

    if (mobileBtn) mobileBtn.addEventListener('click', toggleMobileMenu);
    if (closeMobileBtn) closeMobileBtn.addEventListener('click', toggleMobileMenu);
    if (overlay) overlay.addEventListener('click', toggleMobileMenu);

    // Search Spotlight Logic
    const searchSpotlight = document.getElementById('search-spotlight');
    const searchOpenBtn = document.getElementById('search-open-btn');
    const searchCloseBtn = document.getElementById('search-close-btn');
    const searchOverlay = document.getElementById('search-overlay');
    const searchModalContent = document.getElementById('search-modal-content');
    const searchInputField = document.getElementById('search-input-field');

    function openSearch() {
        if (!searchSpotlight) return;
        searchSpotlight.classList.remove('hidden');
        setTimeout(() => {
            searchOverlay.classList.remove('opacity-0');
            searchModalContent.classList.remove('opacity-0', '-translate-y-10');
            searchInputField.focus();
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeSearch() {
        if (!searchSpotlight) return;
        searchOverlay.classList.add('opacity-0');
        searchModalContent.classList.add('opacity-0', '-translate-y-10');
        setTimeout(() => {
            searchSpotlight.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }

    if (searchOpenBtn) {
        searchOpenBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openSearch();
        });
    }

    if (searchCloseBtn) searchCloseBtn.addEventListener('click', closeSearch);
    if (searchOverlay) searchOverlay.addEventListener('click', closeSearch);

    // ESC key to close search or mobile menu
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeSearch();
            if (overlay && !overlay.classList.contains('hidden')) {
                toggleMobileMenu();
            }
        }
    });

    const mobileSubmenuToggles = document.querySelectorAll('.mobile-submenu-toggle');
    mobileSubmenuToggles.forEach(toggle => {
        toggle.addEventListener('click', event => {
            event.preventDefault();
            const parent = toggle.closest('.mobile-menu-item');
            const submenu = parent ? parent.querySelector('.mobile-submenu') : null;
            if (!submenu) return;
            const willOpen = submenu.classList.contains('hidden');
            submenu.classList.toggle('hidden');
            toggle.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
            const icon = toggle.querySelector('svg') || toggle.querySelector('i');
            if (icon) {
                icon.classList.toggle('rotate-180', willOpen);
            }
        });
    });

    // Ads Filter Logic
    const filterBtns = document.querySelectorAll('[data-filter]');
    const adItems = document.querySelectorAll('.ad-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Update active button state
            filterBtns.forEach(b => {
                b.classList.remove('bg-copper', 'text-white');
                b.classList.add('text-slate-500', 'hover:bg-slate-50');
            });
            btn.classList.remove('text-slate-500', 'hover:bg-slate-50');
            btn.classList.add('bg-copper', 'text-white');

            // Filter items
            const filter = btn.getAttribute('data-filter');
            adItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-type') === filter) {
                    item.classList.remove('hidden');
                    item.classList.add('fade-in-section'); // Re-trigger fade
                    setTimeout(() => item.classList.add('is-visible'), 10);
                } else {
                    item.classList.add('hidden');
                    item.classList.remove('is-visible');
                }
            });
        });
    });

    // Hero Slider Logic
    const heroDots = document.querySelectorAll('.hero-dot');
    const heroSlides = document.querySelectorAll('.hero-slide');
    let currentSlide = 0;
    let slideInterval;

    function showSlide(index) {
        // Ensure index is valid
        if (index < 0 || index >= heroSlides.length) return;

        // Update Slides
        heroSlides.forEach(slide => {
            slide.classList.remove('opacity-100');
            slide.classList.add('opacity-0');
        });

        const targetSlide = heroSlides[index];
        if (targetSlide) {
            targetSlide.classList.remove('opacity-0');
            targetSlide.classList.add('opacity-100');
        }

        // Update Dots
        heroDots.forEach(d => {
            d.classList.remove('w-6', 'bg-copper');
            d.classList.add('w-2.5', 'bg-white/40');
        });
        // Match dot index
        const activeDot = heroDots[index];
        if (activeDot) {
            activeDot.classList.remove('w-2.5', 'bg-white/40');
            activeDot.classList.add('w-6', 'bg-copper');
        }
        currentSlide = index;
    }

    function nextSlide() {
        let next = currentSlide + 1;
        if (next >= heroSlides.length) next = 0;
        showSlide(next);
    }

    function startSlider() {
        if (heroSlides.length > 0) {
            slideInterval = setInterval(nextSlide, 5000);
        }
    }

    function resetTimer() {
        clearInterval(slideInterval);
        startSlider();
    }

    heroDots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
            resetTimer();
        });
    });

    // Initialize
    startSlider();

    const newsSlides = document.querySelectorAll('.news-slide');
    const newsDots = document.querySelectorAll('.news-dot');
    const newsPrev = document.getElementById('news-prev');
    const newsNext = document.getElementById('news-next');
    let currentNewsSlide = 0;
    let newsInterval;

    function showNewsSlide(index) {
        if (index < 0 || index >= newsSlides.length) return;
        newsSlides.forEach(slide => {
            slide.classList.remove('opacity-100');
            slide.classList.add('opacity-0');
        });
        const targetSlide = newsSlides[index];
        if (targetSlide) {
            targetSlide.classList.remove('opacity-0');
            targetSlide.classList.add('opacity-100');
        }
        newsDots.forEach(d => {
            d.classList.remove('w-6', 'bg-copper');
            d.classList.add('w-2.5', 'bg-white/50');
        });
        const activeDot = newsDots[index];
        if (activeDot) {
            activeDot.classList.remove('w-2.5', 'bg-white/50');
            activeDot.classList.add('w-6', 'bg-copper');
        }
        currentNewsSlide = index;
    }

    function nextNewsSlide() {
        let next = currentNewsSlide + 1;
        if (next >= newsSlides.length) next = 0;
        showNewsSlide(next);
    }

    function prevNewsSlide() {
        let prev = currentNewsSlide - 1;
        if (prev < 0) prev = newsSlides.length - 1;
        showNewsSlide(prev);
    }

    function startNewsSlider() {
        if (newsSlides.length > 0) {
            newsInterval = setInterval(nextNewsSlide, 6000);
        }
    }

    function resetNewsTimer() {
        clearInterval(newsInterval);
        startNewsSlider();
    }

    newsDots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showNewsSlide(index);
            resetNewsTimer();
        });
    });

    if (newsNext) {
        newsNext.addEventListener('click', () => {
            nextNewsSlide();
            resetNewsTimer();
        });
    }

    if (newsPrev) {
        newsPrev.addEventListener('click', () => {
            prevNewsSlide();
            resetNewsTimer();
        });
    }

    startNewsSlider();

    const newsCarousel = document.getElementById('news-carousel');
    const newsNoticesGrid = document.getElementById('news-notices-grid');

    function syncNewsHeight() {
        if (!newsCarousel || !newsNoticesGrid) return;
        const gridHeight = newsNoticesGrid.offsetHeight;
        if (gridHeight > 0) {
            newsCarousel.style.height = `${gridHeight}px`;
        }
    }

    if (newsCarousel && newsNoticesGrid) {
        window.addEventListener('load', syncNewsHeight);
        window.addEventListener('resize', syncNewsHeight);
        setTimeout(syncNewsHeight, 0);
    }

    // Contact Form Logic
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            // Simulate sending
            const btn = contactForm.querySelector('button');
            const originalText = btn.innerHTML;
            btn.innerHTML = 'در حال ارسال...';
            btn.disabled = true;

            setTimeout(() => {
                btn.innerHTML = 'پیام ارسال شد <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-[18px] h-[18px]"><path d="M20 6 9 17l-5-5"/></svg>';
                btn.classList.remove('bg-copper');
                btn.classList.add('bg-green-600');
                contactForm.reset();

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.add('bg-copper');
                    btn.classList.remove('bg-green-600');
                    btn.disabled = false;
                }, 3000);
            }, 1500);
        });
    }

    // Intersection Observer for Animations
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible', 'active');
                // Optional: Stop observing once visible if you want it to animate only once
                // observer.unobserve(entry.target); 
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in-section, .scroll-reveal').forEach(section => {
        observer.observe(section);
    });

    // Active Link Highlighting (Simple)
    const links = document.querySelectorAll('.nav-link');
    const isHome = document.body.classList.contains('home');
    const navBaseClass = isHome ? 'text-white/80' : 'text-slate-600';
    const navActiveClass = isHome ? 'text-white' : 'text-copper';
    links.forEach(link => {
        link.addEventListener('click', function () {
            // Remove active state from all
            links.forEach(l => {
                l.classList.remove(navActiveClass);
                l.classList.add(navBaseClass);
            });

            // Add active state to current
            this.classList.remove(navBaseClass);
            this.classList.add(navActiveClass);

            // Close mobile menu if open
            if (overlay && !overlay.classList.contains('hidden')) {
                toggleMobileMenu();
            }
        });
    });

    // Global Header Parallax Scroll Effect for Internal Pages
    if (!document.body.classList.contains('home')) {
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            const heroHeader = document.querySelector('header');
            if (!heroHeader) return;

            const heroHeight = heroHeader.offsetHeight;
            if (scrollY > heroHeight) return;

            const ratio = scrollY / heroHeight;

            const bgImg = heroHeader.querySelector('.hero-bg-image');
            if (bgImg) {
                bgImg.style.transform = `translateY(${scrollY * 0.3}px) scale(${1 + ratio * 0.05})`;
            }

            const textContainer = heroHeader.querySelector('.hero-text-container') || heroHeader.querySelector('.container.relative.z-20') || heroHeader.querySelector('.container');
            if (textContainer) {
                textContainer.style.transform = `translateY(${scrollY * 0.38}px)`;
                textContainer.style.opacity = `${1 - ratio * 1.5}`;
            }

            const glow = heroHeader.querySelector('.hero-glow-accent');
            if (glow) {
                glow.style.transform = `translateY(${scrollY * 0.45}px)`;
                glow.style.opacity = `${0.35 - ratio * 0.9}`;
            }
        });
    }


    // ==========================================
    // FRONT PAGE ANIMATIONS & LOGIC
    // ==========================================
    if (document.body.classList.contains('home')) {
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
                    content.style.maxHeight = content.scrollHeight + 50 + 'px'; // +50 for padding
                    content.style.opacity = '1';
                }
            }
        }
        window.toggleFaq = toggleFaq;

        // Parallax Scroll Effect for Hero Elements
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            const heroHeader = document.querySelector('header');
            if (!heroHeader) return;

            const heroHeight = heroHeader.offsetHeight;
            if (scrollY > heroHeight) return;

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
                pattern.style.opacity = `${1 - ratio * 1.5}`;
            }

            const glow = heroHeader.querySelector('.hero-glow-accent');
            if (glow) {
                glow.style.transform = `translateY(${scrollY * 0.45}px)`;
                glow.style.opacity = `${0.35 - ratio * 0.9}`;
            }

            // Parallax and Fade for About Section
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

            // Parallax for Ads Section
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

            // Parallax for News Section
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

        // Counter Up Animation
        const counters = document.querySelectorAll('.counter-up');
        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    const finalValue = parseInt(target.getAttribute('data-target'));
                    const duration = 2000;
                    const stepTime = 20;
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

        // Entrance Animations (Fade Up)
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

        // Announcements Carousel Drag & Autoplay
        const carousel = document.getElementById('announcements-carousel');
        if (carousel) {
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

            carousel.addEventListener('touchstart', (e) => {
                stopAutoplay();
            }, { passive: true });
            carousel.addEventListener('touchend', () => {
                startAutoplay();
            });

            startAutoplay();
        }

        // Remove mask-image after sweepShimmer animation
        // const shimmer = document.querySelector('.hero-pattern-shimmer');
        // if (shimmer) {
        //     shimmer.addEventListener('animationend', (e) => {
        //         if (e.animationName === 'sweepShimmer') {
        //             const wrapper = document.querySelector('.hero-pattern-left-wrapper');
        //             const patternLeft = document.querySelector('.hero-pattern-left');

        //             if (wrapper) {
        //                 wrapper.style.transition = 'opacity 0.3s ease';
        //                 wrapper.style.opacity = '0.5';
        //                 wrapper.style.maskImage = 'none';
        //                 wrapper.style.webkitMaskImage = 'none';
        //                 // Gradually change opacity to 0.5 over 1 second



        //             }
        //             if (patternLeft) {
        //                 patternLeft.style.transition = 'opacity 0.3s ease';
        //                 patternLeft.style.opacity = '0.5';
        //                 patternLeft.style.maskImage = 'none';
        //                 patternLeft.style.webkitMaskImage = 'none';

        //             }
        //         }
        //     });
        // }
    }
};
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMain);
} else {
    initMain();
}
