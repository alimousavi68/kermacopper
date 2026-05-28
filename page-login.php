<?php
/**
 * Template Name: صفحه ورود
 *
 * @package KermanCopper
 */

$dashboard_page = get_page_by_path('dashboard');
$dashboard_url = $dashboard_page ? get_permalink($dashboard_page->ID) : home_url( '/dashboard/' );

if ( is_user_logged_in() ) {
    wp_safe_redirect( $dashboard_url );
    exit;
}

$login_error = '';

// Handle Custom Login Form Submission
if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['dashboard_login_submit'] ) ) {
    $nonce = isset( $_POST['dashboard_login_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['dashboard_login_nonce'] ) ) : '';
    if ( wp_verify_nonce( $nonce, 'dashboard_login_action' ) ) {
        $creds = array(
            'user_login'    => sanitize_text_field( wp_unslash( $_POST['log'] ) ),
            'user_password' => $_POST['pwd'],
            'remember'      => isset( $_POST['rememberme'] ),
        );
        $user = wp_signon( $creds, false );
        if ( is_wp_error( $user ) ) {
            $login_error = 'نام کاربری (کد ملی) یا کلمه عبور وارد شده نادرست است.';
        } else {
            wp_safe_redirect( $dashboard_url );
            exit;
        }
    } else {
        $login_error = 'اعتبار نشست منقضی شده است. لطفا دوباره تلاش کنید.';
    }
}

get_header(); ?>

    <!-- LOGIN HERO SECTION -->
    <header class="relative min-h-[480px] flex items-center justify-center overflow-hidden bg-navy pt-32 lg:pt-40 pb-16">
        <!-- Background Image -->
        <div class="absolute inset-0 w-full h-full">
            <img src="<?php echo get_template_directory_uri(); ?>/images/image2.jpg" class="hero-bg-image w-full h-full object-cover opacity-35 mix-blend-overlay will-change-transform" alt="ورود به سیستم">
            <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/70 to-transparent z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-l from-navy/50 via-transparent to-navy/50 z-10"></div>

            <!-- Glow Accent -->
            <div class="hero-glow-accent absolute -top-[20%] -right-[10%] w-[55%] h-[55%] bg-copper/35 rounded-full blur-[120px] animate-pulse-slow z-15"></div>
        </div>

        <!-- Pattern Background -->
        <div class="absolute inset-0 bg-[radial-gradient(rgba(200,104,47,0.15)_1px,transparent_1px)] bg-[size:32px_32px] opacity-60 z-10"></div>

        <div class="hero-text-container container mx-auto px-6 lg:px-12 relative z-20 text-center font-peyda">
            <!-- Badge -->
            <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full glass-panel mb-6 border border-white/10 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] animate-fade-in-down delay-100 mx-auto">
                <span class="text-copper-light text-xs font-extrabold tracking-widest">پورتال الکترونیکی متقاضیان</span>
            </div>

            <!-- Title -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-4 animate-fade-in-down delay-200">
                ورود به <span class="text-transparent bg-clip-text bg-gradient-to-l from-copper-dark via-copper to-copper-light">پنل کاربری</span>
            </h1>

            <p class="text-base text-slate-400 mx-auto font-light leading-relaxed animate-fade-in-down delay-300 mb-20 max-w-2xl">
                جهت ورود به پنل کاربری متقاضیان و مشاهده و پیگیری درخواست‌ها، لطفاً کد ملی/شناسه ملی و رمز عبور خود را وارد نمایید
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

    <!-- MAIN CONTENT SECTION -->
    <main id="content" class="relative z-20 pb-36 bg-gradient-to-b from-[#FAF8F5] via-white to-[#FAF8F5] pt-12 lg:pt-16">
        <!-- Traditional Kerman Pateh Shamseh Watermark in Background -->
        <div class="absolute right-[-100px] top-[10%] w-[500px] h-[500px] opacity-[0.02] text-navy pointer-events-none z-0 select-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                <circle cx="100" cy="100" r="15" />
                <circle cx="100" cy="100" r="8" />
                <path d="M 100 65 C 92 80, 108 80, 100 65 Z" />
                <path d="M 100 135 C 92 120, 108 120, 100 135 Z" />
                <path d="M 65 100 C 80 92, 80 108, 65 100 Z" />
                <path d="M 135 100 C 120 92, 120 108, 135 100 Z" />
                <polygon points="100,45 139,61 155,100 139,139 100,155 61,139 45,100 61,61" stroke-dasharray="4,4" />
                <path d="M 100 45 Q 110 25 100 10 Q 90 25 100 45" />
                <path d="M 100 155 Q 110 175 100 190 Q 90 175 100 155" />
                <path d="M 155 100 Q 175 110 190 100 Q 175 90 155 100" />
                <path d="M 45 100 Q 25 110 10 100 Q 25 90 45 100" />
            </svg>
        </div>

        <div class="container mx-auto px-6 lg:px-12 relative z-10 flex justify-center -mt-32 sm:-mt-24">
            
            <!-- Login Form -->
            <div class="w-full max-w-md bg-white border border-slate-200/80 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.06)] p-8 sm:p-10 relative overflow-hidden group scroll-reveal z-20">
                <!-- Copper Glow Accent -->
                <div class="absolute top-0 right-0 left-0 h-1.5 bg-gradient-to-l from-copper to-copper-light"></div>
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-copper/5 rounded-full blur-2xl pointer-events-none"></div>

                <div class="text-center mb-8">
                    <span class="text-copper font-black text-xs tracking-wider uppercase block mb-2">ورود متقاضیان</span>
                    <h2 class="text-2xl font-black text-navy">فرم ورود</h2>
                    <div class="w-12 h-1 bg-copper mx-auto mt-3 rounded-full"></div>
                </div>

                <?php if ( ! empty( $login_error ) ) : ?>
                    <div class="mb-6 text-sm px-5 py-4 rounded-2xl border bg-rose-50 border-rose-200 text-rose-600 flex items-center gap-3 font-semibold">
                        <?php echo kermancopper_icon( 'alert-triangle', 'w-5 h-5 flex-shrink-0' ); ?>
                        <span><?php echo esc_html( $login_error ); ?></span>
                    </div>
                <?php endif; ?>

                <form method="post" action="" class="space-y-6">
                    <?php wp_nonce_field( 'dashboard_login_action', 'dashboard_login_nonce' ); ?>
                    <div>
                        <label for="log" class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                            <?php echo kermancopper_icon( 'user', 'w-4 h-4 text-slate-400' ); ?>
                            کد ملی / شناسه ملی *
                        </label>
                        <input type="text" name="log" id="log" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required placeholder="شناسه ملی شرکت یا کدملی" />
                    </div>
                    <div>
                        <label for="pwd" class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                            <?php echo kermancopper_icon( 'lock', 'w-4 h-4 text-slate-400' ); ?>
                            کلمه عبور *
                        </label>
                        <input type="password" name="pwd" id="pwd" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required placeholder="کلمه عبور انتخابی هنگام ثبت نام" />
                    </div>
                    <div class="flex items-center justify-between text-sm font-semibold pb-2">
                        <label class="flex items-center gap-2 cursor-pointer text-slate-600 select-none">
                            <input type="checkbox" name="rememberme" value="forever" class="rounded border-slate-300 text-copper focus:ring-copper" checked />
                            مرا به خاطر بسپار
                        </label>
                    </div>
                    <button type="submit" name="dashboard_login_submit" class="w-full bg-gradient-to-r from-copper-dark via-copper to-copper-light text-white font-black text-lg py-4 rounded-2xl transition-all shadow-[0_10px_30px_rgba(200,104,47,0.2)] hover:shadow-[0_15px_40px_rgba(200,104,47,0.4)] hover:-translate-y-0.5 relative overflow-hidden group">
                        <span class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out"></span>
                        <span class="relative">ورود به پنل</span>
                    </button>
                </form>
            </div>

        </div>
    </main>

<?php get_footer(); ?>
