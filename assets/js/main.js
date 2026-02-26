document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide Icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Back to Top Logic
    const backToTopBtn = document.getElementById('back-to-top');
    
    if (backToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTopBtn.classList.remove('opacity-0', 'translate-y-10');
            } else {
                backToTopBtn.classList.add('opacity-0', 'translate-y-10');
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
                        if(otherContent) otherContent.style.maxHeight = '0';
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
     if (typeof lucide !== 'undefined') {
         lucide.createIcons();
     }

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
            
            sidebar.classList.remove('translate-x-full', 'opacity-0');
            
            // Change menu icon to X (Optional)
            if (mobileBtn && typeof lucide !== 'undefined') {
                mobileBtn.innerHTML = '<i data-lucide="x" class="w-[26px] h-[26px]"></i>';
                lucide.createIcons();
            }
        } else {
            // Close
            overlay.classList.add('opacity-0');
            sidebar.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => {
                overlay.classList.add('hidden');
            }, 300);
            
            // Change X icon to menu
            if (mobileBtn && typeof lucide !== 'undefined') {
                mobileBtn.innerHTML = '<i data-lucide="menu" class="w-[26px] h-[26px]"></i>';
                lucide.createIcons();
            }
        }
    }

    if (mobileBtn) mobileBtn.addEventListener('click', toggleMobileMenu);
    if (closeMobileBtn) closeMobileBtn.addEventListener('click', toggleMobileMenu);
    if (overlay) overlay.addEventListener('click', toggleMobileMenu);

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
            const icon = toggle.querySelector('i');
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
                btn.innerHTML = 'پیام ارسال شد <i data-lucide="check" class="w-[18px] h-[18px]"></i>';
                if (typeof lucide !== 'undefined') lucide.createIcons();
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
                entry.target.classList.add('is-visible');
                // Optional: Stop observing once visible if you want it to animate only once
                // observer.unobserve(entry.target); 
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in-section').forEach(section => {
        observer.observe(section);
    });

    // Active Link Highlighting (Simple)
    const links = document.querySelectorAll('.nav-link');
    const isHome = document.body.classList.contains('home');
    const navBaseClass = isHome ? 'text-white/80' : 'text-slate-600';
    const navActiveClass = isHome ? 'text-white' : 'text-copper';
    links.forEach(link => {
        link.addEventListener('click', function() {
            // Remove active state from all
            links.forEach(l => {
                l.classList.remove(navActiveClass);
                l.classList.add(navBaseClass);
                // Find sibling underline and hide it
                const parent = l.parentElement;
                const underline = parent.querySelector('.nav-underline');
                if (underline) underline.classList.add('hidden');
            });
            
            // Add active state to current
            this.classList.remove(navBaseClass);
            this.classList.add(navActiveClass);
            // Show sibling underline
            const parent = this.parentElement;
            const underline = parent.querySelector('.nav-underline');
            if (underline) underline.classList.remove('hidden');
            
            // Close mobile menu if open
            if (overlay && !overlay.classList.contains('hidden')) {
                toggleMobileMenu();
            }
        });
    });
});
