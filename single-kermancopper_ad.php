<?php
get_header(); ?>

<main class="container mx-auto px-4  mt-[100px]">
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
        $status_label = $status === 'closed' ? __( 'بسته', 'kermancopper' ) : __( 'فعال', 'kermancopper' );
        $status_class = $status === 'closed'
            ? 'bg-slate-100 text-slate-800 border border-slate-300'
            : 'bg-green-50 text-green-900 border border-green-300';
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
        $request_message_class = 'bg-red-50 text-red-900 border border-red-300';
        if ( $request_message_code === 'success' ) {
            $request_message = 'درخواست شما با موفقیت ثبت شد.';
            $request_message_class = 'bg-green-50 text-green-900 border border-green-300';
        } elseif ( $request_message_code === 'otp_sent' ) {
            $request_message = 'کد تایید ارسال شد. لطفا کد را وارد کنید.';
            $request_message_class = 'bg-green-50 text-green-900 border border-green-300';
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

        <div class="max-w-6xl mx-auto">
            <div class="mb-10 text-center">
                
                <h1 class="text-3xl md:text-5xl font-medium text-slate-800 leading-tight"><?php echo esc_html( get_the_title() ); ?></h1>
            </div>

            <div class="relative mb-10">
                <div class="w-full rounded-2xl overflow-hidden">
                    <img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="w-full h-[420px] md:h-[520px] object-cover rounded-2xl" />
                </div>
                <div class="absolute inset-0 w-full rounded-2xl bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <span class="px-4 py-2 rounded-lg font-semibold text-sm <?php echo esc_attr( $status_class ); ?>"><?php echo esc_html( $status_label ); ?></span>
                        <div class="flex items-center gap-2 px-4 py-2 rounded-lg bg-white/95 backdrop-blur-sm text-slate-900 border border-slate-200">
                            <?php echo kermancopper_icon('clock', 'w-4 h-4 text-copper'); ?>
                            <span class="font-medium">مهلت ثبت درخواست: <?php echo esc_html( $expiry_display ); ?></span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 rounded-lg bg-white/95 backdrop-blur-sm text-slate-900 border border-slate-200">
                        <?php echo kermancopper_icon($ad_type_icon, 'w-4 h-4 text-copper'); ?>
                        <span class="font-medium"><?php echo esc_html( $ad_type_label ); ?></span>
                    </div>
                </div>
            </div>

            <?php if ( has_excerpt() ) : ?>
                <div class="mb-8 text-lg text-slate-700 leading-relaxed bg-white border border-slate-200 rounded-xl shadow-sm p-8">
                    <?php echo esc_html( get_the_excerpt() ); ?>
                </div>
            <?php endif; ?>

            <div class="prose prose-lg max-w-none text-slate-700 leading-loose bg-white border border-slate-200 rounded-xl shadow-sm p-8 mb-12">
                <?php the_content(); ?>
            </div>

            <?php if ( $can_submit ) : ?>
                <div class="mt-12 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm space-y-6">
                    <h2 class="text-2xl font-medium w-100 text-copper  text-center  mx-auto">فرم ثبت نام</h2>
                    <div id="ad-request-message" class="mb-4 text-sm px-4 py-3 rounded-lg <?php echo esc_attr( $request_message_class ); ?><?php echo $request_message !== '' ? '' : ' hidden'; ?>"><?php echo esc_html( $request_message ); ?></div>
                    <?php
                    $info_disabled = $otp_step ? 'disabled' : '';
                    $info_required = $otp_step ? '' : 'required';
                    $otp_disabled = $otp_step ? '' : 'disabled';
                    $provinces_cities = kermancopper_get_provinces_cities();
                    ?>
                    <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" class="space-y-6" id="ad-request-form" data-ajax-url="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" data-step="<?php echo $otp_step ? 'otp' : 'info'; ?>">
                        <?php wp_nonce_field( 'kermancopper_ad_request_submit', 'kermancopper_ad_request_nonce' ); ?>
                        <?php wp_nonce_field( 'kermancopper_ad_request_verify', 'kermancopper_ad_request_verify_nonce' ); ?>
                        <input type="hidden" name="action" value="<?php echo $otp_step ? 'kermancopper_ad_request_verify' : 'kermancopper_ad_request_otp'; ?>" />
                        <input type="hidden" name="ad_request_token" value="<?php echo esc_attr( $otp_token ); ?>" />
                        <input type="hidden" name="ad_id" value="<?php echo esc_attr( $ad_id ); ?>" />
                        
                        <div data-step-section="otp" class="<?php echo $otp_step ? '' : 'hidden'; ?>">
                            <div class="bg-slate-50 p-6 rounded-xl border border-slate-200 mb-4">
                                <p class="text-base text-slate-700 mb-4 font-medium">اطلاعات شما ثبت شد. لطفا کد تایید پیامک شده را وارد کنید.</p>
                                <div class="grid grid-cols-2 gap-4 text-sm text-slate-700">
                                    <div>نام شرکت: <span data-summary="company" class="font-medium"><?php echo esc_html( $otp_payload['company'] ?? '' ); ?></span></div>
                                    <div>موبایل: <span data-summary="mobile" class="font-medium"><?php echo esc_html( $otp_payload['mobile'] ?? '' ); ?></span></div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-base font-medium text-slate-700 mb-3" for="otp_code">کد تایید *</label>
                                <input type="text" id="otp_code" name="otp_code" class="w-full rounded-lg border border-slate-300 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" required <?php echo esc_attr( $otp_disabled ); ?> value="12345" />
                                <p class="mt-3 text-sm text-amber-700 bg-amber-50 px-4 py-2 rounded-lg border border-amber-200">کد تایید صوری (تست): 12345</p>
                            </div>
                        </div>

                        <div data-step-section="info" class="<?php echo $otp_step ? 'hidden' : ''; ?> space-y-8">
                            <!-- مشخصات شرکت -->
                            <div class="form-section">
                                <h3 class="text-base font-bold text-copper mb-6 border-r-4 border-copper pr-3">اطلاعات پایه</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="company_type">نوع شرکت *</label>
                                        <select id="company_type" name="company_type" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?>>
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
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="activity_type">نوع فعالیت *</label>
                                        <select id="activity_type" name="activity_type" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?>>
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
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="request_company">نام شرکت (فارسی) *</label>
                                        <input type="text" id="request_company" name="request_company" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="company_name_en">نام شرکت (انگلیسی)</label>
                                        <input type="text" id="company_name_en" name="company_name_en" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="national_id">شناسه ملی / کد ملی *</label>
                                        <input type="text" id="national_id" name="national_id" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="establishment_date">تاریخ تاسیس *</label>
                                        <input type="text" id="establishment_date" name="establishment_date" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper kermancopper-ad-datepicker" data-jdp <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="economic_number">شماره اقتصادی یا جواز *</label>
                                        <input type="text" id="economic_number" name="economic_number" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="registration_number">شماره ثبت *</label>
                                        <input type="text" id="registration_number" name="registration_number" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="registration_location">محل ثبت *</label>
                                        <input type="text" id="registration_location" name="registration_location" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="insurance_branch">شعبه بیمه</label>
                                        <input type="text" id="insurance_branch" name="insurance_branch" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" />
                                    </div>
                                </div>
                            </div>

                            <!-- مشخصات مدیرعامل -->
                            <div class="form-section">
                                <h3 class="text-base font-bold text-copper mb-6 border-r-4 border-copper pr-3">مشخصات مدیرعامل</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="ceo_name">نام و نام خانوادگی مدیرعامل *</label>
                                        <input type="text" id="ceo_name" name="ceo_name" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="ceo_national_id">کد ملی مدیر عامل *</label>
                                        <input type="text" id="ceo_national_id" name="ceo_national_id" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="ceo_mobile">موبایل مدیرعامل *</label>
                                        <input type="text" id="ceo_mobile" name="ceo_mobile" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                </div>
                            </div>

                            <!-- اطلاعات تماس -->
                            <div class="form-section">
                                <h3 class="text-base font-bold text-copper mb-6 border-r-4 border-copper pr-3">اطلاعات تماس</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="fax">نمابر (فکس) *</label>
                                        <input type="text" id="fax" name="fax" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="phone">تلفن ثابت *</label>
                                        <input type="text" id="phone" name="phone" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="request_mobile">تلفن همراه (موبایل) *</label>
                                        <input type="text" id="request_mobile" name="request_mobile" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="website">آدرس وب سایت *</label>
                                        <input type="text" id="website" name="website" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="request_email">پست الکترونیک (ایمیل) *</label>
                                        <input type="email" id="request_email" name="request_email" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="postal_code">کد پستی *</label>
                                        <input type="text" id="postal_code" name="postal_code" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="province">استان *</label>
                                        <select id="province" name="province" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?>>
                                            <option value="">انتخاب کنید</option>
                                            <?php foreach ( array_keys( $provinces_cities ) as $p ) : ?>
                                                <option value="<?php echo esc_attr( $p ); ?>"><?php echo esc_html( $p ); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="city">شهر *</label>
                                        <select id="city" name="city" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?>>
                                            <option value="">ابتدا استان را انتخاب کنید</option>
                                        </select>
                                    </div>
                                    <div class="md:col-span-3">
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="address">آدرس *</label>
                                        <textarea id="address" name="address" rows="3" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?>></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- اطلاعات حساب بانکی -->
                            <div class="form-section">
                                <h3 class="text-base font-bold text-copper mb-6 border-r-4 border-copper pr-3">اطلاعات حساب بانکی</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="bank_sheba">شماره شبا *</label>
                                        <input type="text" id="bank_sheba" name="bank_sheba" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" placeholder="IR000000000000000000000000" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="bank_account">شماره حساب بانکی *</label>
                                        <input type="text" id="bank_account" name="bank_account" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" placeholder="1234567890" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="bank_branch">شعبه *</label>
                                        <input type="text" id="bank_branch" name="bank_branch" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                </div>
                            </div>

                            <!-- کلمه عبور -->
                            <div class="form-section">
                                <h3 class="text-base font-bold text-copper mb-6 border-r-4 border-copper pr-3">تنظیمات حساب کاربری</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="password">کلمه عبور *</label>
                                        <input type="password" id="password" name="password" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="password_confirm">تکرار کلمه عبور *</label>
                                        <input type="password" id="password_confirm" name="password_confirm" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> />
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-slate-800 mb-2" for="registration_reason">دلایل ثبت نام *</label>
                                        <textarea id="registration_reason" name="registration_reason" rows="3" class="w-full rounded-lg border border-slate-400 px-4 py-3 text-base text-slate-900 focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?>></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-copper text-white py-4 rounded-xl font-medium text-lg hover:opacity-90 hover:shadow-xl hover:-translate-y-1 transition-all" id="ad-request-submit"><?php echo $otp_step ? 'تایید نهایی و ثبت‌نام' : 'ثبت نام'; ?></button>
                    </form>
                </div>
            <?php else : ?>
                <div class="mt-12 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                    <div class="text-base px-4 py-4 rounded-lg bg-slate-50 text-slate-700 border border-slate-200 font-medium">مهلت ثبت درخواست به پایان رسیده است.</div>
                </div>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</main>

<style>
.form-section {
    background: #ffffff;
    padding: 32px;
    border: 1px solid #b45309;
    border-radius: 12px;
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
}
.form-section h3 {
    color: #b45309; /* Darker copper for better contrast */
    border-right-color: #b45309;
}
input:focus, select:focus, textarea:focus {
    border-color: #b45309 !important;
    ring-color: #b45309 !important;
    box-shadow: 0 0 0 3px rgba(180, 83, 9, 0.2) !important;
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
        messageBox.className = 'mb-4 text-sm px-4 py-3 rounded-lg ' + (isSuccess ? 'bg-green-50 text-green-900 border border-green-300' : 'bg-red-50 text-red-900 border border-red-300');
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
            submitButton.textContent = 'ثبت نام';
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
            submitButton.textContent = 'ثبت نام';
            setMessage('خطا در ارتباط با سرور. لطفا دوباره تلاش کنید.', false);
        });
    });
};
document.addEventListener('DOMContentLoaded', init);
})();
</script>

<?php
get_footer();
