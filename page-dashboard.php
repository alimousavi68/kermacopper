<?php
/**
 * Template Name: پنل کاربری
 *
 * @package KermanCopper
 */

$login_page = get_page_by_path('login');
$login_url = $login_page ? get_permalink($login_page->ID) : home_url( '/login/' );

if ( ! is_user_logged_in() ) {
    wp_safe_redirect( $login_url );
    exit;
}

// Handle Logout
if ( isset( $_GET['action'] ) && $_GET['action'] === 'logout' ) {
    wp_logout();
    wp_safe_redirect( $login_url );
    exit;
}
$login_error = '';
$profile_message = '';
$profile_error = '';
$password_message = '';
$password_error = '';
$request_edit_message = '';
$request_edit_error = '';

$current_user_id = get_current_user_id();

// Handle Request Update Submission
if ( $current_user_id && $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['dashboard_request_edit_submit'] ) ) {
    $nonce = isset( $_POST['dashboard_request_edit_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['dashboard_request_edit_nonce'] ) ) : '';
    if ( wp_verify_nonce( $nonce, 'dashboard_request_edit_action' ) ) {
        $request_id = isset( $_POST['edit_request_id'] ) ? absint( $_POST['edit_request_id'] ) : 0;
        $request_post = $request_id ? get_post( $request_id ) : null;
        
        if ( $request_post && $request_post->post_type === KERMANCOPPER_AD_REQUEST_POST_TYPE && (int) $request_post->post_author === $current_user_id ) {
            $ad_id = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_AD_ID, true );
            $ad_expiry = get_post_meta( $ad_id, KERMANCOPPER_AD_META_EXPIRY_DATE, true );
            $today = current_time( 'Y-m-d' );
            $is_ad_active = ! $ad_expiry || $ad_expiry >= $today;
            $seen_status = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_SEEN, true );
            $is_seen = ( $seen_status === '1' );
            $can_edit = $is_ad_active && ! $is_seen;
            
            if ( $can_edit ) {
                $meta_keys = array(
                    'company', 'company_type', 'activity_type', 'company_name_en',
                    'national_id', 'establishment_date', 'economic_number', 'registration_number',
                    'registration_location', 'insurance_branch', 'ceo_name', 'ceo_national_id',
                    'ceo_mobile', 'phone', 'fax', 'website', 'email', 'postal_code',
                    'province', 'city', 'address', 'bank_sheba', 'bank_account', 'bank_branch',
                    'registration_reason'
                );
                
                $required_keys = array(
                    'company', 'company_type', 'activity_type', 'national_id', 'establishment_date',
                    'economic_number', 'registration_number', 'registration_location', 'insurance_branch',
                    'ceo_name', 'ceo_national_id', 'ceo_mobile', 'phone', 'website', 'email', 'postal_code',
                    'province', 'city', 'address', 'bank_sheba', 'bank_account', 'bank_branch',
                    'registration_reason'
                );
                
                $has_missing = false;
                foreach ( $required_keys as $req_key ) {
                    if ( empty( $_POST[ $req_key ] ) ) {
                        $has_missing = true;
                        break;
                    }
                }
                
                $email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
                
                if ( $has_missing ) {
                    $request_edit_error = 'لطفا همه فیلدهای ضروری را تکمیل کنید.';
                } elseif ( ! is_email( $email ) ) {
                    $request_edit_error = 'پست الکترونیک (ایمیل) وارد شده معتبر نیست.';
                } else {
                    foreach ( $meta_keys as $key ) {
                        if ( isset( $_POST[ $key ] ) ) {
                            $meta_name = constant( 'KERMANCOPPER_AD_REQUEST_META_' . strtoupper( $key ) );
                            $value = ( $key === 'address' || $key === 'registration_reason' ) 
                                ? sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) 
                                : sanitize_text_field( wp_unslash( $_POST[ $key ] ) );
                            update_post_meta( $request_id, $meta_name, $value );
                        }
                    }
                    $request_edit_message = 'تغییرات درخواست شما با موفقیت ذخیره گردید.';
                }
            } else {
                $request_edit_error = 'خطا: این درخواست دیگر قابل ویرایش نیست.';
            }
        } else {
            $request_edit_error = 'خطا: درخواست نامعتبر است یا شما دسترسی لازم را ندارید.';
        }
    } else {
        $request_edit_error = 'خطا: نشست امنیتی منقضی شده است. لطفا مجددا تلاش کنید.';
    }
}


