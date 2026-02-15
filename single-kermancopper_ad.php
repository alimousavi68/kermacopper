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
        $request_message_code = isset( $_GET['ad_request'] ) ? sanitize_text_field( wp_unslash( $_GET['ad_request'] ) ) : '';
        $request_message = '';
        $request_message_class = 'bg-red-50 text-red-700 border border-red-100';
        if ( $request_message_code === 'success' ) {
            $request_message = 'درخواست شما با موفقیت ثبت شد.';
            $request_message_class = 'bg-green-50 text-green-700 border border-green-100';
        } elseif ( $request_message_code === 'missing' ) {
            $request_message = 'لطفا همه فیلدهای ضروری را تکمیل کنید.';
        } elseif ( $request_message_code === 'invalid_email' ) {
            $request_message = 'ایمیل وارد شده معتبر نیست.';
        } elseif ( $request_message_code === 'invalid_mobile' ) {
            $request_message = 'شماره موبایل وارد شده معتبر نیست.';
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
            $request_message = 'ثبت درخواست با خطا روبه‌رو شد. دوباره تلاش کنید.';
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
                    <div class="prose prose-lg max-w-none text-slate-600 leading-loose bg-white border border-slate-100 rounded-sm shadow-sm p-8">
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
                                        <a href="<?php echo esc_url( $form_url ); ?>" class="flex items-center justify-between gap-3 rounded-sm border border-slate-200 px-4 py-3 text-sm font-bold text-slate-700 hover:border-copper hover:text-copper hover:bg-slate-50 transition-all">
                                            <span><?php echo esc_html( $form_name ? $form_name : $fallback_name ); ?></span>
                                            <span class="text-xs text-slate-400">دانلود</span>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="mt-8 rounded-sm border border-slate-100 bg-white p-6 shadow-sm">
                        <h2 class="text-lg font-bold text-slate-900 mb-4">ارسال درخواست اولیه</h2>
                        <?php if ( $request_message !== '' ) : ?>
                            <div class="mb-4 text-sm px-4 py-3 rounded-sm <?php echo esc_attr( $request_message_class ); ?>"><?php echo esc_html( $request_message ); ?></div>
                        <?php endif; ?>
                        <?php if ( $can_submit ) : ?>
                            <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" enctype="multipart/form-data" class="space-y-4">
                                <?php wp_nonce_field( 'kermancopper_ad_request_submit', 'kermancopper_ad_request_nonce' ); ?>
                                <input type="hidden" name="action" value="kermancopper_ad_request_submit" />
                                <input type="hidden" name="ad_id" value="<?php echo esc_attr( $ad_id ); ?>" />
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-2" for="request_name">نام و نام خانوادگی</label>
                                    <input type="text" id="request_name" name="request_name" class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm focus:border-copper focus:ring-copper" required />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-2" for="request_mobile">شماره موبایل</label>
                                    <input type="text" id="request_mobile" name="request_mobile" class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm focus:border-copper focus:ring-copper" required />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-2" for="request_email">ایمیل</label>
                                    <input type="email" id="request_email" name="request_email" class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm focus:border-copper focus:ring-copper" required />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-2" for="request_company">نام شرکت/سازمان</label>
                                    <input type="text" id="request_company" name="request_company" class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm focus:border-copper focus:ring-copper" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-2" for="request_note">توضیح کوتاه</label>
                                    <textarea id="request_note" name="request_note" rows="4" class="w-full rounded-sm border border-slate-200 px-3 py-2 text-sm focus:border-copper focus:ring-copper"></textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 mb-2" for="ad_attachments">فایل‌های پیوست</label>
                                    <input type="file" id="ad_attachments" name="ad_attachments[]" class="w-full text-sm text-slate-500 file:mr-4 file:rounded-sm file:border-0 file:bg-slate-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200" multiple required />
                                    <div class="mt-2 text-xs text-slate-500">فرمت‌های مجاز: Excel، PDF، Word، تصویر و Zip</div>
                                </div>
                                <button type="submit" class="w-full bg-copper text-white py-3 rounded-sm font-bold text-sm hover:opacity-90 hover:shadow-lg hover:-translate-y-0.5 transition-all">ارسال درخواست</button>
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

<?php
get_footer();
