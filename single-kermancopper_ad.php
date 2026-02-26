<?php
get_header(); ?>

<main class="container mx-auto px-4 py-16 mt-[100px] sm:mt-[125px]">
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
        $status = get_post_meta( $ad_id, KERMANCOPPER_AD_META_STATUS, true );
        if ( $status === '' ) {
            $today = current_time( 'Y-m-d' );
            if ( $expiry_date && $expiry_date < $today ) {
                $status = 'closed';
            } else {
                $status = 'active';
            }
        }
        $today = current_time( 'Y-m-d' );
        $is_expired = $expiry_date && $expiry_date < $today;
        $is_closed = $status === 'closed';
        $can_submit = ! $is_closed && ! $is_expired;
        $status_label = $status === 'closed' ? __( 'بسته', 'kermancopper' ) : __( 'فعال', 'kermancopper' );
        $status_class = $status === 'closed'
            ? 'bg-slate-50 text-slate-500 border border-slate-100'
            : 'bg-green-50 text-green-700 border border-green-100';
        $thumbnail = get_the_post_thumbnail_url( $ad_id, 'full' );
        if ( ! $thumbnail ) {
            $thumbnail = get_template_directory_uri() . '/images/image2.jpg';
        }
        $forms = get_post_meta( $ad_id, KERMANCOPPER_AD_META_EXCEL_FORMS, true );
        if ( ! is_array( $forms ) ) {
            $forms = array();
        }
        $otp_token = isset( $_GET['ad_request_token'] ) ? sanitize_text_field( wp_unslash( $_GET['ad_request_token'] ) ) : '';
        $otp_payload = $otp_token ? get_transient( 'kermancopper_ad_otp_' . $otp_token ) : false;
        $show_otp_form = is_array( $otp_payload ) && isset( $otp_payload['ad_id'] ) && (int) $otp_payload['ad_id'] === $ad_id;
        $otp_step = $can_submit && $show_otp_form;
        $request_detail = isset( $_GET['ad_request_detail'] ) ? sanitize_text_field( wp_unslash( $_GET['ad_request_detail'] ) ) : '';
        $otp_verified = $show_otp_form && ! empty( $otp_payload['verified'] );
        $request_message_code = isset( $_GET['ad_request'] ) ? sanitize_text_field( wp_unslash( $_GET['ad_request'] ) ) : '';
        $request_message = '';
        $request_message_class = 'bg-red-50 text-red-700 border border-red-100';
        if ( $request_message_code === 'success' ) {
            $request_message = 'درخواست شما با موفقیت ثبت شد.';
            $request_message_class = 'bg-green-50 text-green-700 border border-green-100';
        } elseif ( $request_message_code === 'otp_sent' ) {
            $request_message = 'کد تایید ارسال شد. لطفا کد را وارد کنید.';
            $request_message_class = 'bg-green-50 text-green-700 border border-green-100';
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
        } elseif ( $request_message_code === 'no_files' ) {
            $request_message = 'حداقل یک فایل پیوست کنید.';
        } elseif ( $request_message_code === 'file_type' ) {
            $request_message = 'نوع فایل مجاز نیست.';
        } elseif ( $request_message_code === 'file_size' ) {
            $request_message = 'حجم فایل بیش از حد مجاز است.';
        } elseif ( $request_message_code === 'invalid_ad' ) {
            $request_message = 'آگهی معتبر نیست.';
        } elseif ( $request_message_code === 'invalid_nonce' ) {
            $request_message = 'اعتبار فرم منقضی شده است. دوباره تلاش کنید.';
        } elseif ( $request_message_code === 'submit_error' || $request_message_code === 'upload' ) {
            $request_message = 'ثبت درخواست با خطا روبه‌رو شد.';
            if ( $request_detail !== '' ) {
                $request_message .= ' جزئیات: ' . $request_detail;
            }
        }
        ?>

        <div class="max-w-6xl mx-auto">
            <div class="mb-10 text-center">
                <div class="flex flex-wrap items-center justify-center gap-3 text-sm text-slate-500 mb-4">
                    <?php if ( $ad_type_link && ! is_wp_error( $ad_type_link ) ) : ?>
                        <a href="<?php echo esc_url( $ad_type_link ); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded-sm bg-white border border-slate-200 text-slate-600 hover:border-copper hover:text-copper transition-all">
                            <i data-lucide="<?php echo esc_attr( $ad_type_icon ); ?>" class="w-3 h-3 text-copper"></i>
                            <?php echo esc_html( $ad_type_label ); ?>
                        </a>
                    <?php else : ?>
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-sm bg-white border border-slate-200 text-slate-600">
                            <i data-lucide="<?php echo esc_attr( $ad_type_icon ); ?>" class="w-3 h-3 text-copper"></i>
                            <?php echo esc_html( $ad_type_label ); ?>
                        </span>
                    <?php endif; ?>
                    <span class="px-3 py-1 rounded-sm font-medium text-xs <?php echo esc_attr( $status_class ); ?>"><?php echo esc_html( $status_label ); ?></span>
                    <span class="flex items-center gap-1 text-xs"><i data-lucide="calendar" class="w-3 h-3 text-slate-400"></i> <?php echo esc_html( get_the_date() ); ?></span>
                </div>
                <h1 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight"><?php echo esc_html( get_the_title() ); ?></h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2">
                    <div class="rounded-sm overflow-hidden shadow-xl mb-8">
                        <img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="w-full h-[420px] object-cover" />
                    </div>
                    <?php if ( has_excerpt() ) : ?>
                        <div class="mb-6 text-lg text-slate-600 leading-relaxed"><?php echo esc_html( get_the_excerpt() ); ?></div>
                    <?php endif; ?>
                    <div class="prose prose-lg max-w-none text-slate-600 leading-loose bg-white border border-slate-100 rounded-sm shadow-sm p-8 ad-content">
                        <?php the_content(); ?>
                    </div>
                </div>

                <aside class="lg:col-span-1">
                    <div class="rounded-sm border border-slate-100 bg-white p-6 shadow-sm space-y-6">
                        <div class="flex items-center justify-between text-sm text-slate-600">
                            <span class="font-medium">مهلت ثبت درخواست</span>
                            <span class="text-slate-700 font-bold"><?php echo esc_html( $expiry_display ); ?></span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-slate-600">
                            <span class="font-medium">وضعیت آگهی</span>
                            <span class="px-2 py-0.5 rounded-sm text-xs font-semibold <?php echo esc_attr( $status_class ); ?>"><?php echo esc_html( $status_label ); ?></span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-slate-600">
                            <span class="font-medium">نوع آگهی</span>
                            <span class="text-slate-700 font-semibold"><?php echo esc_html( $ad_type_label ); ?></span>
                        </div>
                    </div>

                    <?php if ( ! empty( $forms ) ) : ?>
                        <div class="mt-8 rounded-sm border border-slate-100 bg-white p-6 shadow-sm">
                            <h2 class="text-lg font-bold text-slate-900 mb-4">فرم‌های اکسل</h2>
                            <div class="flex flex-col gap-3">
                                <?php foreach ( $forms as $index => $form ) : ?>
                                    <?php
                                    $form_name = isset( $form['name'] ) ? $form['name'] : '';
                                    $form_url = isset( $form['url'] ) ? $form['url'] : '';
                                    $fallback_name = sprintf( 'فرم %d', $index + 1 );
                                    ?>
                                    <?php if ( $form_url ) : ?>
                                        <a href="<?php echo esc_url( $form_url ); ?>" class="ad-excel-link flex items-center justify-between gap-3 rounded-sm border border-slate-200 px-4 py-3 text-sm font-bold text-slate-700 hover:border-copper hover:text-copper hover:bg-slate-50 transition-all">
                                            <span><?php echo esc_html( $form_name ? $form_name : $fallback_name ); ?></span>
                                            <span class="ad-excel-meta text-xs text-slate-400">دانلود</span>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="mt-8 rounded-sm border border-slate-100 bg-white p-6 shadow-sm">
                        <h2 class="text-lg font-bold text-slate-900 mb-4">ارسال درخواست</h2>
                        <div id="ad-request-message" class="mb-4 text-sm px-4 py-3 rounded-sm <?php echo esc_attr( $request_message_class ); ?><?php echo $request_message !== '' ? '' : ' hidden'; ?>"><?php echo esc_html( $request_message ); ?></div>
                        <?php if ( $can_submit ) : ?>
                            <?php
                            $info_disabled = $otp_step ? 'disabled' : '';
                            $info_required = $otp_step ? '' : 'required';
                            $otp_disabled = $otp_step ? '' : 'disabled';
                            ?>
                            <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" enctype="multipart/form-data" class="space-y-4" id="ad-request-form" data-ajax-url="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" data-step="<?php echo $otp_step ? 'otp' : 'info'; ?>">
                                <?php wp_nonce_field( 'kermancopper_ad_request_submit', 'kermancopper_ad_request_nonce' ); ?>
                                <?php wp_nonce_field( 'kermancopper_ad_request_verify', 'kermancopper_ad_request_verify_nonce' ); ?>
                                <input type="hidden" name="action" value="<?php echo $otp_step ? 'kermancopper_ad_request_verify' : 'kermancopper_ad_request_otp'; ?>" />
                                <input type="hidden" name="ad_request_token" value="<?php echo esc_attr( $otp_token ); ?>" />
                                <input type="hidden" name="ad_id" value="<?php echo esc_attr( $ad_id ); ?>" />
                                <div data-step-section="otp" class="<?php echo $otp_step ? '' : 'hidden'; ?>">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-2">نام و نام خانوادگی</label>
                                        <div class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm text-slate-600 bg-slate-50" data-summary="name"><?php echo esc_html( $otp_payload['name'] ?? '' ); ?></div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-2">شماره موبایل</label>
                                        <div class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm text-slate-600 bg-slate-50" data-summary="mobile"><?php echo esc_html( $otp_payload['mobile'] ?? '' ); ?></div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-2">ایمیل</label>
                                        <div class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm text-slate-600 bg-slate-50" data-summary="email"><?php echo esc_html( $otp_payload['email'] ?? '' ); ?></div>
                                    </div>
                                    <div class="<?php echo ! empty( $otp_payload['company'] ) ? '' : 'hidden'; ?>" data-summary-block="company">
                                        <label class="block text-sm font-medium text-slate-600 mb-2">نام شرکت/سازمان</label>
                                        <div class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm text-slate-600 bg-slate-50" data-summary="company"><?php echo esc_html( $otp_payload['company'] ?? '' ); ?></div>
                                    </div>
                                    <div class="<?php echo ! empty( $otp_payload['note'] ) ? '' : 'hidden'; ?>" data-summary-block="note">
                                        <label class="block text-sm font-medium text-slate-600 mb-2">توضیح کوتاه</label>
                                        <div class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm text-slate-600 bg-slate-50" data-summary="note"><?php echo esc_html( $otp_payload['note'] ?? '' ); ?></div>
                                    </div>
                                    <div class="rounded-sm border border-slate-100 bg-slate-50 px-4 py-2 text-xs text-slate-500">فایل‌های پیوست ثبت شد.</div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-2" for="otp_code">کد تایید</label>
                                        <input type="text" id="otp_code" name="otp_code" class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm focus:border-copper focus:ring-copper" required <?php echo esc_attr( $otp_disabled ); ?> />
                                    </div>
                                    <div id="otp-code-preview" class="rounded-sm border border-amber-200 bg-amber-50 px-4 py-2 text-xs text-amber-700<?php echo ! empty( $otp_payload['code'] ) ? '' : ' hidden'; ?>">
                                        کد تایید صوری: <span id="otp-code-value"><?php echo esc_html( $otp_payload['code'] ?? '' ); ?></span>
                                    </div>
                                </div>
                                <div data-step-section="info" class="<?php echo $otp_step ? 'hidden' : ''; ?>">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-2" for="request_name">نام و نام خانوادگی</label>
                                        <input type="text" id="request_name" name="request_name" class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> <?php echo esc_attr( $info_disabled ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-2" for="request_mobile">شماره موبایل</label>
                                        <input type="text" id="request_mobile" name="request_mobile" class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> <?php echo esc_attr( $info_disabled ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-2" for="request_email">ایمیل</label>
                                        <input type="email" id="request_email" name="request_email" class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_required ); ?> <?php echo esc_attr( $info_disabled ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-2" for="request_company">نام شرکت/سازمان</label>
                                        <input type="text" id="request_company" name="request_company" class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_disabled ); ?> />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-2" for="request_note">توضیح کوتاه</label>
                                        <textarea id="request_note" name="request_note" rows="4" class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm focus:border-copper focus:ring-copper" <?php echo esc_attr( $info_disabled ); ?>></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-2" for="ad_attachments">فایل‌های پیوست</label>
                                        <input type="file" id="ad_attachments" name="ad_attachments[]" class="w-full text-sm text-slate-500 file:mr-4 file:rounded-sm file:border-0 file:bg-slate-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200" multiple <?php echo esc_attr( $info_required ); ?> <?php echo esc_attr( $info_disabled ); ?> />
                                        <div class="mt-2 text-xs text-slate-500">فرمت‌های مجاز: Excel، PDF، Word، تصویر و Zip</div>
                                    </div>
                                </div>
                                <button type="submit" class="w-full bg-copper text-white py-3 rounded-sm font-bold text-sm hover:opacity-90 hover:shadow-lg hover:-translate-y-0.5 transition-all" id="ad-request-submit"><?php echo $otp_step ? 'تایید و ارسال درخواست' : 'ارسال درخواست'; ?></button>
                            </form>
                        <?php else : ?>
                            <div class="text-sm px-4 py-3 rounded-sm bg-slate-50 text-slate-600 border border-slate-100">مهلت ثبت درخواست به پایان رسیده است.</div>
                        <?php endif; ?>
                    </div>
                </aside>
            </div>
        </div>
    <?php endwhile; ?>
</main>

<script>
(function () {
    var init = function () {
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
    var otpCodePreview = document.getElementById('otp-code-preview');
    var otpCodeValue = document.getElementById('otp-code-value');
    var summaryBlocks = form.querySelectorAll('[data-summary-block]');
    var setMessage = function (text, isSuccess) {
        if (!messageBox) {
            return;
        }
        messageBox.textContent = text;
        messageBox.className = 'mb-4 text-sm px-4 py-3 rounded-sm ' + (isSuccess ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-red-50 text-red-700 border border-red-100');
        messageBox.classList.remove('hidden');
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
        var fields = section.querySelectorAll('input, textarea, select');
        fields.forEach(function (field) {
            if (isActive) {
                field.disabled = false;
                if (field.dataset.wasRequired === 'true') {
                    field.required = true;
                }
            } else {
                if (field.required) {
                    field.dataset.wasRequired = 'true';
                }
                field.required = false;
                field.disabled = true;
            }
        });
    };
    var setStep = function (step) {
        form.dataset.step = step;
        toggleSection(infoSection, step === 'info');
        toggleSection(otpSection, step === 'otp');
        if (actionInput) {
            actionInput.value = step === 'otp' ? 'kermancopper_ad_request_verify' : 'kermancopper_ad_request_otp';
        }
        if (submitButton) {
            submitButton.textContent = step === 'otp' ? 'تایید و ارسال درخواست' : 'ارسال درخواست';
        }
    };
    var updateSummary = function () {
        var nameValue = (form.querySelector('#request_name') || {}).value || '';
        var mobileValue = (form.querySelector('#request_mobile') || {}).value || '';
        var emailValue = (form.querySelector('#request_email') || {}).value || '';
        var companyValue = (form.querySelector('#request_company') || {}).value || '';
        var noteValue = (form.querySelector('#request_note') || {}).value || '';
        var nameBox = form.querySelector('[data-summary="name"]');
        var mobileBox = form.querySelector('[data-summary="mobile"]');
        var emailBox = form.querySelector('[data-summary="email"]');
        var companyBox = form.querySelector('[data-summary="company"]');
        var noteBox = form.querySelector('[data-summary="note"]');
        if (nameBox) {
            nameBox.textContent = nameValue;
        }
        if (mobileBox) {
            mobileBox.textContent = mobileValue;
        }
        if (emailBox) {
            emailBox.textContent = emailValue;
        }
        if (companyBox) {
            companyBox.textContent = companyValue;
        }
        if (noteBox) {
            noteBox.textContent = noteValue;
        }
        summaryBlocks.forEach(function (block) {
            var key = block.getAttribute('data-summary-block');
            var value = '';
            if (key === 'company') {
                value = companyValue;
            }
            if (key === 'note') {
                value = noteValue;
            }
            if (value) {
                block.classList.remove('hidden');
            } else {
                block.classList.add('hidden');
            }
        });
    };
    setStep(form.dataset.step || 'info');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        var step = form.dataset.step || 'info';
        var ajaxUrl = form.getAttribute('data-ajax-url');
        var formData = new FormData(form);
        formData.set('action', step === 'otp' ? 'kermancopper_ad_request_verify' : 'kermancopper_ad_request_otp');
        if (submitButton) {
            submitButton.disabled = true;
        }
        fetch(ajaxUrl, {
            method: 'POST',
            credentials: 'same-origin',
            body: formData
        }).then(function (response) {
            return response.json().then(function (data) {
                return { ok: response.ok, data: data };
            });
        }).then(function (result) {
            if (!result.ok || !result.data || !result.data.success) {
                var message = (result.data && result.data.data && result.data.data.message) ? result.data.data.message : 'ثبت درخواست با خطا روبه‌رو شد.';
                setMessage(message, false);
                return;
            }
            if (step === 'info') {
                var payload = result.data.data || {};
                if (tokenInput && payload.otp_token) {
                    tokenInput.value = payload.otp_token;
                }
                if (otpCodeValue && payload.otp_code) {
                    otpCodeValue.textContent = payload.otp_code;
                    if (otpCodePreview) {
                        otpCodePreview.classList.remove('hidden');
                    }
                }
                updateSummary();
                setStep('otp');
                if (payload.message) {
                    setMessage(payload.message, true);
                }
                return;
            }
            var successMessage = (result.data.data && result.data.data.message) ? result.data.data.message : 'درخواست شما با موفقیت ثبت شد.';
            setMessage(successMessage, true);
            form.reset();
            if (tokenInput) {
                tokenInput.value = '';
            }
            if (otpCodePreview) {
                otpCodePreview.classList.add('hidden');
            }
            setStep('info');
        }).catch(function () {
            setMessage('ثبت درخواست با خطا روبه‌رو شد.', false);
        }).finally(function () {
            if (submitButton) {
                submitButton.disabled = false;
            }
        });
    });
    };
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>

<?php
get_footer();