// Handle Profile Update Submission
if ( $current_user_id && $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['dashboard_profile_submit'] ) ) {
    $nonce = isset( $_POST['dashboard_profile_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['dashboard_profile_nonce'] ) ) : '';
    if ( wp_verify_nonce( $nonce, 'dashboard_profile_action' ) ) {
        $email = sanitize_email( wp_unslash( $_POST['email'] ) );
        $company = sanitize_text_field( wp_unslash( $_POST['company'] ) );
        $ceo_name = sanitize_text_field( wp_unslash( $_POST['ceo_name'] ) );
        $mobile = sanitize_text_field( wp_unslash( $_POST['mobile'] ) );
        $phone = sanitize_text_field( wp_unslash( $_POST['phone'] ) );
        $website = sanitize_text_field( wp_unslash( $_POST['website'] ) );
        $address = sanitize_textarea_field( wp_unslash( $_POST['address'] ) );

        if ( ! is_email( $email ) ) {
            $profile_error = 'ایمیل وارد شده معتبر نیست.';
        } else {
            // Check if email is in use by another user
            $existing_user = get_user_by( 'email', $email );
            if ( $existing_user && $existing_user->ID !== $current_user_id ) {
                $profile_error = 'این آدرس ایمیل قبلاً توسط کاربر دیگری استفاده شده است.';
            } else {
                // Update Email
                $update_user = wp_update_user( array(
                    'ID'         => $current_user_id,
                    'user_email' => $email,
                    'first_name' => $ceo_name,
                ) );

                if ( is_wp_error( $update_user ) ) {
                    $profile_error = 'خطا در به‌روزرسانی مشخصات.';
                } else {
                    // Update user meta
                    update_user_meta( $current_user_id, 'company', $company );
                    update_user_meta( $current_user_id, 'ceo_name', $ceo_name );
                    update_user_meta( $current_user_id, 'mobile', $mobile );
                    update_user_meta( $current_user_id, 'phone', $phone );
                    update_user_meta( $current_user_id, 'website', $website );
                    update_user_meta( $current_user_id, 'address', $address );

                    $profile_message = 'اطلاعات عمومی با موفقیت به‌روزرسانی شد.';
                }
            }
        }
    }
}

// Handle Password Update Submission
if ( $current_user_id && $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['dashboard_password_submit'] ) ) {
    $nonce = isset( $_POST['dashboard_password_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['dashboard_password_nonce'] ) ) : '';
    if ( wp_verify_nonce( $nonce, 'dashboard_password_action' ) ) {
        $old_pass = $_POST['old_pwd'];
        $new_pass = $_POST['new_pwd'];
        $new_pass_confirm = $_POST['new_pwd_confirm'];

        $user = get_user_by( 'id', $current_user_id );

        if ( ! wp_check_password( $old_pass, $user->user_pass, $current_user_id ) ) {
            $password_error = 'کلمه عبور فعلی نادرست است.';
        } elseif ( strlen( $new_pass ) < 8 ) {
            $password_error = 'کلمه عبور جدید باید حداقل ۸ کاراکتر باشد.';
        } elseif ( $new_pass !== $new_pass_confirm ) {
            $password_error = 'تکرار کلمه عبور جدید مطابقت ندارد.';
        } else {
            wp_set_password( $new_pass, $current_user_id );
            
            // Re-authenticate user after changing password
            $creds = array(
                'user_login'    => $user->user_login,
                'user_password' => $new_pass,
                'remember'      => true,
            );
            wp_signon( $creds, false );

            $password_message = 'کلمه عبور با موفقیت تغییر یافت.';
        }
    }
}

get_header(); ?>

<!-- Dashboard Hero Header -->
<header class="relative min-h-[520px] flex items-center justify-center overflow-hidden bg-navy pt-32 lg:pt-40 pb-16">
    <!-- Background Image -->
    <div class="absolute inset-0 w-full h-full">
        <img src="<?php echo get_template_directory_uri(); ?>/images/image2.jpg" class="hero-bg-image w-full h-full object-cover opacity-35 mix-blend-overlay will-change-transform" alt="پنل کاربری">
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
        <!-- Badge -->
        <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full glass-panel mb-6 border border-white/10 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] animate-fade-in-down delay-100 mx-auto">
            <span class="text-copper-light text-xs font-extrabold tracking-widest">پورتال الکترونیکی متقاضیان</span>
        </div>

        <!-- Title -->
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-4 animate-fade-in-down delay-200">
            پنل کاربری متقاضیان
        </h1>

        <p class="text-base text-slate-400 mx-auto font-light leading-relaxed animate-fade-in-down delay-300 mb-20 max-w-2xl">
            امکان مشاهده، پیگیری و ویرایش درخواست‌های ثبت‌شده برای آگهی‌ها و مناقصات مس کرمان زمین
        </p>
    </div>

    <!-- Bottom Curve (Union image) -->
    <div class="hero-curve">
        <img src="<?php echo get_template_directory_uri(); ?>/images/Union.png" srcset="<?php echo get_template_directory_uri(); ?>/images/Union.png 1440w, <?php echo get_template_directory_uri(); ?>/images/Union-300x37.png 300w, <?php echo get_template_directory_uri(); ?>/images/Union-1024x127.png 1024w, <?php echo get_template_directory_uri(); ?>/images/Union-768x95.png 768w" sizes="(max-width: 1440px) 100vw, 1440px" class="hero-curve-image" alt="" />
        <a href="#content" class="hero-curve-arrow" aria-label="بخش بعدی">
            <?php echo kermancopper_icon('chevrons-down', 'hero-curve-arrow-icon'); ?>
        </a>
    </div>
</header>

<main id="content" class="relative z-20 bg-gradient-to-b from-[#FAF8F5] via-white to-[#FAF8F5] pb-24 pt-12 lg:pt-16 font-peyda overflow-hidden">
    <!-- Background Glow Accent -->
    <div class="absolute -top-[10%] -left-[10%] w-[45%] h-[45%] bg-copper/5 rounded-full blur-[100px] pointer-events-none z-0"></div>
    <div class="absolute bottom-0 right-0 w-[45%] h-[45%] bg-navy/5 rounded-full blur-[100px] pointer-events-none z-0"></div>

    <div class="container mx-auto px-6 lg:px-12 max-w-6xl relative z-10 animate-fade-in">

            <!-- Dashboard Panel -->
            <?php
            $user_obj = wp_get_current_user();
            $meta_company = get_user_meta( $current_user_id, 'company', true );
            $meta_ceo_name = get_user_meta( $current_user_id, 'ceo_name', true );
            $meta_mobile = get_user_meta( $current_user_id, 'mobile', true );
            $meta_phone = get_user_meta( $current_user_id, 'phone', true );
            $meta_website = get_user_meta( $current_user_id, 'website', true );
            $meta_address = get_user_meta( $current_user_id, 'address', true );
            $meta_national_id = get_user_meta( $current_user_id, 'national_id', true ) ?: $user_obj->user_login;

            $active_tab = isset( $_GET['tab'] ) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : 'requests';

            // Query requests count stats
            $total_requests = 0;
            $seen_requests = 0;
            $pending_requests = 0;

            $stats_query = new WP_Query( array(
                'post_type'      => KERMANCOPPER_AD_REQUEST_POST_TYPE,
                'post_status'    => 'private',
                'author'         => $current_user_id,
                'posts_per_page' => -1,
                'fields'         => 'ids',
            ) );

            if ( $stats_query->have_posts() ) {
                $total_requests = $stats_query->post_count;
                foreach ( $stats_query->posts as $p_id ) {
                    $seen_status = get_post_meta( $p_id, KERMANCOPPER_AD_REQUEST_META_SEEN, true );
                    if ( $seen_status === '1' ) {
                        $seen_requests++;
                    } else {
                        $pending_requests++;
                    }
                }
            }
            ?>

            <?php
            $registration_notice = isset( $_GET['registration_notice'] ) ? sanitize_key( wp_unslash( $_GET['registration_notice'] ) ) : '';
            if ( $registration_notice === 'new' ) :
            ?>
                <div class="mb-8 p-6 bg-emerald-50 border border-emerald-200 rounded-3xl flex items-start gap-4 animate-fade-in">
                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <?php echo kermancopper_icon('check-circle', 'w-6 h-6'); ?>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-emerald-800 mb-1">ثبت‌نام و درخواست شما با موفقیت انجام شد</h4>
                        <p class="text-emerald-700 leading-relaxed font-medium">
                            شما هم‌اکنون به پنل کاربری خود وارد شده‌اید. می‌توانید با استفاده از <strong>شناسه ملی</strong> و <strong>رمز عبوری</strong> که در هنگام ثبت‌نام وارد کرده‌اید، در مراجعات بعدی به این پنل وارد شوید و اطلاعات خود را تکمیل یا وضعیت درخواست‌هایتان را پیگیری کنید.
                        </p>
                    </div>
                </div>
            <?php elseif ( $registration_notice === 'existing' ) : ?>
                <div class="mb-8 p-6 bg-emerald-50 border border-emerald-200 rounded-3xl flex items-start gap-4 animate-fade-in">
                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <?php echo kermancopper_icon('check-circle', 'w-6 h-6'); ?>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-emerald-800 mb-1">درخواست شما با موفقیت به حساب کاربری متصل و ثبت شد</h4>
                        <p class="text-emerald-700 leading-relaxed font-medium">
                            درخواست جدید به حساب کاربری شما متصل گردید. می‌توانید از این پنل وضعیت درخواست‌های خود را پیگیری کنید.
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Stats cards row -->
            <div class="grid grid-cols-3 gap-2 md:gap-6 mb-8 stats-grid">
                <!-- Card 1: Total -->
                <div class="bg-white border border-slate-200/60 rounded-[1rem] md:rounded-3xl p-2.5 md:p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col items-center justify-center md:flex-row md:justify-between gap-1.5 md:gap-2 relative overflow-hidden group">
                    <div class="absolute top-0 bottom-0 right-0 w-1 md:w-1.5 bg-copper"></div>
                    <div class="text-center md:text-right min-w-0">
                        <span class="text-[10px] md:text-xs font-bold text-slate-500 block mb-0.5 truncate">کل درخواست‌ها</span>
                        <span class="text-lg md:text-3xl font-black text-navy font-mono leading-none"><?php echo esc_html( $total_requests ); ?></span>
                        <span class="text-[10px] text-slate-500 hidden md:block mt-2">درخواست‌های ثبت‌شده شما</span>
                    </div>
                    <div class="w-7 h-7 md:w-12 md:h-12 rounded-lg md:rounded-2xl bg-copper/5 flex items-center justify-center text-copper group-hover:scale-110 transition-transform duration-300 flex-shrink-0">
                        <?php echo kermancopper_icon( 'file-text', 'w-4 h-4 md:w-6 md:h-6' ); ?>
                    </div>
                </div>
                
                <!-- Card 2: Reviewed -->
                <div class="bg-white border border-slate-200/60 rounded-[1rem] md:rounded-3xl p-2.5 md:p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col items-center justify-center md:flex-row md:justify-between gap-1.5 md:gap-2 relative overflow-hidden group">
                    <div class="absolute top-0 bottom-0 right-0 w-1 md:w-1.5 bg-emerald-500"></div>
                    <div class="text-center md:text-right min-w-0">
                        <span class="text-[10px] md:text-xs font-bold text-slate-500 block mb-0.5 truncate">بررسی شده</span>
                        <span class="text-lg md:text-3xl font-black text-navy font-mono leading-none"><?php echo esc_html( $seen_requests ); ?></span>
                        <span class="text-[10px] text-slate-500 hidden md:block mt-2">پاسخ داده شده یا نهایی</span>
                    </div>
                    <div class="w-7 h-7 md:w-12 md:h-12 rounded-lg md:rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform duration-300 flex-shrink-0">
                        <?php echo kermancopper_icon( 'check-circle', 'w-4 h-4 md:w-6 md:h-6' ); ?>
                    </div>
                </div>

                <!-- Card 3: Pending -->
                <div class="bg-white border border-slate-200/60 rounded-[1rem] md:rounded-3xl p-2.5 md:p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col items-center justify-center md:flex-row md:justify-between gap-1.5 md:gap-2 relative overflow-hidden group">
                    <div class="absolute top-0 bottom-0 right-0 w-1 md:w-1.5 bg-amber-500"></div>
                    <div class="text-center md:text-right min-w-0">
                        <span class="text-[10px] md:text-xs font-bold text-slate-500 block mb-0.5 truncate">در انتظار بررسی</span>
                        <span class="text-lg md:text-3xl font-black text-navy font-mono leading-none"><?php echo esc_html( $pending_requests ); ?></span>
                        <span class="text-[10px] text-slate-500 hidden md:block mt-2">در حال بررسی مدارک</span>
                    </div>
                    <div class="w-7 h-7 md:w-12 md:h-12 rounded-lg md:rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform duration-300 flex-shrink-0">
                        <?php echo kermancopper_icon( 'clock', 'w-4 h-4 md:w-6 md:h-6' ); ?>
                    </div>
                </div>
            </div>

            <!-- Mobile Nav bar (visible on mobile only) -->
            <div class="block lg:hidden w-full mb-8 bg-white border border-slate-200/80 rounded-[2rem] p-5 shadow-sm">
                <div class="flex items-center gap-4 pb-4 border-b border-slate-100 mb-4">
                    <div class="w-12 h-12 rounded-full border border-slate-200/80 bg-gradient-to-tr from-slate-100 to-slate-50 flex items-center justify-center flex-shrink-0 shadow-inner overflow-hidden">
                        <svg class="w-7 h-7 text-slate-400/90" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h4 class="font-bold text-navy text-sm truncate"><?php echo esc_html( $meta_company ?: 'بدون نام شرکت' ); ?></h4>
                        <span class="text-[10px] text-slate-500 font-semibold block mt-0.5">
                            شناسه ملی: <span class="font-mono text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded" dir="ltr"><?php echo esc_html( $meta_national_id ); ?></span>
                        </span>
                    </div>
                    <a href="?action=logout" class="w-9 h-9 rounded-xl bg-rose-50 flex items-center justify-center text-rose-600 hover:bg-rose-100 transition-colors flex-shrink-0" title="خروج">
                        <?php echo kermancopper_icon( 'x', 'w-4 h-4' ); ?>
                    </a>
                </div>
                
                <div class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar -mx-2 px-2">
                    <a href="?tab=requests" class="px-4 py-2.5 rounded-full text-xs font-bold whitespace-nowrap transition-all duration-300 <?php echo $active_tab === 'requests' ? 'bg-copper text-white shadow-md shadow-copper/15' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'; ?>">
                        درخواست‌های من
                    </a>
                    <a href="?tab=profile" class="px-4 py-2.5 rounded-full text-xs font-bold whitespace-nowrap transition-all duration-300 <?php echo $active_tab === 'profile' ? 'bg-copper text-white shadow-md shadow-copper/15' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'; ?>">
                        مشخصات عمومی
                    </a>
                    <a href="?tab=password" class="px-4 py-2.5 rounded-full text-xs font-bold whitespace-nowrap transition-all duration-300 <?php echo $active_tab === 'password' ? 'bg-copper text-white shadow-md shadow-copper/15' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'; ?>">
                        تغییر کلمه عبور
                    </a>
                </div>
            </div>

            <!-- Dashboard Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 dashboard-grid">
                <!-- Desktop Sidebar -->
                <div class="hidden lg:block lg:col-span-1 dashboard-sidebar">
                    <div class="bg-white border border-slate-200/80 rounded-[2rem] shadow-[0_10px_35px_rgba(0,0,0,0.02)] p-6">
                        <div class="flex flex-col items-center text-center pb-6 border-b border-slate-100 mb-6">
                            <!-- Avatar with simple vector -->
                            <div class="w-24 h-24 rounded-full border border-slate-200 bg-gradient-to-tr from-slate-100 to-slate-50 flex items-center justify-center mb-4 shadow-inner relative group/avatar overflow-hidden">
                                <svg class="w-12 h-12 text-slate-400/90 transition-transform duration-300 group-hover/avatar:scale-105" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            
                            <h3 class="font-bold text-navy text-base leading-tight mb-2"><?php echo esc_html( $meta_company ?: 'بدون نام شرکت' ); ?></h3>
                            <span class="text-xs text-slate-500 font-semibold flex items-center gap-1.5 justify-center mb-4">
                                <span>شناسه ملی:</span>
                                <span class="font-mono text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md" dir="ltr"><?php echo esc_html( $meta_national_id ); ?></span>
                            </span>

                            <!-- Compact info list in a tidy card -->
                            <div class="w-full text-right bg-slate-50/60 rounded-2xl p-4 border border-slate-100/70 text-xs space-y-3 mt-2">
                                <?php if ( ! empty($meta_ceo_name) ) : ?>
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex items-center gap-2 text-slate-500">
                                        <?php echo kermancopper_icon( 'user', 'w-4 h-4 text-slate-400' ); ?>
                                        <span class="font-bold">مدیرعامل:</span>
                                    </div>
                                    <span class="text-slate-700 font-semibold"><?php echo esc_html( $meta_ceo_name ); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if ( ! empty($meta_mobile) ) : ?>
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex items-center gap-2 text-slate-500">
                                        <?php echo kermancopper_icon( 'smartphone', 'w-4 h-4 text-slate-400' ); ?>
                                        <span class="font-bold">موبایل:</span>
                                    </div>
                                    <span class="text-slate-700 font-mono font-bold" dir="ltr"><?php echo esc_html( $meta_mobile ); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if ( ! empty($user_obj->user_email) ) : ?>
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex items-center gap-2 text-slate-500">
                                        <?php echo kermancopper_icon( 'mail', 'w-4 h-4 text-slate-400' ); ?>
                                        <span class="font-bold">ایمیل:</span>
                                    </div>
                                    <span class="text-slate-700 font-semibold truncate max-w-[140px]" title="<?php echo esc_attr( $user_obj->user_email ); ?>"><?php echo esc_html( $user_obj->user_email ); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Sidebar Nav Menu -->
                        <nav class="flex flex-col gap-2">
                            <a href="?tab=requests" class="flex items-center justify-between px-4 py-3 rounded-2xl text-sm font-bold transition-all duration-250 ease-out <?php echo $active_tab === 'requests' ? 'bg-copper text-white shadow-md shadow-copper/15 -translate-x-1' : 'text-slate-700 hover:text-copper hover:bg-slate-50 border border-transparent group hover:-translate-x-1'; ?>">
                                <div class="flex items-center gap-3">
                                    <span class="<?php echo $active_tab === 'requests' ? 'text-white' : 'text-slate-400 group-hover:text-copper'; ?> transition-colors duration-200">
                                        <?php echo kermancopper_icon( 'file-text', 'w-5 h-5 flex-shrink-0' ); ?>
                                    </span>
                                    <span>درخواست‌های من</span>
                                </div>
                                <span class="text-xs px-2.5 py-0.5 rounded-full font-mono font-bold transition-all duration-200 <?php echo $active_tab === 'requests' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-copper/10 group-hover:text-copper'; ?>"><?php echo esc_html($total_requests); ?></span>
                            </a>
                            <a href="?tab=profile" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-bold transition-all duration-250 ease-out <?php echo $active_tab === 'profile' ? 'bg-copper text-white shadow-md shadow-copper/15 -translate-x-1' : 'text-slate-700 hover:text-copper hover:bg-slate-50 border border-transparent group hover:-translate-x-1'; ?>">
                                <span class="<?php echo $active_tab === 'profile' ? 'text-white' : 'text-slate-400 group-hover:text-copper'; ?> transition-colors duration-200">
                                    <?php echo kermancopper_icon( 'user', 'w-5 h-5 flex-shrink-0' ); ?>
                                </span>
                                <span>مشخصات عمومی</span>
                            </a>
                            <a href="?tab=password" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-bold transition-all duration-250 ease-out <?php echo $active_tab === 'password' ? 'bg-copper text-white shadow-md shadow-copper/15 -translate-x-1' : 'text-slate-700 hover:text-copper hover:bg-slate-50 border border-transparent group hover:-translate-x-1'; ?>">
                                <span class="<?php echo $active_tab === 'password' ? 'text-white' : 'text-slate-400 group-hover:text-copper'; ?> transition-colors duration-200">
                                    <?php echo kermancopper_icon( 'shield-check', 'w-5 h-5 flex-shrink-0' ); ?>
                                </span>
                                <span>تغییر کلمه عبور</span>
                            </a>
                            <div class="border-t border-slate-100 my-2.5"></div>
                            <a href="?action=logout" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-bold text-rose-600 hover:bg-rose-50 hover:text-rose-700 border border-transparent transition-all duration-250 ease-out group hover:-translate-x-1">
                                <span class="text-rose-400 group-hover:text-rose-600 transition-colors duration-200">
                                    <?php echo kermancopper_icon( 'x', 'w-5 h-5 flex-shrink-0' ); ?>
                                </span>
                                <span>خروج از حساب</span>
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="lg:col-span-3 dashboard-content">
                    <div class="bg-white border border-slate-200/80 rounded-[2rem] shadow-[0_10px_35px_rgba(0,0,0,0.02)] p-6 sm:p-8 animate-fade-in">
                        
                        <?php if ( $active_tab === 'requests' ) : ?>
                            <?php
                            $view_request_id = isset( $_GET['view_request'] ) ? absint( wp_unslash( $_GET['view_request'] ) ) : 0;
                            $view_request_post = $view_request_id ? get_post( $view_request_id ) : null;
                            
                            if ( $view_request_post && $view_request_post->post_type === KERMANCOPPER_AD_REQUEST_POST_TYPE && (int) $view_request_post->post_author === $current_user_id ) :
                                // --- REQUEST DETAILED FORM VIEW ---
                                $ad_id = get_post_meta( $view_request_id, KERMANCOPPER_AD_REQUEST_META_AD_ID, true );
                                $ad_title = $ad_id ? get_the_title( $ad_id ) : 'آگهی حذف شده یا نامشخص';
                                $ad_expiry = get_post_meta( $ad_id, KERMANCOPPER_AD_META_EXPIRY_DATE, true );
                                $today = current_time( 'Y-m-d' );
                                $is_ad_active = ! $ad_expiry || $ad_expiry >= $today;
                                $seen_status = get_post_meta( $view_request_id, KERMANCOPPER_AD_REQUEST_META_SEEN, true );
                                $is_seen = ( $seen_status === '1' );
                                $can_edit = $is_ad_active && ! $is_seen;
                                $readonly_attr = $can_edit ? '' : 'disabled';
                                $provinces_cities = kermancopper_get_provinces_cities();
                                
                                // Fetch request field values
                                $field_vals = array();
                                $meta_keys = array(
                                    'company', 'company_type', 'activity_type', 'company_name_en',
                                    'national_id', 'establishment_date', 'economic_number', 'registration_number',
                                    'registration_location', 'insurance_branch', 'ceo_name', 'ceo_national_id',
                                    'ceo_mobile', 'phone', 'fax', 'website', 'email', 'postal_code',
                                    'province', 'city', 'address', 'bank_sheba', 'bank_account', 'bank_branch',
                                    'registration_reason'
                                );
                                foreach ( $meta_keys as $key ) {
                                    $meta_name = constant( 'KERMANCOPPER_AD_REQUEST_META_' . strtoupper( $key ) );
                                    $field_vals[ $key ] = get_post_meta( $view_request_id, $meta_name, true );
                                }
                                ?>
                                <!-- Breadcrumb Navigation -->
                                <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-6 bg-slate-50 px-4 py-2.5 rounded-xl border border-slate-100 w-fit">
                                    <a href="?tab=requests" class="hover:text-copper transition-colors">داشبورد</a>
                                    <span><?php echo kermancopper_icon('chevron-left', 'w-3 h-3 text-slate-400'); ?></span>
                                    <a href="?tab=requests" class="hover:text-copper transition-colors">درخواست‌های من</a>
                                    <span><?php echo kermancopper_icon('chevron-left', 'w-3 h-3 text-slate-400'); ?></span>
                                    <span class="text-slate-800 font-bold max-w-[200px] truncate"><?php echo esc_html( $ad_title ); ?></span>
                                </nav>

                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-4 border-b border-slate-100">
                                    <h2 class="text-xl font-black text-navy flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full bg-copper"></span>
                                        جزئیات درخواست: <?php echo esc_html( $ad_title ); ?>
                                    </h2>
                                    <a href="?tab=requests" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-bold transition-all shadow-sm">
                                        <?php echo kermancopper_icon( 'arrow-right', 'w-4 h-4' ); ?> بازگشت به لیست
                                    </a>
                                </div>
                                
                                <?php if ( ! empty( $request_edit_message ) ) : ?>
                                    <div class="mb-6 text-sm px-5 py-4 rounded-2xl border bg-emerald-50 border-emerald-200 text-emerald-600 flex items-center gap-3 font-semibold">
                                        <?php echo kermancopper_icon( 'check-circle', 'w-5 h-5 flex-shrink-0' ); ?>
                                        <span><?php echo esc_html( $request_edit_message ); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ( ! empty( $request_edit_error ) ) : ?>
                                    <div class="mb-6 text-sm px-5 py-4 rounded-2xl border bg-rose-50 border-rose-200 text-rose-600 flex items-center gap-3 font-semibold">
                                        <?php echo kermancopper_icon( 'alert-triangle', 'w-5 h-5 flex-shrink-0' ); ?>
                                        <span><?php echo esc_html( $request_edit_error ); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ( $can_edit ) : ?>
                                    <div class="mb-8 text-sm px-5 py-4 rounded-2xl border bg-amber-50 border-amber-200 text-amber-700 flex items-center gap-3 font-semibold">
                                        <?php echo kermancopper_icon( 'info', 'w-5 h-5 flex-shrink-0 text-amber-500' ); ?>
                                        <span>امکان ویرایش این درخواست برای شما فعال است. پس از اصلاح مقادیر، دکمه ذخیره را کلیک کنید.</span>
                                    </div>
                                <?php else : ?>
                                    <div class="mb-8 text-sm px-5 py-4 rounded-2xl border bg-slate-50 border-slate-200 text-slate-600 flex items-center gap-3 font-semibold">
                                        <?php echo kermancopper_icon( 'lock', 'w-5 h-5 flex-shrink-0 text-slate-400' ); ?>
                                        <span>مهلت ویرایش درخواست به پایان رسیده یا توسط کارشناسان بررسی شده است؛ اطلاعات قابل تغییر نیستند.</span>
                                    </div>
                                <?php endif; ?>
                                
                                <form method="post" action="" class="space-y-8">
                                    <?php wp_nonce_field( 'dashboard_request_edit_action', 'dashboard_request_edit_nonce' ); ?>
                                    <input type="hidden" name="edit_request_id" value="<?php echo esc_attr( $view_request_id ); ?>" />
                                    
                                    <!-- Group 1: Basic Info -->
                                    <div class="bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group">
                                        <div class="absolute top-0 right-0 left-0 h-1 bg-gradient-to-l from-copper to-copper/30"></div>
                                        <div class="flex items-center gap-3 pb-3 border-b border-slate-100 mb-6">
                                            <div class="w-10 h-10 rounded-xl bg-copper/5 text-copper flex items-center justify-center flex-shrink-0">
                                                <?php echo kermancopper_icon( 'user', 'w-5 h-5' ); ?>
                                            </div>
                                            <h3 class="text-base font-black text-navy">اطلاعات پایه شرکت</h3>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="company_type">نوع شرکت *</label>
                                                <select id="company_type" name="company_type" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold appearance-none cursor-pointer" required <?php echo $readonly_attr; ?>>
                                                    <option value="">انتخاب کنید</option>
                                                    <option <?php selected( $field_vals['company_type'], 'شرکت سهامی خاص' ); ?>>شرکت سهامی خاص</option>
                                                    <option <?php selected( $field_vals['company_type'], 'شرکت سهامی عام' ); ?>>شرکت سهامی عام</option>
                                                    <option <?php selected( $field_vals['company_type'], 'شرکت بامسئولیت محدود' ); ?>>شرکت بامسئولیت محدود</option>
                                                    <option <?php selected( $field_vals['company_type'], 'شرکت تعاونی' ); ?>>شرکت تعاونی</option>
                                                    <option <?php selected( $field_vals['company_type'], 'شخص حقیقی' ); ?>>شخص حقیقی</option>
                                                    <option <?php selected( $field_vals['company_type'], 'موسسه' ); ?>>موسسه</option>
                                                    <option <?php selected( $field_vals['company_type'], 'دفاتر بیمه' ); ?>>دفاتر بیمه</option>
                                                    <option <?php selected( $field_vals['company_type'], 'تجاری یا فروشگاه' ); ?>>تجاری یا فروشگاه</option>
                                                    <option <?php selected( $field_vals['company_type'], 'موسسات حقوقی یا وکلا' ); ?>>موسسات حقوقی یا وکلا</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="activity_type">نوع فعالیت *</label>
                                                <select id="activity_type" name="activity_type" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold appearance-none cursor-pointer" required <?php echo $readonly_attr; ?>>
                                                    <option value="">انتخاب کنید</option>
                                                    <option <?php selected( $field_vals['activity_type'], 'پیمانکار' ); ?>>پیمانکار</option>
                                                    <option <?php selected( $field_vals['activity_type'], 'مشاوره' ); ?>>مشاوره</option>
                                                    <option <?php selected( $field_vals['activity_type'], 'خریدار، بهره بردار یا کارفرما' ); ?>>خریدار، بهره بردار یا کارفرما</option>
                                                    <option <?php selected( $field_vals['activity_type'], 'فروشنده' ); ?>>فروشنده</option>
                                                    <option <?php selected( $field_vals['activity_type'], 'سازنده' ); ?>>سازنده</option>
                                                    <option <?php selected( $field_vals['activity_type'], 'تولیدکننده' ); ?>>تولیدکننده</option>
                                                    <option <?php selected( $field_vals['activity_type'], 'مشاوره حقوقی' ); ?>>مشاوره حقوقی</option>
                                                    <option <?php selected( $field_vals['activity_type'], 'مزایده گر' ); ?>>مزایده گر</option>
                                                    <option <?php selected( $field_vals['activity_type'], 'بیمارستان، داروخانه و آزمایشگاه' ); ?>>بیمارستان، داروخانه و آزمایشگاه</option>
                                                    <option <?php selected( $field_vals['activity_type'], 'کارگزاری بیمه' ); ?>>کارگزاری بیمه</option>
                                                    <option <?php selected( $field_vals['activity_type'], 'دانشگاه یا مرکز آموزشی' ); ?>>دانشگاه یا مرکز آموزشی</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="company">نام شرکت (فارسی) *</label>
                                                <input type="text" id="company" name="company" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['company'] ); ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="company_name_en">نام شرکت (انگلیسی)</label>
                                                <input type="text" id="company_name_en" name="company_name_en" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['company_name_en'] ); ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="national_id">شناسه ملی / کد ملی *</label>
                                                <input type="text" id="national_id" name="national_id" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['national_id'] ); ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="establishment_date">تاریخ تاسیس *</label>
                                                <input type="text" id="establishment_date" name="establishment_date" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" data-jdp required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['establishment_date'] ); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Group 2: Registration & Financial -->
                                    <div class="bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group">
                                        <div class="absolute top-0 right-0 left-0 h-1 bg-gradient-to-l from-copper to-copper/30"></div>
                                        <div class="flex items-center gap-3 pb-3 border-b border-slate-100 mb-6">
                                            <div class="w-10 h-10 rounded-xl bg-copper/5 text-copper flex items-center justify-center flex-shrink-0">
                                                <?php echo kermancopper_icon( 'factory', 'w-5 h-5' ); ?>
                                            </div>
                                            <h3 class="text-base font-black text-navy">اطلاعات ثبتی و مالی</h3>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="economic_number">شماره اقتصادی یا جواز *</label>
                                                <input type="text" id="economic_number" name="economic_number" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['economic_number'] ); ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="registration_number">شماره ثبت *</label>
                                                <input type="text" id="registration_number" name="registration_number" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['registration_number'] ); ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="registration_location">محل ثبت *</label>
                                                <input type="text" id="registration_location" name="registration_location" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['registration_location'] ); ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="insurance_branch">شعبه بیمه *</label>
                                                <input type="text" id="insurance_branch" name="insurance_branch" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['insurance_branch'] ); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Group 3: CEO & Contacts -->
                                    <div class="bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group">
                                        <div class="absolute top-0 right-0 left-0 h-1 bg-gradient-to-l from-copper to-copper/30"></div>
                                        <div class="flex items-center gap-3 pb-3 border-b border-slate-100 mb-6">
                                            <div class="w-10 h-10 rounded-xl bg-copper/5 text-copper flex items-center justify-center flex-shrink-0">
                                                <?php echo kermancopper_icon( 'phone-call', 'w-5 h-5' ); ?>
                                            </div>
                                            <h3 class="text-base font-black text-navy">اطلاعات مدیریت و ارتباطات</h3>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="ceo_name">نام و نام خانوادگی مدیرعامل *</label>
                                                <input type="text" id="ceo_name" name="ceo_name" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['ceo_name'] ); ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="ceo_national_id">کد ملی مدیر عامل *</label>
                                                <input type="text" id="ceo_national_id" name="ceo_national_id" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['ceo_national_id'] ); ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="ceo_mobile">موبایل مدیرعامل *</label>
                                                <input type="text" id="ceo_mobile" name="ceo_mobile" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['ceo_mobile'] ); ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="phone">تلفن ثابت *</label>
                                                <input type="text" id="phone" name="phone" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['phone'] ); ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="fax">نمابر (فکس)</label>
                                                <input type="text" id="fax" name="fax" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['fax'] ); ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="website">آدرس وب‌سایت *</label>
                                                <input type="text" id="website" name="website" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['website'] ); ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="email">پست الکترونیک (ایمیل) *</label>
                                                <input type="email" id="email" name="email" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['email'] ); ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="postal_code">کد پستی *</label>
                                                <input type="text" id="postal_code" name="postal_code" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['postal_code'] ); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Group 4: Address -->
                                    <div class="bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group">
                                        <div class="absolute top-0 right-0 left-0 h-1 bg-gradient-to-l from-copper to-copper/30"></div>
                                        <div class="flex items-center gap-3 pb-3 border-b border-slate-100 mb-6">
                                            <div class="w-10 h-10 rounded-xl bg-copper/5 text-copper flex items-center justify-center flex-shrink-0">
                                                <?php echo kermancopper_icon( 'map-pin', 'w-5 h-5' ); ?>
                                            </div>
                                            <h3 class="text-base font-black text-navy">نشانی پستی شرکت</h3>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="province">استان *</label>
                                                <?php if ( $can_edit && ! empty( $provinces_cities ) ) : ?>
                                                    <select id="province" name="province" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold appearance-none cursor-pointer" required>
                                                        <option value="">انتخاب استان</option>
                                                        <?php foreach ( $provinces_cities as $prov => $cities ) : ?>
                                                            <option <?php selected( $field_vals['province'], $prov ); ?> value="<?php echo esc_attr( $prov ); ?>"><?php echo esc_html( $prov ); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                <?php else : ?>
                                                    <input type="text" id="province" name="province" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required disabled value="<?php echo esc_attr( $field_vals['province'] ); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="city">شهر *</label>
                                                <?php if ( $can_edit && ! empty( $provinces_cities ) ) : ?>
                                                    <select id="city" name="city" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold appearance-none cursor-pointer" required>
                                                        <option value=""><?php echo esc_html( $field_vals['city'] ?: 'انتخاب شهر' ); ?></option>
                                                        <?php 
                                                        $curr_prov = $field_vals['province'];
                                                        if ( $curr_prov && isset( $provinces_cities[$curr_prov] ) ) {
                                                            foreach ( $provinces_cities[$curr_prov] as $c ) {
                                                                echo '<option ' . selected( $field_vals['city'], $c, false ) . ' value="' . esc_attr( $c ) . '">' . esc_html( $c ) . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                <?php else : ?>
                                                    <input type="text" id="city" name="city" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required disabled value="<?php echo esc_attr( $field_vals['city'] ); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="address">نشانی دقیق پستی *</label>
                                                <textarea id="address" name="address" rows="3" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all resize-none font-semibold" required <?php echo $readonly_attr; ?>><?php echo esc_html( $field_vals['address'] ); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Group 5: Bank Info -->
                                    <div class="bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group">
                                        <div class="absolute top-0 right-0 left-0 h-1 bg-gradient-to-l from-copper to-copper/30"></div>
                                        <div class="flex items-center gap-3 pb-3 border-b border-slate-100 mb-6">
                                            <div class="w-10 h-10 rounded-xl bg-copper/5 text-copper flex items-center justify-center flex-shrink-0">
                                                <?php echo kermancopper_icon( 'gem', 'w-5 h-5' ); ?>
                                            </div>
                                            <h3 class="text-base font-black text-navy">اطلاعات بانکی شرکت</h3>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="bank_sheba">شماره شبا (IBAN) *</label>
                                                <input type="text" id="bank_sheba" name="bank_sheba" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['bank_sheba'] ); ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="bank_account">شماره حساب بانکی *</label>
                                                <input type="text" id="bank_account" name="bank_account" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['bank_account'] ); ?>" />
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="bank_branch">نام و کد شعبه بانک *</label>
                                                <input type="text" id="bank_branch" name="bank_branch" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo $readonly_attr; ?> value="<?php echo esc_attr( $field_vals['bank_branch'] ); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Group 6: Reason/Records -->
                                    <div class="bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group">
                                        <div class="absolute top-0 right-0 left-0 h-1 bg-gradient-to-l from-copper to-copper/30"></div>
                                        <div class="flex items-center gap-3 pb-3 border-b border-slate-100 mb-6">
                                            <div class="w-10 h-10 rounded-xl bg-copper/5 text-copper flex items-center justify-center flex-shrink-0">
                                                <?php echo kermancopper_icon( 'file-text', 'w-5 h-5' ); ?>
                                            </div>
                                            <h3 class="text-base font-black text-navy">دلایل ثبت نام و سوابق</h3>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 gap-6">
                                            <div>
                                                <label class="block text-sm font-bold text-slate-700 mb-2" for="registration_reason">دلایل ثبت نام و سوابق *</label>
                                                <textarea id="registration_reason" name="registration_reason" rows="4" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all resize-none font-semibold" required <?php echo $readonly_attr; ?>><?php echo esc_html( $field_vals['registration_reason'] ); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php if ( $can_edit ) : ?>
                                        <div class="flex justify-end pt-6 border-t border-slate-100">
                                            <button type="submit" name="dashboard_request_edit_submit" class="inline-flex items-center gap-2 bg-copper hover:bg-copper-dark text-white font-black text-base px-8 py-3.5 rounded-2xl transition-all shadow-md shadow-copper/10 hover:shadow-lg hover:shadow-copper/20 hover:-translate-y-0.5 group">
                                                <span>ذخیره تغییرات درخواست</span>
                                                <?php echo kermancopper_icon( 'send', 'w-4 h-4 transition-transform group-hover:translate-x-0.5' ); ?>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </form>
                            <?php else : ?>
                                <!-- --- STANDARD REQUESTS LIST VIEW --- -->
                                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                                    <h2 class="text-xl font-black text-navy flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full bg-copper"></span>
                                        لیست درخواست‌های ثبت شده
                                    </h2>
                                </div>

                                <?php
                                $requests_query = new WP_Query( array(
                                    'post_type'      => KERMANCOPPER_AD_REQUEST_POST_TYPE,
                                    'post_status'    => 'private',
                                    'author'         => $current_user_id,
                                    'posts_per_page' => -1,
                                ) );

                                if ( $requests_query->have_posts() ) :
                                ?>
                                    <!-- Requests list (table) -->
                                    <div class="overflow-x-auto rounded-3xl border border-slate-200/60 shadow-sm bg-white">
                                        <table class="w-full text-right border-collapse text-sm min-w-[600px]">
                                            <thead>
                                                <tr class="bg-slate-50/75 border-b border-slate-200 text-slate-500 font-bold">
                                                    <th class="py-5 px-6 min-w-[200px]">عنوان آگهی</th>
                                                    <th class="py-5 px-6 text-center whitespace-nowrap">تاریخ ارسال</th>
                                                    <th class="py-5 px-6 text-center whitespace-nowrap">وضعیت بررسی</th>
                                                    <th class="py-5 px-6 text-center whitespace-nowrap">عملیات</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                                                <?php
                                                while ( $requests_query->have_posts() ) :
                                                    $requests_query->the_post();
                                                    $req_id = get_the_ID();
                                                    $ad_id = get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_AD_ID, true );
                                                    $ad_title = $ad_id ? get_the_title( $ad_id ) : 'آگهی حذف شده یا نامشخص';
                                                    $ad_link = $ad_id ? get_permalink( $ad_id ) : '#';
                                                    $seen_status = get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_SEEN, true );
                                                    $is_seen = ( $seen_status === '1' );
                                                    
                                                    // Format Date
                                                    $date_display = get_the_date( 'Y/m/d' );
                                                    if ( function_exists( 'kermancopper_gregorian_to_jalali' ) ) {
                                                        $g_date = get_the_date( 'Y-m-d' );
                                                        $g_parts = explode( '-', $g_date );
                                                        if ( count( $g_parts ) === 3 ) {
                                                            $j_date = kermancopper_gregorian_to_jalali( (int) $g_parts[0], (int) $g_parts[1], (int) $g_parts[2] );
                                                            $date_display = sprintf( '%04d/%02d/%02d', $j_date[0], $j_date[1], $j_date[2] );
                                                        }
                                                    }
                                                ?>
                                                    <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                                                        <td class="py-5 px-6">
                                                            <?php if ( $ad_id ) : ?>
                                                                <a href="<?php echo esc_url( $ad_link ); ?>" class="text-navy hover:text-copper transition-colors font-bold" target="_blank">
                                                                    <?php echo esc_html( $ad_title ); ?>
                                                                </a>
                                                            <?php else : ?>
                                                                <span class="text-slate-400"><?php echo esc_html( $ad_title ); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="py-5 px-6 text-center text-slate-500 font-mono whitespace-nowrap"><?php echo esc_html( $date_display ); ?></td>
                                                        <td class="py-5 px-6 text-center">
                                                            <span class="inline-flex items-center justify-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap <?php echo $is_seen ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600'; ?>">
                                                                <span class="w-1.5 h-1.5 rounded-full flex-shrink-0 <?php echo $is_seen ? 'bg-emerald-500' : 'bg-amber-500 animate-pulse'; ?>"></span>
                                                                <span><?php echo $is_seen ? 'بررسی شده' : 'در انتظار بررسی'; ?></span>
                                                            </span>
                                                        </td>
                                                        <td class="py-5 px-6 text-center">
                                                            <a href="?tab=requests&view_request=<?php echo esc_attr( $req_id ); ?>" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-lg bg-navy/5 text-navy hover:bg-copper hover:text-white transition-all text-xs font-bold border border-transparent whitespace-nowrap">
                                                                <?php echo kermancopper_icon( 'eye', 'w-3.5 h-3.5 flex-shrink-0' ); ?> <span>مشاهده جزئیات</span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; wp_reset_postdata(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else : ?>
                                    <div class="text-center py-16 px-4 bg-slate-50/50 rounded-3xl border border-dashed border-slate-200">
                                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-100 text-slate-400 mb-5 animate-pulse">
                                            <?php echo kermancopper_icon( 'file-text', 'w-10 h-10 text-slate-400' ); ?>
                                        </div>
                                        <h3 class="text-lg font-black text-navy mb-2">درخواستی یافت نشد</h3>
                                        <p class="text-slate-500 text-sm font-medium max-w-sm mx-auto mb-6 leading-relaxed">
                                            شما هنوز هیچ درخواستی برای شرکت در فرآیند آگهی‌ها ثبت نکرده‌اید.
                                        </p>
                                        <a href="<?php echo esc_url( get_post_type_archive_link( 'kermancopper_ad' ) ); ?>" class="inline-flex items-center gap-2 bg-gradient-to-r from-copper to-copper-light text-white font-black text-sm px-6 py-3.5 rounded-2xl transition-all shadow-md shadow-copper/10 hover:shadow-lg hover:shadow-copper/20 hover:-translate-y-0.5">
                                            <?php echo kermancopper_icon( 'newspaper', 'w-4 h-4' ); ?>
                                            مشاهده آگهی‌ها و ثبت درخواست
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                        <?php elseif ( $active_tab === 'profile' ) : ?>
                            <!-- Profile Tab -->
                            <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-8">
                                <div class="w-10 h-10 rounded-xl bg-copper/5 text-copper flex items-center justify-center">
                                    <?php echo kermancopper_icon( 'user', 'w-5 h-5' ); ?>
                                </div>
                                <h2 class="text-xl font-black text-navy">ویرایش مشخصات عمومی شرکت</h2>
                            </div>

                            <?php if ( ! empty( $profile_message ) ) : ?>
                                <div class="mb-6 text-sm px-5 py-4 rounded-2xl border bg-emerald-50 border-emerald-200 text-emerald-600 flex items-center gap-3 font-semibold">
                                    <?php echo kermancopper_icon( 'check-circle', 'w-5 h-5 flex-shrink-0' ); ?>
                                    <span><?php echo esc_html( $profile_message ); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $profile_error ) ) : ?>
                                <div class="mb-6 text-sm px-5 py-4 rounded-2xl border bg-rose-50 border-rose-200 text-rose-600 flex items-center gap-3 font-semibold">
                                    <?php echo kermancopper_icon( 'alert-triangle', 'w-5 h-5 flex-shrink-0' ); ?>
                                    <span><?php echo esc_html( $profile_error ); ?></span>
                                </div>
                            <?php endif; ?>

                            <form method="post" action="" class="space-y-6">
                                <?php wp_nonce_field( 'dashboard_profile_action', 'dashboard_profile_nonce' ); ?>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="company" class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                            <?php echo kermancopper_icon( 'building-2', 'w-4 h-4 text-slate-400' ); ?>
                                            نام شرکت (فارسی) *
                                        </label>
                                        <input type="text" name="company" id="company" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required value="<?php echo esc_attr( $meta_company ); ?>" />
                                    </div>
                                    <div>
                                        <label for="ceo_name" class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                            <?php echo kermancopper_icon( 'user', 'w-4 h-4 text-slate-400' ); ?>
                                            نام و نام خانوادگی مدیرعامل *
                                        </label>
                                        <input type="text" name="ceo_name" id="ceo_name" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required value="<?php echo esc_attr( $meta_ceo_name ); ?>" />
                                    </div>
                                    <div>
                                        <label for="mobile" class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                            <?php echo kermancopper_icon( 'smartphone', 'w-4 h-4 text-slate-400' ); ?>
                                            تلفن همراه (موبایل) *
                                        </label>
                                        <input type="text" name="mobile" id="mobile" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required value="<?php echo esc_attr( $meta_mobile ); ?>" />
                                    </div>
                                    <div>
                                        <label for="email" class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                            <?php echo kermancopper_icon( 'mail', 'w-4 h-4 text-slate-400' ); ?>
                                            پست الکترونیک (ایمیل) *
                                        </label>
                                        <input type="email" name="email" id="email" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required value="<?php echo esc_attr( $user_obj->user_email ); ?>" />
                                    </div>
                                    <div>
                                        <label for="phone" class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                            <?php echo kermancopper_icon( 'phone', 'w-4 h-4 text-slate-400' ); ?>
                                            تلفن ثابت *
                                        </label>
                                        <input type="text" name="phone" id="phone" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required value="<?php echo esc_attr( $meta_phone ); ?>" />
                                    </div>
                                    <div>
                                        <label for="website" class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                            <?php echo kermancopper_icon( 'link', 'w-4 h-4 text-slate-400' ); ?>
                                            آدرس وب‌سایت *
                                        </label>
                                        <input type="text" name="website" id="website" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required value="<?php echo esc_attr( $meta_website ); ?>" />
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="address" class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                            <?php echo kermancopper_icon( 'map-pin', 'w-4 h-4 text-slate-400' ); ?>
                                            نشانی دقیق پستی *
                                        </label>
                                        <textarea id="address" name="address" rows="3" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all resize-none font-semibold" required><?php echo esc_html( $meta_address ); ?></textarea>
                                    </div>
                                </div>
                                <div class="flex justify-end pt-4 border-t border-slate-100">
                                    <button type="submit" name="dashboard_profile_submit" class="bg-copper hover:bg-copper-dark text-white font-black text-base px-8 py-3.5 rounded-2xl transition-all shadow-md shadow-copper/10 hover:shadow-lg hover:shadow-copper/20 hover:-translate-y-0.5">
                                        ذخیره تغییرات مشخصات
                                    </button>
                                </div>
                            </form>

                        <?php elseif ( $active_tab === 'password' ) : ?>
                            <!-- Password Change Tab -->
                            <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-8">
                                <div class="w-10 h-10 rounded-xl bg-copper/5 text-copper flex items-center justify-center">
                                    <?php echo kermancopper_icon( 'shield-check', 'w-5 h-5' ); ?>
                                </div>
                                <h2 class="text-xl font-black text-navy">تغییر کلمه عبور حساب کاربری</h2>
                            </div>

                            <?php if ( ! empty( $password_message ) ) : ?>
                                <div class="mb-6 text-sm px-5 py-4 rounded-2xl border bg-emerald-50 border-emerald-200 text-emerald-600 flex items-center gap-3 font-semibold">
                                    <?php echo kermancopper_icon( 'check-circle', 'w-5 h-5 flex-shrink-0' ); ?>
                                    <span><?php echo esc_html( $password_message ); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $password_error ) ) : ?>
                                <div class="mb-6 text-sm px-5 py-4 rounded-2xl border bg-rose-50 border-rose-200 text-rose-600 flex items-center gap-3 font-semibold">
                                    <?php echo kermancopper_icon( 'alert-triangle', 'w-5 h-5 flex-shrink-0' ); ?>
                                    <span><?php echo esc_html( $password_error ); ?></span>
                                </div>
                            <?php endif; ?>

                            <form method="post" action="" class="space-y-6 max-w-md">
                                <?php wp_nonce_field( 'dashboard_password_action', 'dashboard_password_nonce' ); ?>
                                <div>
                                    <label for="old_pwd" class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                        <?php echo kermancopper_icon( 'lock', 'w-4 h-4 text-slate-400' ); ?>
                                        کلمه عبور فعلی *
                                    </label>
                                    <input type="password" name="old_pwd" id="old_pwd" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required />
                                </div>
                                <div>
                                    <label for="new_pwd" class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                        <?php echo kermancopper_icon( 'lock', 'w-4 h-4 text-slate-400' ); ?>
                                        کلمه عبور جدید *
                                    </label>
                                    <input type="password" name="new_pwd" id="new_pwd" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required />
                                    
                                    <!-- Password Strength Indicator -->
                                    <div id="password-strength-container" class="mt-3 hidden space-y-1.5">
                                        <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                            <div class="strength-bar h-full w-0 transition-all duration-300"></div>
                                        </div>
                                        <span class="strength-text text-xs font-semibold"></span>
                                    </div>
                                </div>
                                <div>
                                    <label for="new_pwd_confirm" class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                        <?php echo kermancopper_icon( 'lock', 'w-4 h-4 text-slate-400' ); ?>
                                        تکرار کلمه عبور جدید *
                                    </label>
                                    <input type="password" name="new_pwd_confirm" id="new_pwd_confirm" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required />
                                </div>
                                <div class="flex justify-end pt-4 border-t border-slate-100">
                                    <button type="submit" name="dashboard_password_submit" class="bg-copper hover:bg-copper-dark text-white font-black text-base px-8 py-3.5 rounded-2xl transition-all shadow-md shadow-copper/10 hover:shadow-lg hover:shadow-copper/20 hover:-translate-y-0.5">
                                        تغییر کلمه عبور
                                    </button>
                                </div>
                            </form>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Jalali Datepicker
    if (window.jalaliDatepicker) {
        window.jalaliDatepicker.startWatch({
            minDate: "attr",
            maxDate: "attr"
        });
    }

    // Province/City select dynamic options
    var provinceSelect = document.getElementById('province');
    var citySelect = document.getElementById('city');
    if (provinceSelect && citySelect) {
        provinceSelect.addEventListener('change', function() {
            var province = this.value;
            citySelect.innerHTML = '<option value="">درحال بارگذاری...</option>';
            if (!province) {
                citySelect.innerHTML = '<option value="">ابتدا استان را انتخاب کنید</option>';
                return;
            }
            var ajaxUrl = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
            fetch(ajaxUrl + '?action=kermancopper_get_cities&province=' + encodeURIComponent(province))
                .then(function(r) { return r.json(); })
                .then(function(result) {
                    if (result.success && result.data.cities) {
                        var html = '<option value="">انتخاب شهر</option>';
                        result.data.cities.forEach(function(city) {
                            html += '<option value="' + city + '">' + city + '</option>';
                        });
                        citySelect.innerHTML = html;
                    } else {
                        citySelect.innerHTML = '<option value="">خطا در دریافت لیست شهرها</option>';
                    }
                });
        });
    }

    // Password Strength Meter
    var newPwdInput = document.getElementById('new_pwd');
    var pwdStrengthContainer = document.getElementById('password-strength-container');
    if (newPwdInput && pwdStrengthContainer) {
        newPwdInput.addEventListener('input', function() {
            var val = this.value;
            if (!val) {
                pwdStrengthContainer.classList.add('hidden');
                return;
            }
            pwdStrengthContainer.classList.remove('hidden');
            var score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[a-z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;
            
            var bar = pwdStrengthContainer.querySelector('.strength-bar');
            var text = pwdStrengthContainer.querySelector('.strength-text');
            
            if (score <= 2) {
                bar.style.width = '33%';
                bar.className = 'strength-bar h-full rounded-full transition-all duration-300 bg-rose-500';
                text.textContent = 'کلمه عبور ضعیف است';
                text.className = 'strength-text text-xs text-rose-500 font-semibold';
            } else if (score <= 4) {
                bar.style.width = '66%';
                bar.className = 'strength-bar h-full rounded-full transition-all duration-300 bg-amber-500';
                text.textContent = 'کلمه عبور متوسط است';
                text.className = 'strength-text text-xs text-amber-500 font-semibold';
            } else {
                bar.style.width = '100%';
                bar.className = 'strength-bar h-full rounded-full transition-all duration-300 bg-emerald-500';
                text.textContent = 'کلمه عبور قوی است';
                text.className = 'strength-text text-xs text-emerald-500 font-semibold';
            }
        });
    }
});
</script>

