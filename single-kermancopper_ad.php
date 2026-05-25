<?php
/**
 * The template for displaying all single ads/tenders
 *
 * @package KermanCopper
 */

get_header(); ?>

<main class="relative z-20 bg-[#FAFAFA] pb-24">
    <?php while ( have_posts() ) : ?>
        <?php
        the_post();
        $ad_id = get_the_ID();
        $ad_terms = get_the_terms( $ad_id, 'kermancopper_ad_type' );
        $ad_term = ! empty( $ad_terms ) && ! is_wp_error( $ad_terms ) ? $ad_terms[0] : null;
        $ad_type_label = $ad_term ? $ad_term->name : __( 'سایر', 'kermancopper' );
        $ad_type_link = $ad_term ? get_term_link( $ad_term ) : '';
        $ad_type_icon = 'file-text';
        if ( $ad_term ) {
            if ( strpos( $ad_term->slug, 'auction' ) !== false || strpos( $ad_term->name, 'مزایده' ) !== false ) {
                $ad_type_icon = 'gavel';
            } elseif ( strpos( $ad_term->slug, 'tender' ) !== false || strpos( $ad_term->name, 'مناقصه' ) !== false ) {
                $ad_type_icon = 'file-text';
            }
        }
        $expiry_date = get_post_meta( $ad_id, KERMANCOPPER_AD_META_EXPIRY_DATE, true );
        $expiry_display = function_exists( 'kermancopper_ads_format_expiry_date_for_display' )
            ? kermancopper_ads_format_expiry_date_for_display( $expiry_date )
            : '';
        if ( $expiry_display === '' ) {
            $expiry_display = '—';
        }
        $today = current_time( 'Y-m-d' );
        $is_expired = $expiry_date && $expiry_date < $today;
        $status = $is_expired ? 'closed' : 'active';
        $can_submit = ! $is_expired;
        $status_label = $status === 'closed' ? __( 'بسته شده', 'kermancopper' ) : __( 'فعال و معتبر', 'kermancopper' );
        $thumbnail = get_the_post_thumbnail_url( $ad_id, 'full' );
        if ( ! $thumbnail ) {
            $thumbnail = get_template_directory_uri() . '/images/image2.jpg';
        }
        $otp_token = isset( $_GET['ad_request_token'] ) ? sanitize_text_field( wp_unslash( $_GET['ad_request_token'] ) ) : '';
        $otp_payload = $otp_token ? get_transient( 'kermancopper_ad_otp_' . $otp_token ) : false;
        $show_otp_form = is_array( $otp_payload ) && isset( $otp_payload['ad_id'] ) && (int) $otp_payload['ad_id'] === $ad_id;
        $otp_step = $can_submit && $show_otp_form;
        $request_detail = isset( $_GET['ad_request_detail'] ) ? sanitize_text_field( wp_unslash( $_GET['ad_request_detail'] ) ) : '';
        $otp_verified = $show_otp_form && ! empty( $otp_payload['verified'] );
        $request_message_code = isset( $_GET['ad_request'] ) ? sanitize_text_field( wp_unslash( $_GET['ad_request'] ) ) : '';
        $request_message = '';
        $request_message_class = 'bg-rose-50 border-rose-200 text-rose-600';
        if ( $request_message_code === 'success' ) {
            $request_message = 'درخواست شما با موفقیت ثبت شد.';
            $request_message_class = 'bg-emerald-50 border-emerald-200 text-emerald-600';
        } elseif ( $request_message_code === 'otp_sent' ) {
            $request_message = 'کد تایید ارسال شد. لطفا کد را وارد کنید.';
            $request_message_class = 'bg-emerald-50 border-emerald-200 text-emerald-600';
        } elseif ( $request_message_code === 'missing' ) {
            $request_message = 'لطفا همه فیلدهای ضروری را تکمیل کنید.';
        } elseif ( $request_message_code === 'invalid_email' ) {
            $request_message = 'ایمیل وارد شده معتبر نیست.';
        } elseif ( $request_message_code === 'invalid_mobile' ) {
            $request_message = 'شماره موبایل وارد شده معتبر نیست.';
        } elseif ( $request_message_code === 'otp_invalid' ) {
            $request_message = 'کد وارد شده صحیح نیست.';
        } elseif ( $request_message_code === 'otp_expired' ) {
            $request_message = 'کد منقضی شده است. دوباره درخواست کنید.';
        } elseif ( $request_message_code === 'otp_missing' ) {
            $request_message = 'کد تایید یافت نشد. دوباره تلاش کنید.';
        } elseif ( $request_message_code === 'otp_send_failed' ) {
            $request_message = 'ارسال کد تایید با خطا روبه‌رو شد.';
        } elseif ( $request_message_code === 'expired' ) {
            $request_message = 'مهلت ثبت درخواست به پایان رسیده است.';
        } elseif ( $request_message_code === 'invalid_ad' ) {
            $request_message = 'آگهی معتبر نیست.';
        } elseif ( $request_message_code === 'invalid_nonce' ) {
            $request_message = 'اعتبار فرم منقضی شده است. دوباره تلاش کنید.';
        } elseif ( $request_message_code === 'submit_error' ) {
            $request_message = 'ثبت درخواست با خطا روبه‌رو شد.';
            if ( $request_detail !== '' ) {
                $request_message .= ' جزئیات: ' . $request_detail;
            }
        }
        ?>

        <!-- AD HERO SECTION -->
        <header class="relative min-h-[520px] flex items-end justify-center overflow-hidden bg-navy-dark pt-32 lg:pt-40 pb-24 ad-hero-header">
            <!-- Background Image -->
            <div class="absolute inset-0 w-full h-full">
                <img src="<?php echo esc_url( $thumbnail ); ?>" class="hero-bg-image w-full h-full object-cover opacity-60 mix-blend-overlay" alt="<?php the_title_attribute(); ?>">
                <!-- Gradients for text readability -->
                <div class="absolute inset-0 bg-gradient-to-t from-navy-dark via-navy-dark/70 to-transparent z-10"></div>
                <!-- Accent glow -->
                <div class="absolute bottom-0 right-0 w-[50%] h-[50%] bg-copper/20 rounded-full blur-[100px] z-15 pointer-events-none"></div>
            </div>

            <div class="container mx-auto px-6 lg:px-12 relative z-20 font-peyda max-w-6xl pb-12">
                <!-- Breadcrumb & Badges -->
                <div class="flex flex-wrap items-center gap-4 mb-6 animate-fade-in-up delay-100">
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'kermancopper_ad' ) ); ?>" class="text-slate-300 hover:text-white transition-colors text-sm font-bold flex items-center gap-1">
                        <?php echo kermancopper_icon('layout-grid', 'w-4 h-4'); ?> همه آگهی‌ها
                    </a>
                    <span class="text-slate-500">/</span>
                    <?php if ( $ad_term ) : ?>
                        <a href="<?php echo esc_url( $ad_type_link ); ?>" class="px-3 py-1 rounded-lg glass-panel text-copper-light text-xs font-bold border-copper/20">
                            <?php echo esc_html( $ad_type_label ); ?>
                        </a>
                    <?php endif; ?>
                    <span class="px-3 py-1 rounded-lg text-xs font-bold flex items-center gap-1.5 border <?php echo $is_expired ? 'bg-rose-500/10 text-rose-400 border-rose-500/30 shadow-sm' : 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30 shadow-sm'; ?>">
                        <span class="w-1.5 h-1.5 rounded-full <?php echo $is_expired ? 'bg-rose-400' : 'bg-emerald-400'; ?> animate-pulse"></span>
                        <?php echo esc_html( $status_label ); ?>
                    </span>
                </div>

                <!-- Title -->
                <h1 class="text-2xl/[1.5] sm:text-3xl/[1.5] lg:text-4xl/[1.5] xl:text-5xl/[1.5] font-black text-white mb-8 animate-fade-in-up delay-200">
                    <?php the_title(); ?>
                </h1>

                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-6 text-slate-300 text-sm font-sans font-medium animate-fade-in-up delay-300 border-t border-white/10 pt-6">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-copper/20 flex items-center justify-center text-copper-light">
                            <?php echo kermancopper_icon($ad_type_icon, 'w-4 h-4'); ?>
                        </div>
                        <span><?php echo esc_html( $ad_type_label ); ?></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <?php echo kermancopper_icon('clock', 'w-4 h-4 text-slate-400'); ?>
                        <span>مهلت ثبت درخواست: <?php echo esc_html( $expiry_display ); ?></span>
                    </div>
                    <div class="flex items-center gap-2 mr-auto">
                        <button class="w-8 h-8 rounded-full bg-white/5 hover:bg-copper hover:text-white transition-colors flex items-center justify-center border border-white/10" aria-label="اشتراک‌گذاری" onclick="navigator.clipboard.writeText(window.location.href); alert('لینک صفحه کپی شد.');">
                            <?php echo kermancopper_icon('share-2', 'w-3.5 h-3.5'); ?>
                        </button>
                        <button class="w-8 h-8 rounded-full bg-white/5 hover:bg-copper hover:text-white transition-colors flex items-center justify-center border border-white/10" aria-label="چاپ" onclick="window.print();">
                            <?php echo kermancopper_icon('printer', 'w-3.5 h-3.5'); ?>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bottom Curve (Union image) -->
            <div class="hero-curve">
                <img src="<?php echo get_template_directory_uri(); ?>/images/Union.png" srcset="<?php echo get_template_directory_uri(); ?>/images/Union.png 1440w, <?php echo get_template_directory_uri(); ?>/images/Union-300x37.png 300w, <?php echo get_template_directory_uri(); ?>/images/Union-1024x127.png 1024w, <?php echo get_template_directory_uri(); ?>/images/Union-768x95.png 768w" sizes="(max-width: 1440px) 100vw, 1440px" class="hero-curve-image" alt="" />
                <a href="#content-section" class="hero-curve-arrow" aria-label="بخش بعدی">
                    <?php echo kermancopper_icon('chevrons-down', 'hero-curve-arrow-icon'); ?>
                </a>
            </div>
        </header>

        <div id="content-section" class="container mx-auto px-6 lg:px-12 pt-20 max-w-6xl relative z-20">
            <!-- Excerpt -->
            <?php if ( has_excerpt() ) : ?>
                <div class="mb-10 text-lg text-slate-600 leading-relaxed bg-white border border-slate-200/80 rounded-[2rem] shadow-[0_8px_30px_rgba(0,0,0,0.02)] p-8 font-semibold scroll-reveal">
                    <?php echo esc_html( get_the_excerpt() ); ?>
                </div>
            <?php endif; ?>

            <!-- Post Content -->
            <div class="prose prose-lg max-w-none text-slate-700 leading-loose bg-white border border-slate-200/80 rounded-[2rem] shadow-[0_8px_30px_rgba(0,0,0,0.02)] p-8 sm:p-10 mb-12 post-content scroll-reveal">
                <?php the_content(); ?>
            </div>

            <!-- Registration Form Section -->
            <?php if ( $can_submit ) : ?>
                <div class="mt-16 rounded-[2.5rem] border border-slate-200/80 bg-white p-8 sm:p-12 shadow-[0_15px_50px_rgba(0,0,0,0.04)] scroll-reveal">
                    <div class="text-center max-w-xl mx-auto mb-12">
                        <span class="text-copper font-black text-sm tracking-wider uppercase block mb-3 font-peyda">بخش ثبت نام الکترونیکی</span>
                        <h2 class="text-3xl font-black text-navy font-peyda">فرم ثبت درخواست شرکت در فرآیند</h2>
                        <div class="w-16 h-1 bg-copper mx-auto mt-4 rounded-full"></div>
                    </div>

                    <!-- Ajax Messages -->
                    <div id="ad-request-message" class="mb-8 text-sm px-5 py-4 rounded-2xl border <?php echo esc_attr( $request_message_class ); ?><?php echo $request_message !== '' ? '' : ' hidden'; ?> flex items-center gap-3 font-semibold">
                        <?php echo kermancopper_icon('check-circle', 'w-5 h-5 flex-shrink-0'); ?>
                        <span><?php echo esc_html( $request_message ); ?></span>
                    </div>

                    <?php
                    $info_disabled = $otp_step ? 'disabled' : '';
                    $info_required = $otp_step ? '' : 'required';
                    $otp_disabled = $otp_step ? '' : 'disabled';
                    $provinces_cities = kermancopper_get_provinces_cities();
                    ?>
                    
                    <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" class="space-y-10" id="ad-request-form" data-ajax-url="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" data-step="<?php echo $otp_step ? 'otp' : 'info'; ?>">
                        <?php wp_nonce_field( 'kermancopper_ad_request_submit', 'kermancopper_ad_request_nonce' ); ?>
                        <?php wp_nonce_field( 'kermancopper_ad_request_verify', 'kermancopper_ad_request_verify_nonce' ); ?>
                        <input type="hidden" name="action" value="<?php echo $otp_step ? 'kermancopper_ad_request_verify' : 'kermancopper_ad_request_otp'; ?>" />
                        <input type="hidden" name="ad_request_token" value="<?php echo esc_attr( $otp_token ); ?>" />
                        <input type="hidden" name="ad_id" value="<?php echo esc_attr( $ad_id ); ?>" />
                        
                        <!-- OTP Step -->
                        <div data-step-section="otp" class="<?php echo $otp_step ? '' : 'hidden'; ?>">
                            <div class="bg-slate-50 border border-slate-200/60 p-6 rounded-2xl mb-8 font-peyda">
                                <p class="text-base text-slate-700 mb-4 font-black">اطلاعات شما با موفقیت دریافت شد. لطفا کد تایید پیامک‌شده را وارد کنید.</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-slate-600 font-semibold">
                                    <div>نام شرکت: <span data-summary="company" class="font-black text-navy"><?php echo esc_html( $otp_payload['company'] ?? '' ); ?></span></div>
                                    <div>شماره موبایل: <span data-summary="mobile" class="font-black text-navy" dir="ltr"><?php echo esc_html( $otp_payload['mobile'] ?? '' ); ?></span></div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-800 mb-3" for="otp_code">کد تایید پیامکی *</label>
                                <input type="text" id="otp_code" name="otp_code" class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required <?php echo esc_attr( $otp_disabled ); ?> value="12345" />
                                <div class="mt-4 p-4 rounded-2xl bg-amber-50/50 border border-amber-200 text-amber-700 text-xs font-semibold flex items-center gap-2">
                                    <?php echo kermancopper_icon('alert-triangle', 'w-4 h-4 flex-shrink-0'); ?>
                                    <span>کد تایید صوری جهت تست سیستم: <strong>12345</strong></span>
                                </div>
                            </div>
                        </div>

                        <!-- Data Fields Step -->
                        <div data-step-section="info" class="<?php echo $otp_step ? 'hidden' : ''; ?> space-y-10">
                            
                            <!-- Section 1: Basic Info -->
                            <div class="form-section space-y-6">
                                <h3 class="text-lg font-black text-navy font-peyda mb-6 pb-2 border-b border-slate-100 flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-copper"></span> اطلاعات پایه شرکت
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="company_type">نوع شرکت *</label>
                                        <select id="company_type" name="company_type" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold appearance-none cursor-pointer" <?php echo esc_attr( $info_required ); ?>>
                                            <option value="">انتخاب کنید</option>
                                            <option>شرکت سهامی خاص</option>
                                            <option>شرکت سهامی عام</option>
                                            <option>شرکت بامسئولیت محدود</option>
                                            <option>شرکت تعاونی</option>
                                            <option>شخص حقیقی</option>
                                            <option>موسسه</option>
                                            <option>دفاتر بیمه</option>
                                            <option>تجاری یا فروشگاه</option>
                                            <option>موسسات حقوقی یا وکلا</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="activity_type">نوع فعالیت *</label>
                                        <select id="activity_type" name="activity_type" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold appearance-none cursor-pointer" <?php echo esc_attr( $info_required ); ?>>
                                            <option value="">انتخاب کنید</option>
                                            <option>پیمانکار</option>
                                            <option>مشاوره</option>
                                            <option>خریدار، بهره بردار یا کارفرما</option>
                                            <option>فروشنده</option>
                                            <option>سازنده</option>
                                            <option>تولیدکننده</option>
                                            <option>مشاوره حقوقی</option>
                                            <option>مزایده گر</option>
                                            <option>بیمارستان، داروخانه و آزمایشگاه</option>
                                            <option>کارگزاری بیمه</option>
                                            <option>دانشگاه یا مرکز آموزشی</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="request_company">نام شرکت (فارسی) *</label>
                                        <input type="text" id="request_company" name="request_company" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="company_name_en">نام شرکت (انگلیسی)</label>
                                        <input type="text" id="company_name_en" name="company_name_en" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="national_id">شناسه ملی / کد ملی *</label>
                                        <input type="text" id="national_id" name="national_id" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="establishment_date">تاریخ تاسیس *</label>
                                        <input type="text" id="establishment_date" name="establishment_date" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold kermancopper-ad-datepicker" data-jdp <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="economic_number">شماره اقتصادی یا جواز *</label>
                                        <input type="text" id="economic_number" name="economic_number" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="registration_number">شماره ثبت *</label>
                                        <input type="text" id="registration_number" name="registration_number" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="registration_location">محل ثبت *</label>
                                        <input type="text" id="registration_location" name="registration_location" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="insurance_branch">شعبه بیمه</label>
                                        <input type="text" id="insurance_branch" name="insurance_branch" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" />
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: CEO Info -->
                            <div class="form-section space-y-6">
                                <h3 class="text-lg font-black text-navy font-peyda mb-6 pb-2 border-b border-slate-100 flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-copper"></span> مشخصات مدیرعامل
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="ceo_name">نام و نام خانوادگی مدیرعامل *</label>
                                        <input type="text" id="ceo_name" name="ceo_name" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="ceo_national_id">کد ملی مدیر عامل *</label>
                                        <input type="text" id="ceo_national_id" name="ceo_national_id" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="ceo_mobile">موبایل مدیرعامل *</label>
                                        <input type="text" id="ceo_mobile" name="ceo_mobile" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                </div>
                            </div>

                            <!-- Section 3: Contact Info -->
                            <div class="form-section space-y-6">
                                <h3 class="text-lg font-black text-navy font-peyda mb-6 pb-2 border-b border-slate-100 flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-copper"></span> اطلاعات تماس و نشانی
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="fax">نمابر (فکس) *</label>
                                        <input type="text" id="fax" name="fax" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="phone">تلفن ثابت *</label>
                                        <input type="text" id="phone" name="phone" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="request_mobile">تلفن همراه (موبایل) *</label>
                                        <input type="text" id="request_mobile" name="request_mobile" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="website">آدرس وب سایت *</label>
                                        <input type="text" id="website" name="website" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="request_email">پست الکترونیک (ایمیل) *</label>
                                        <input type="email" id="request_email" name="request_email" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="postal_code">کد پستی *</label>
                                        <input type="text" id="postal_code" name="postal_code" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="province">استان *</label>
                                        <select id="province" name="province" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold appearance-none cursor-pointer" <?php echo esc_attr( $info_required ); ?>>
                                            <option value="">انتخاب کنید</option>
                                            <?php foreach ( array_keys( $provinces_cities ) as $p ) : ?>
                                                <option value="<?php echo esc_attr( $p ); ?>"><?php echo esc_html( $p ); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="city">شهر *</label>
                                        <select id="city" name="city" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold appearance-none cursor-pointer" <?php echo esc_attr( $info_required ); ?>>
                                            <option value="">ابتدا استان را انتخاب کنید</option>
                                        </select>
                                    </div>
                                    <div class="md:col-span-3">
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="address">نشانی دقیق پستی *</label>
                                        <textarea id="address" name="address" rows="3" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all resize-none font-semibold" <?php echo esc_attr( $info_required ); ?>></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 4: Bank Account -->
                            <div class="form-section space-y-6">
                                <h3 class="text-lg font-black text-navy font-peyda mb-6 pb-2 border-b border-slate-100 flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-copper"></span> اطلاعات حساب بانکی
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="bank_sheba">شماره شبا (IBAN) *</label>
                                        <input type="text" id="bank_sheba" name="bank_sheba" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" placeholder="IR000000000000000000000000" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="bank_account">شماره حساب بانکی *</label>
                                        <input type="text" id="bank_account" name="bank_account" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" placeholder="1234567890" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="bank_branch">نام و کد شعبه *</label>
                                        <input type="text" id="bank_branch" name="bank_branch" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                </div>
                            </div>

                            <!-- Section 5: Credentials & Reasoning -->
                            <div class="form-section space-y-6">
                                <h3 class="text-lg font-black text-navy font-peyda mb-6 pb-2 border-b border-slate-100 flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-copper"></span> تنظیمات حساب کاربری
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="password">کلمه عبور حساب کاربری *</label>
                                        <input type="password" id="password" name="password" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="password_confirm">تکرار کلمه عبور *</label>
                                        <input type="password" id="password_confirm" name="password_confirm" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-bold text-slate-700 mb-2" for="registration_reason">دلایل ثبت نام و سوابق کلی *</label>
                                        <textarea id="registration_reason" name="registration_reason" rows="3" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all resize-none font-semibold" <?php echo esc_attr( $info_required ); ?>></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-copper-dark via-copper to-copper-light text-white font-black text-lg py-5 rounded-2xl transition-all shadow-[0_10px_30px_rgba(200,104,47,0.3)] hover:shadow-[0_15px_40px_rgba(200,104,47,0.5)] hover:-translate-y-1 mt-4 group relative overflow-hidden" id="ad-request-submit">
                            <span class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out"></span>
                            <span class="relative flex items-center justify-center gap-2">
                                <?php echo $otp_step ? 'تایید نهایی و ثبت‌نام' : 'ثبت نام در فرآیند'; ?>
                            </span>
                        </button>
                    </form>
                </div>
            <?php else : ?>
                <div class="mt-16 rounded-[2.5rem] border border-slate-200/80 bg-white p-8 sm:p-12 shadow-[0_15px_50px_rgba(0,0,0,0.04)] scroll-reveal">
                    <div class="text-base px-5 py-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-600 font-semibold flex items-center gap-3">
                        <?php echo kermancopper_icon('alert-triangle', 'w-5 h-5 flex-shrink-0'); ?>
                        <span>مهلت ثبت درخواست برای این آگهی به پایان رسیده است.</span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</main>

