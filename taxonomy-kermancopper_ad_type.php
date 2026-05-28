<?php
/**
 * The template for displaying ad taxonomy pages
 *
 * @package KermanCopper
 */

get_header();
?>

    <!-- ARCHIVE HERO SECTION -->
    <header class="relative min-h-[450px] lg:min-h-[500px] flex items-center justify-center overflow-hidden bg-navy pt-32 lg:pt-40 pb-16">
        <!-- Background Image -->
        <div class="absolute inset-0 w-full h-full">
            <img src="<?php $hero_bg_image_id = get_theme_mod( 'kermancopper_home_hero_slide_1_image_id' ); $hero_bg_image_url = $hero_bg_image_id ? wp_get_attachment_image_url( $hero_bg_image_id, 'full' ) : ''; echo esc_url( $hero_bg_image_url ?: ( get_template_directory_uri() . '/images/pano sarcheshmeh.jpg' ) ); ?>" class="hero-bg-image w-full h-full object-cover opacity-35 mix-blend-overlay will-change-transform" alt="<?php single_term_title(); ?>">
            <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/70 to-transparent z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-l from-navy/50 via-transparent to-navy/50 z-10"></div>

            <!-- Glow Accent -->
            <div class="hero-glow-accent absolute -top-[20%] -right-[10%] w-[55%] h-[55%] bg-copper/35 rounded-full blur-[120px] animate-pulse-slow z-15">
            </div>
        </div>

        <!-- Pattern Background -->
        <div class="absolute inset-0 bg-[radial-gradient(rgba(200,104,47,0.15)_1px,transparent_1px)] bg-[size:32px_32px] opacity-60 z-10">
        </div>

        <div class="hero-text-container container mx-auto px-6 lg:px-12 relative z-20 text-center font-peyda">
            <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full glass-panel mb-6 border border-white/10 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] animate-fade-in-down delay-100 mx-auto">
                <?php echo kermancopper_icon('tag', 'w-4 h-4 text-copper-light'); ?>
                <span class="text-copper-light text-xs font-extrabold tracking-widest">آگهی‌ها، مناقصات و مزایدات</span>
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-4 animate-fade-in-down delay-200">
                <?php single_term_title(); ?>
            </h1>

            <?php if (term_description()) : ?>
                <div class="text-base text-slate-400 mx-auto font-light leading-relaxed animate-fade-in-down delay-300 mb-10 max-w-3xl">
                    <?php echo esc_html(term_description()); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Bottom Curve -->
        <div class="hero-curve">
            <img src="<?php echo get_template_directory_uri(); ?>/images/Union.png" srcset="<?php echo get_template_directory_uri(); ?>/images/Union.png 1440w, <?php echo get_template_directory_uri(); ?>/images/Union-300x37.png 300w, <?php echo get_template_directory_uri(); ?>/images/Union-1024x127.png 1024w, <?php echo get_template_directory_uri(); ?>/images/Union-768x95.png 768w" sizes="(max-width: 1440px) 100vw, 1440px" class="hero-curve-image" alt="" />
            <a href="#content-section" class="hero-curve-arrow" aria-label="بخش بعدی">
                <?php echo kermancopper_icon('chevrons-down', 'hero-curve-arrow-icon'); ?>
            </a>
        </div>
    </header>

    <!-- MAIN CONTENT SECTION -->
    <main id="content-section" class="relative z-20 pb-32 bg-gradient-to-b from-[#FAF8F5] via-white to-[#FAF8F5] pt-12 lg:pt-16">
        <!-- Dot Pattern Background -->
        <div class="absolute inset-0 bg-[radial-gradient(#c8c8c8_1px,transparent_1px)] bg-[size:24px_24px] opacity-30 pointer-events-none z-0">
        </div>

        <div class="container mx-auto px-6 lg:px-12 relative z-10 max-w-7xl">
            <?php
            $archive_url = get_post_type_archive_link('kermancopper_ad');
            $current_term = get_queried_object();
            $term_count = $current_term ? $current_term->count : 0;
            ?>

            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-sm text-slate-500 mb-8 scroll-reveal" aria-label="breadcrumb">
                <a href="<?php echo esc_url($archive_url); ?>" class="flex items-center gap-1.5 hover:text-copper transition-colors font-bold text-slate-400">
                    <?php echo kermancopper_icon('layout-grid', 'w-4 h-4'); ?>
                    همه آگهی‌ها
                </a>
                <?php echo kermancopper_icon('chevron-left', 'w-3.5 h-3.5 text-slate-300'); ?>
                <span class="text-navy font-black"><?php single_term_title(); ?></span>
            </nav>

            <div class="flex flex-col lg:flex-row gap-10 items-stretch">
                <!-- Sidebar (Desktop Filters) -->
                <aside id="filter-sidebar" class="lg:w-80 lg:sticky lg:top-[120px] lg:self-start bg-white rounded-[2rem] border border-slate-200/80 shadow-[0_15px_50px_rgba(0,0,0,0.03)] p-8 lg:block hidden scroll-reveal">
                    <?php get_template_part('template-parts/ads/filter-form'); ?>
                </aside>

                <!-- Grid & Loop Area -->
                <div class="flex-1 flex flex-col justify-between">
                    <!-- Filters Action Bar -->
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-8 p-4 bg-white rounded-2xl border border-slate-200/80 shadow-[0_15px_50px_rgba(0,0,0,0.03)] scroll-reveal">
                        <div class="flex items-center gap-4">
                            <button id="mobile-filter-toggle" class="lg:hidden flex items-center gap-2 px-5 py-3 rounded-xl bg-copper text-white font-bold hover:opacity-95 shadow-[0_10px_25px_rgba(200,104,47,0.2)] transition-all">
                                <?php echo kermancopper_icon('filter', 'w-5 h-5'); ?>
                                فیلترها
                            </button>
                            <span id="results-count" class="text-navy font-black">درحال دریافت آگهی‌ها...</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-slate-500 text-sm font-semibold">مرتب‌سازی:</span>
                            <select id="sort-select" class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-navy focus:outline-none focus:border-copper cursor-pointer transition-all">
                                <option value="date_desc">جدیدترین</option>
                                <option value="date_asc">قدیمی‌ترین</option>
                                <option value="title_asc">نام (الفبا)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Ajax Grid -->
                    <div id="ads-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                        <?php get_template_part('template-parts/ads/skeleton-loaders'); ?>
                    </div>

                    <!-- Load More Pagination -->
                    <div id="load-more-container" class="mt-12 text-center hidden">
                        <button id="load-more-btn" class="px-8 py-4 rounded-2xl bg-white border border-slate-200 text-slate-700 font-bold hover:border-copper hover:text-copper transition-all shadow-sm hover:shadow-md btn-ripple">
                            بارگذاری بیشتر
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Mobile Filters Overlay / Modal -->
    <div id="mobile-filter-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-navy/55 backdrop-blur-sm" id="mobile-filter-overlay"></div>
        <div id="mobile-filter-content" class="absolute bottom-0 left-0 right-0 bg-white rounded-t-[2.5rem] max-h-[85vh] overflow-y-auto p-8 transform translate-y-full transition-transform duration-300">
            <div class="flex items-center justify-between mb-8 pb-3 border-b border-slate-100">
                <h3 class="text-xl font-black text-navy font-peyda">فیلترهای جستجو</h3>
                <button id="mobile-filter-close" class="p-2.5 rounded-2xl hover:bg-slate-100/80 transition-colors">
                    <?php echo kermancopper_icon('x', 'w-6 h-6 text-slate-600'); ?>
                </button>
            </div>
            <?php get_template_part('template-parts/ads/filter-form'); ?>
        </div>
    </div>