<style>
/* Custom scoped styles for premium panel visual elements */
input[type="checkbox"] {
    accent-color: #c8682f;
}

/* Custom premium select styling for RTL arrow placement */
#content select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23475569' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") !important;
    background-position: left 1.25rem center !important;
    background-repeat: no-repeat !important;
    background-size: 1.25rem !important;
    padding-left: 3rem !important;
}

/* Custom scrollbar hiding for horizontal scroll menus on mobile */
.no-scrollbar::-webkit-scrollbar {
    display: none !important;
}
.no-scrollbar {
    -ms-overflow-style: none !important;
    scrollbar-width: none !important;
}



/* Sidebar grid layout fallback - Fix column wrapping in 2-column layout */
@media (min-width: 1024px) {
    .dashboard-grid {
        display: grid !important;
        grid-template-columns: 280px 1fr !important; /* Sidebar 280px on right, content 1fr on left in RTL */
        gap: 2rem !important;
        align-items: start !important;
    }
    .dashboard-sidebar {
        grid-column: 1 / span 1 !important;
    }
    .dashboard-content {
        grid-column: 2 / span 1 !important;
    }
}

/* Restore premium rounded corners overridden by header.php */
#content .rounded-\[2\.5rem\] { border-radius: 2.5rem !important; }
#content .rounded-\[2rem\] { border-radius: 2rem !important; }
#content .rounded-2xl { border-radius: 1rem !important; }
#content .rounded-xl { border-radius: 0.75rem !important; }
#content .rounded-lg { border-radius: 0.5rem !important; }
#content .rounded-full { border-radius: 9999px !important; }

