<?php
$ad_types = get_terms(array(
    'taxonomy'   => 'kermancopper_ad_type',
    'hide_empty' => false,
));
$is_tax_page = is_tax('kermancopper_ad_type');
$current_tax_slug = $is_tax_page ? get_queried_object()->slug : '';
$form_action = $is_tax_page ? get_term_link(get_queried_object()) : get_post_type_archive_link('kermancopper_ad');
if (is_wp_error($form_action)) {
    $form_action = home_url('/');
}
$search_value = isset($_GET['search']) ? sanitize_text_field(wp_unslash($_GET['search'])) : '';
$status_value = isset($_GET['status']) ? sanitize_text_field(wp_unslash($_GET['status'])) : '';
$date_from_value = isset($_GET['date_from']) ? sanitize_text_field(wp_unslash($_GET['date_from'])) : '';
$date_to_value = isset($_GET['date_to']) ? sanitize_text_field(wp_unslash($_GET['date_to'])) : '';
$ad_type_value = isset($_GET['ad_type']) ? absint($_GET['ad_type']) : 0;
if ($is_tax_page) {
    $ad_type_value = get_queried_object()->term_id;
}
$sort_value = isset($_GET['sort']) ? sanitize_text_field(wp_unslash($_GET['sort'])) : '';
$reset_url = $form_action;
?>

<form method="get" action="<?php echo esc_url($form_action); ?>">
    <?php if ($sort_value !== '') : ?>
        <input type="hidden" name="sort" value="<?php echo esc_attr($sort_value); ?>">
    <?php endif; ?>

    <div class="filter-section">
        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-2" for="search-input">جستجوی نام</label>
            <div class="relative">
                <?php echo kermancopper_icon('search', 'absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400'); ?>
                <input type="text" name="search" id="search-input" value="<?php echo esc_attr($search_value); ?>" placeholder="نام آگهی را وارد کنید..." class="w-full rounded-lg border border-slate-300 pr-10 pl-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper">
            </div>
        </div>
    </div>

    <div class="filter-section">
        <button class="filter-toggle" type="button">
            <span>نوع آگهی</span>
            <?php echo kermancopper_icon('chevron-down', 'w-5 h-5 text-slate-500 accordion-chevron'); ?>
        </button>
        <div class="filter-content">
            <select name="ad_type" id="ad-type-filter" class="w-full rounded-lg border border-slate-300 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php disabled($is_tax_page); ?>>
                <option value="0">همه نوع‌ها</option>
                <?php if (!empty($ad_types) && !is_wp_error($ad_types)) : ?>
                    <?php foreach ($ad_types as $type) : ?>
                        <option value="<?php echo esc_attr($type->term_id); ?>" <?php selected($ad_type_value, $type->term_id); ?>><?php echo esc_html($type->name); ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <?php if ($is_tax_page) : ?>
                <input type="hidden" name="ad_type" value="<?php echo esc_attr(get_queried_object()->term_id); ?>">
            <?php endif; ?>
        </div>
    </div>

    <div class="filter-section">
        <button class="filter-toggle" type="button">
            <span>وضعیت</span>
            <?php echo kermancopper_icon('chevron-down', 'w-5 h-5 text-slate-500 accordion-chevron'); ?>
        </button>
        <div class="filter-content">
            <select name="status" id="status-filter" class="w-full rounded-lg border border-slate-300 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper">
                <option value="">همه وضعیت‌ها</option>
                <option value="active" <?php selected($status_value, 'active'); ?>>فعال</option>
                <option value="closed" <?php selected($status_value, 'closed'); ?>>غیرفعال</option>
            </select>
        </div>
    </div>

    <div class="filter-section">
        <button class="filter-toggle" type="button">
            <span>بازه تاریخ</span>
            <?php echo kermancopper_icon('chevron-down', 'w-5 h-5 text-slate-500 accordion-chevron'); ?>
        </button>
        <div class="filter-content space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2" for="date-from">از تاریخ</label>
                <input type="text" name="date_from" id="date-from" value="<?php echo esc_attr($date_from_value); ?>" placeholder="انتخاب کنید" class="w-full rounded-lg border border-slate-300 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper kermancopper-ad-datepicker" data-jdp>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2" for="date-to">تا تاریخ</label>
                <input type="text" name="date_to" id="date-to" value="<?php echo esc_attr($date_to_value); ?>" placeholder="انتخاب کنید" class="w-full rounded-lg border border-slate-300 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper kermancopper-ad-datepicker" data-jdp>
            </div>
        </div>
    </div>

    <div class="mt-8 space-y-3">
        <button type="submit" class="w-full px-4 py-3 rounded-xl bg-copper text-white font-medium hover:opacity-90 transition-all btn-ripple">
            اعمال فیلتر
        </button>
        <a href="<?php echo esc_url($reset_url); ?>" id="reset-filters" class="block text-center w-full px-4 py-3 rounded-xl bg-white border border-slate-300 text-slate-700 font-medium hover:border-copper hover:text-copper transition-all">
            پاک کردن فیلترها
        </a>
    </div>
</form>
