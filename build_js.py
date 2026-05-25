import os

js_path = '/Users/user/Sites/localhost/kermancopper/wp-content/themes/kermancopper/assets/js/main.js'

def build():
    with open(js_path, 'r', encoding='utf-8') as f:
        js = f.read()

    new_js = """

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
                if(title) {
                    title.classList.remove('text-copper', 'border-copper');
                    title.classList.add('text-navy', 'border-transparent');
                }

                const icon = el.querySelector('.faq-icon');
                if(icon) {
                    icon.classList.remove('bg-copper/10', 'text-copper', 'rotate-180');
                    icon.classList.add('bg-slate-50', 'text-slate-400');
                }

                const content = el.querySelector('.faq-content');
                if(content) {
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
                if(title) {
                    title.classList.remove('text-navy', 'border-transparent');
                    title.classList.add('text-copper', 'border-copper');
                }

                const icon = item.querySelector('.faq-icon');
                if(icon) {
                    icon.classList.remove('bg-slate-50', 'text-slate-400');
                    icon.classList.add('bg-copper/10', 'text-copper', 'rotate-180');
                }

                const content = item.querySelector('.faq-content');
                if(content) {
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
                pattern.style.opacity = `${0.55 - ratio * 0.8}`;
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

                    const glowElements = aboutSection.querySelectorAll('.bg-copper\\\\/10, .bg-navy\\\\/5');
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
    }
"""
    # Insert new js before the closing `});` of DOMContentLoaded
    
    closing_idx = js.rfind("});")
    if closing_idx != -1:
        merged_js = js[:closing_idx] + new_js + js[closing_idx:]
        with open(js_path, 'w', encoding='utf-8') as f:
            f.write(merged_js)
    else:
        with open(js_path, 'a', encoding='utf-8') as f:
            f.write(new_js)

if __name__ == '__main__':
    build()