<style>
.filter-section {
    border-bottom: 1px solid rgba(241, 245, 249, 0.8);
    padding-bottom: 1.5rem;
    margin-bottom: 1.5rem;
}
.filter-section:last-child {
    border-bottom: none;
    padding-bottom: 0;
    margin-bottom: 0;
}
.filter-toggle {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    text-align: right;
    font-weight: 800;
    color: #0f172a;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    font-family: 'peyda', sans-serif;
}
.filter-toggle svg {
    transition: transform 0.25s ease;
}
.filter-content {
    margin-top: 1rem;
}
.ad-card {
    background: #ffffff;
    border: 1px solid rgba(226, 232, 240, 0.8);
    border-radius: 2rem;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.02);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    height: 100%;
}
.ad-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
    border-color: rgba(200, 104, 47, 0.25);
}
.ad-card-image {
    height: 200px;
    background-size: cover;
    background-position: center;
}
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.35rem 0.85rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 700;
}
.status-badge.active {
    background: rgba(22, 101, 52, 0.1);
    color: #166534;
}
.status-badge.closed {
    background: rgba(153, 27, 27, 0.1);
    color: #991b1b;
}

/* Styling Inputs Inside Filters */
#filter-sidebar input, #filter-sidebar select,
#mobile-filter-modal input, #mobile-filter-modal select {
    border-radius: 1rem !important;
    border-color: #e2e8f0 !important;
    background-color: #f8fafc !important;
    padding-top: 0.875rem !important;
    padding-bottom: 0.875rem !important;
    font-weight: 600 !important;
    color: #0f172a !important;
    transition: all 0.3s ease !important;
}
#filter-sidebar input:focus, #filter-sidebar select:focus,
#mobile-filter-modal input:focus, #mobile-filter-modal select:focus {
    border-color: #c8682f !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(200, 104, 47, 0.15) !important;
}
#filter-sidebar button[type="submit"],
#mobile-filter-modal button[type="submit"] {
    border-radius: 1rem !important;
    background: linear-gradient(to left, #c8682f, #e28652) !important;
    font-weight: 800 !important;
    font-family: 'peyda', sans-serif !important;
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
    box-shadow: 0 10px 25px rgba(200,104,47,0.2) !important;
}
#filter-sidebar a#reset-filters,
#mobile-filter-modal a#reset-filters {
    border-radius: 1rem !important;
    border-color: #e2e8f0 !important;
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
    font-weight: 800 !important;
}