/* Custom premium input/select/textarea designs */
#content input[type="text"],
#content input[type="password"],
#content input[type="email"],
#content select,
#content textarea {
    border: 1.8px solid #cbd5e1 !important;
    background-color: #f8fafc !important; 
    color: #0f172a !important; 
    border-radius: 1rem !important;
    font-weight: 600 !important;
    transition: all 0.25s ease !important;
}
#content input[type="text"]:focus,
#content input[type="password"]:focus,
#content input[type="email"]:focus,
#content select:focus,
#content textarea:focus {
    border-color: #c8682f !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 4px rgba(200, 104, 47, 0.15) !important;
}

/* Styling for disabled/readonly inputs */
#content input:disabled,
#content select:disabled,
#content textarea:disabled {
    background-color: #f1f5f9 !important;
    color: #64748b !important;
    border-color: #e2e8f0 !important;
    cursor: not-allowed !important;
    opacity: 0.8 !important;
}

/* Unified luxury label styling */
#content label {
    color: #334155 !important;
    font-weight: 700 !important;
    font-size: 0.875rem !important;
    display: inline-flex;
    align-items: center;
    margin-bottom: 0.5rem;
}

.animate-fade-in {
    animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.98) translateY(8px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}
</style>

<?php get_footer(); ?>