<style>
/* Custom high-contrast accessible inputs styling */
#ad-request-form input, 
#ad-request-form select, 
#ad-request-form textarea {
    border: 1.5px solid #a1a1aa !important; /* solid border-slate-400 equivalent for high contrast */
    background-color: #f8fafc !important; /* light slate background */
    color: #0f172a !important; /* dark text */
    border-radius: 1rem !important;
    transition: all 0.3s ease !important;
}
#ad-request-form input:focus, 
#ad-request-form select:focus, 
#ad-request-form textarea:focus {
    border-color: #c8682f !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(200, 104, 47, 0.25) !important;
}

.ad-hero-header {
    min-height: 520px;
    display: flex;
    align-items: flex-end;
    padding-top: 10rem;
    padding-bottom: 5rem;
}
@media (min-width: 1024px) {
    .ad-hero-header {
        min-height: 600px;
        padding-top: 12rem;
        padding-bottom: 6rem;
    }
}

.form-section {
    background: #ffffff;
    padding: 2.5rem;
    border: 1px solid rgba(226, 232, 240, 0.8);
    border-radius: 2rem;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.02);
}
</style>

<script>
(function () {
    var init = function () {
        // Initialize Jalali Datepicker
        if (window.jalaliDatepicker) {
            window.jalaliDatepicker.startWatch({
                minDate: "attr",
                maxDate: "attr"
            });
        }

        var form = document.getElementById('ad-request-form');
        if (!form || !window.fetch) {
            return;
        }
        var messageBox = document.getElementById('ad-request-message');
        var submitButton = document.getElementById('ad-request-submit');
        var actionInput = form.querySelector('input[name="action"]');
        var tokenInput = form.querySelector('input[name="ad_request_token"]');
        var otpSection = form.querySelector('[data-step-section="otp"]');
        var infoSection = form.querySelector('[data-step-section="info"]');
        var provinceSelect = document.getElementById('province');
        var citySelect = document.getElementById('city');

        // Province/City AJAX
        if (provinceSelect && citySelect) {
            provinceSelect.addEventListener('change', function() {
                var province = this.value;
                citySelect.innerHTML = '<option value="">درحال بارگذاری...</option>';
                if (!province) {
                    citySelect.innerHTML = '<option value="">ابتدا استان را انتخاب کنید</option>';
                    return;
                }
                var ajaxUrl = form.getAttribute('data-ajax-url');
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

        var setMessage = function (text, isSuccess) {
            if (!messageBox) {
                return;
            }
            messageBox.textContent = text;
            messageBox.className = 'mb-8 text-sm px-5 py-4 rounded-2xl border flex items-center gap-3 font-semibold ' + (isSuccess ? 'bg-emerald-50 border-emerald-200 text-emerald-600' : 'bg-rose-50 border-rose-200 text-rose-600');
            messageBox.classList.remove('hidden');
            messageBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
        };

        var toggleSection = function (section, isActive) {
            if (!section) {
                return;
            }
            if (isActive) {
                section.classList.remove('hidden');
            } else {
                section.classList.add('hidden');
            }
        };

        form.addEventListener('submit', function(e) {
            var step = form.getAttribute('data-step');
            if (step === 'otp') {
                form.setAttribute('action', '<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>');
                return true;
            }
            e.preventDefault();
            
            // Client-side validation
            var requiredFields = infoSection.querySelectorAll('[required]');
            var firstError = null;
            requiredFields.forEach(function(input) {
                if (!input.value.trim()) {
                    input.classList.add('border-red-500');
                    if (!firstError) firstError = input;
                } else {
                    input.classList.remove('border-red-500');
                }
            });

            if (firstError) {
                setMessage('لطفا همه فیلدهای ضروری را تکمیل کنید.', false);
                firstError.focus();
                return;
            }

            // Validate email
            var emailField = document.getElementById('request_email');
            if (emailField && emailField.value) {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailField.value)) {
                    emailField.classList.add('border-red-500');
                    setMessage('ایمیل وارد شده معتبر نیست.', false);
                    emailField.focus();
                    return;
                } else {
                    emailField.classList.remove('border-red-500');
                }
            }

            // Validate password match
            var passwordField = document.getElementById('password');
            var passwordConfirmField = document.getElementById('password_confirm');
            if (passwordField && passwordConfirmField) {
                if (passwordField.value.length < 8) {
                    passwordField.classList.add('border-red-500');
                    setMessage('کلمه عبور باید حداقل ۸ کاراکتر باشد.', false);
                    passwordField.focus();
                    return;
                } else if (passwordField.value !== passwordConfirmField.value) {
                    passwordField.classList.add('border-red-500');
                    passwordConfirmField.classList.add('border-red-500');
                    setMessage('کلمه عبور و تکرار آن مطابقت ندارند.', false);
                    passwordConfirmField.focus();
                    return;
                } else {
                    passwordField.classList.remove('border-red-500');
                    passwordConfirmField.classList.remove('border-red-500');
                }
            }

            var formData = new FormData(form);
            submitButton.disabled = true;
            submitButton.textContent = 'در حال ارسال...';
            fetch(form.getAttribute('data-ajax-url'), {
                method: 'POST',
                body: formData
            })
            .then(function(r) { return r.json(); })
            .then(function(result) {
                submitButton.disabled = false;
                submitButton.textContent = 'ثبت نام در فرآیند';
                if (result.success) {
                    actionInput.value = 'kermancopper_ad_request_verify';
                    tokenInput.value = result.data.otp_token;
                    form.setAttribute('data-step', 'otp');
                    toggleSection(infoSection, false);
                    toggleSection(otpSection, true);
                    setMessage(result.data.message, true);
                } else {
                    setMessage(result.data.message || 'خطا در ارسال درخواست', false);
                }
            })
            .catch(function(err) {
                submitButton.disabled = false;
                submitButton.textContent = 'ثبت نام در فرآیند';
                setMessage('خطا در ارتباط با سرور. لطفا دوباره تلاش کنید.', false);
            });
        });
    };
    document.addEventListener('DOMContentLoaded', init);
})();
</script>

<?php
get_footer();