.btn-ripple {
    position: relative;
    overflow: hidden;
}
.btn-ripple .ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,0.4);
    transform: scale(0);
    animation: ripple 0.6s linear;
}
@keyframes ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}
.skeleton {
    background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
}
@keyframes skeleton-loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}
.accordion-chevron {
    transition: transform 0.25s ease;
}
</style>

<script>
(function() {
    let currentPage = 1;
    let isLoading = false;
    let hasMore = true;
    let debounceTimer = null;

    function getFilterElements(id) {
        return Array.from(document.querySelectorAll(`[id="${id}"]`));
    }

    function getActiveFilterElement(id) {
        const elements = getFilterElements(id);
        if (!elements.length) return null;
        return elements.find(el => el.offsetParent !== null) || elements[0];
    }

    function getFilterValue(id) {
        const element = getActiveFilterElement(id);
        return element ? element.value : '';
    }

    function setFilterValue(id, value) {
        getFilterElements(id).forEach(el => {
            el.value = value;
        });
    }

    function bindFilterEvent(id, eventName, handler) {
        getFilterElements(id).forEach(el => {
            el.addEventListener(eventName, handler);
        });
    }

    const init = function() {
        initDatePickers();
        initFilterAccordions();
        initMobileFilter();
        initRippleEffect();
        
        // Set initial ad type filter value on taxonomy page
        <?php if (is_tax('kermancopper_ad_type')) : ?>
            setFilterValue('ad-type-filter', '<?php echo esc_js(get_queried_object()->term_id); ?>');
        <?php endif; ?>
        
        loadAds(true);
        
        document.getElementById('sort-select').addEventListener('change', function() {
            loadAds(true);
        });

        bindFilterEvent('search-input', 'input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                loadAds(true);
            }, 300);
        });

        bindFilterEvent('ad-type-filter', 'change', function() {
            loadAds(true);
        });

        bindFilterEvent('status-filter', 'change', function() {
            loadAds(true);
        });

        bindFilterEvent('date-from', 'change', function() {
            loadAds(true);
        });

        bindFilterEvent('date-to', 'change', function() {
            loadAds(true);
        });

        const loadMoreBtn = document.getElementById('load-more-btn');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                loadAds(false);
            });
        }

        bindFilterEvent('reset-filters', 'click', function() {
            resetFilters();
        });
    };

    function initDatePickers() {
        if (window.jalaliDatepicker) {
            window.jalaliDatepicker.startWatch({
                minDate: "attr",
                maxDate: "attr"
            });
        }
    }

    function initFilterAccordions() {
        document.querySelectorAll('.filter-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const content = this.nextElementSibling;
                const icon = this.querySelector('svg');
                
                document.querySelectorAll('.filter-content').forEach(c => {
                    if (c !== content) {
                        c.style.display = 'none';
                        const otherIcon = c.previousElementSibling.querySelector('svg');
                        if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                    }
                });

                if (content.style.display === 'block') {
                    content.style.display = 'none';
                    if (icon) icon.style.transform = 'rotate(0deg)';
                } else {
                    content.style.display = 'block';
                    if (icon) icon.style.transform = 'rotate(180deg)';
                }
            });
        });
    }

    function initMobileFilter() {
        const modal = document.getElementById('mobile-filter-modal');
        const content = document.getElementById('mobile-filter-content');
        const toggleBtn = document.getElementById('mobile-filter-toggle');
        const closeBtn = document.getElementById('mobile-filter-close');
        const overlay = document.getElementById('mobile-filter-overlay');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', openMobileFilter);
        }
        if (closeBtn) {
            closeBtn.addEventListener('click', closeMobileFilter);
        }
        if (overlay) {
            overlay.addEventListener('click', closeMobileFilter);
        }

        function openMobileFilter() {
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('translate-y-full');
            }, 10);
        }

        function closeMobileFilter() {
            content.classList.add('translate-y-full');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    }

    function initRippleEffect() {
        document.querySelectorAll('.btn-ripple').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });
    }

    function getFilterParams() {
        const params = new URLSearchParams();
        params.append('action', 'kermancopper_filter_ads');
        params.append('page', currentPage);
        params.append('sort', document.getElementById('sort-select').value);

        const search = getFilterValue('search-input');
        if (search) params.append('search', search);

        const adType = getFilterValue('ad-type-filter');
        <?php if (is_tax('kermancopper_ad_type')) : ?>
            // On taxonomy page, always filter by current term_id
            params.append('ad_type', '<?php echo esc_js(get_queried_object()->term_id); ?>');
        <?php else : ?>
            if (adType && adType !== '0') params.append('ad_type', adType);
        <?php endif; ?>

        const status = getFilterValue('status-filter');
        if (status) params.append('status', status);

        const dateFrom = getFilterValue('date-from');
        if (dateFrom) params.append('date_from', dateFrom);

        const dateTo = getFilterValue('date-to');
        if (dateTo) params.append('date_to', dateTo);

        return params;
    }

    async function loadAds(reset = false) {
        if (isLoading) return;
        if (reset) {
            currentPage = 1;
            hasMore = true;
            document.getElementById('ads-grid').innerHTML = getSkeletonHTML();
        }

        isLoading = true;
        const params = getFilterParams();
        
        try {
            const response = await fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>?' + params.toString());
            const result = await response.json();
            
            if (result.success) {
                if (reset) {
                    document.getElementById('ads-grid').innerHTML = result.data.html;
                } else {
                    document.getElementById('ads-grid').insertAdjacentHTML('beforeend', result.data.html);
                }

                document.getElementById('results-count').textContent = result.data.total + ' آگهی یافت شد';
                hasMore = result.data.has_more;
                
                if (hasMore) {
                    document.getElementById('load-more-container').classList.remove('hidden');
                } else {
                    document.getElementById('load-more-container').classList.add('hidden');
                }

                currentPage++;
            }
        } catch (error) {
            console.error('Error loading ads:', error);
        } finally {
            isLoading = false;
        }
    }

    function resetFilters() {
        setFilterValue('search-input', '');
        <?php if (is_tax('kermancopper_ad_type')) : ?>
            setFilterValue('ad-type-filter', '<?php echo esc_js(get_queried_object()->term_id); ?>');
        <?php else : ?>
            setFilterValue('ad-type-filter', '0');
        <?php endif; ?>
        setFilterValue('status-filter', '');
        setFilterValue('date-from', '');
        setFilterValue('date-to', '');
        loadAds(true);
    }

    function getSkeletonHTML() {
        let html = '';
        for (let i = 0; i < 6; i++) {
            html += '<div class="ad-card skeleton-container"><div class="skeleton h-48 w-full"></div><div class="p-6 space-y-3"><div class="skeleton h-6 w-3/4 rounded"></div><div class="skeleton h-4 w-full rounded"></div><div class="skeleton h-4 w-5/6 rounded"></div><div class="flex gap-2 pt-2"><div class="skeleton h-8 w-20 rounded-full"></div><div class="skeleton h-8 w-24 rounded-full"></div></div></div></div>';
        }
        return html;
    }

    document.addEventListener('DOMContentLoaded', init);
})();
</script>

<?php
get_footer();
