<?php
get_header();
?>

<main class="container mx-auto px-4 mt-[120px] pb-16">
    <div class="max-w-7xl mx-auto">
        <div class="mb-12">
            <?php
            $archive_url = get_post_type_archive_link('kermancopper_ad');
            $current_term = get_queried_object();
            $term_count = $current_term ? $current_term->count : 0;
            ?>
            <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6" aria-label="breadcrumb">
                <a href="<?php echo esc_url($archive_url); ?>" class="flex items-center gap-1 hover:text-copper transition-colors">
                    <?php echo kermancopper_icon('layout-grid', 'w-4 h-4'); ?>
                    همه آگهی‌ها
                </a>
                <?php echo kermancopper_icon('chevron-left', 'w-4 h-4 text-slate-300'); ?>
                <span class="text-slate-800 font-medium"><?php single_term_title(); ?></span>
            </nav>
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-copper/10 text-copper text-xs font-semibold mb-3">
                        <?php echo kermancopper_icon('tag', 'w-3 h-3'); ?>
                        دسته‌بندی آگهی
                    </div>
                    <h1 class="text-3xl md:text-5xl font-medium text-slate-800 leading-tight mb-2"><?php single_term_title(); ?></h1>
                    <?php if (term_description()) : ?>
                        <p class="text-slate-600 text-lg"><?php echo esc_html(term_description()); ?></p>
                    <?php endif; ?>
                </div>
                <a href="<?php echo esc_url($archive_url); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-medium hover:border-copper hover:text-copper transition-all shrink-0">
                    <?php echo kermancopper_icon('arrow-right', 'w-4 h-4'); ?>
                    مشاهده همه آگهی‌ها
                </a>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <aside id="filter-sidebar" class="lg:w-80 lg:sticky lg:top-[130px] lg:self-start bg-white rounded-2xl border border-slate-200 shadow-sm p-6 lg:block hidden">
                <?php get_template_part('template-parts/ads/filter-form'); ?>
            </aside>

            <div class="flex-1">
                <div class="flex flex-wrap items-center justify-between gap-4 mb-8 p-4 bg-white rounded-xl border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-4">
                        <button id="mobile-filter-toggle" class="lg:hidden flex items-center gap-2 px-4 py-2 rounded-lg bg-copper text-white font-medium">
                            <?php echo kermancopper_icon('filter', 'w-5 h-5'); ?>
                            فیلترها
                        </button>
                        <span id="results-count" class="text-slate-700 font-medium"></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-slate-600 text-sm">مرتب‌سازی:</span>
                        <select id="sort-select" class="rounded-lg border border-slate-300 px-4 py-2 text-sm">
                            <option value="date_desc">جدیدترین</option>
                            <option value="date_asc">قدیمی‌ترین</option>
                            <option value="title_asc">نام (الفبا)</option>
                        </select>
                    </div>
                </div>

                <div id="ads-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <?php get_template_part('template-parts/ads/skeleton-loaders'); ?>
                </div>

                <div id="load-more-container" class="mt-10 text-center hidden">
                    <button id="load-more-btn" class="px-8 py-3 rounded-xl bg-white border border-slate-300 text-slate-700 font-medium hover:border-copper hover:text-copper transition-all">
                        بارگذاری بیشتر
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<div id="mobile-filter-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" id="mobile-filter-overlay"></div>
    <div id="mobile-filter-content" class="absolute bottom-0 left-0 right-0 bg-white rounded-t-3xl max-h-[85vh] overflow-y-auto p-6 transform translate-y-full transition-transform duration-300">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-slate-800">فیلترها</h3>
            <button id="mobile-filter-close" class="p-2 rounded-lg hover:bg-slate-100">
                <?php echo kermancopper_icon('x', 'w-6 h-6 text-slate-600'); ?>
            </button>
        </div>
        <?php get_template_part('template-parts/ads/filter-form'); ?>
    </div>
</div>

<style>
.filter-section {
    border-bottom: 1px solid #e2e8f0;
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
    font-weight: 600;
    color: #1e293b;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
}
.filter-toggle i {
    transition: transform 0.2s ease;
}
.filter-content {
    margin-top: 1rem;
}
.ad-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.ad-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
.ad-card-image {
    height: 200px;
    background-size: cover;
    background-position: center;
}
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
}
.status-badge.active {
    background: #dcfce7;
    color: #166534;
}
.status-badge.closed {
    background: #fee2e2;
    color: #991b1b;
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
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
}
@keyframes skeleton-loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}
.accordion-chevron {
    transition: transform 0.2s ease;
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
                const icon = this.querySelector('i');
                
                document.querySelectorAll('.filter-content').forEach(c => {
                    if (c !== content) {
                        c.style.display = 'none';
                        const otherIcon = c.previousElementSibling.querySelector('i');
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

                // Icons are handled by PHP inline SVGs
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
            html += '<div class="ad-card skeleton-container"><div class="skeleton h-48 w-full"></div><div class="p-5 space-y-3"><div class="skeleton h-6 w-3/4 rounded"></div><div class="skeleton h-4 w-full rounded"></div><div class="skeleton h-4 w-5/6 rounded"></div><div class="flex gap-2 pt-2"><div class="skeleton h-8 w-20 rounded-full"></div><div class="skeleton h-8 w-24 rounded-full"></div></div></div></div>';
        }
        return html;
    }

    document.addEventListener('DOMContentLoaded', init);
})();
</script>

<?php
get_footer();
