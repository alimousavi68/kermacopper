<?php
/**
 * Template Name: درباره ما
 *
 * @package KermanCopper
 */
get_header();
?>

    <!-- ABOUT HERO SECTION -->
    <header class="relative min-h-[520px] flex items-center justify-center overflow-hidden bg-navy pt-32 lg:pt-40 pb-16">
        <!-- Background Image -->
        <div class="absolute inset-0 w-full h-full">
            <img src="<?php $hero_bg_image_id = get_theme_mod( 'kermancopper_home_hero_slide_1_image_id' ); $hero_bg_image_url = $hero_bg_image_id ? wp_get_attachment_image_url( $hero_bg_image_id, 'full' ) : ''; echo esc_url( $hero_bg_image_url ?: ( get_template_directory_uri() . '/images/pano sarcheshmeh.jpg' ) ); ?>" class="hero-bg-image w-full h-full object-cover opacity-35 mix-blend-overlay will-change-transform" alt="درباره مس کرمان زمین">
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
            <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full glass-panel mb-6 border border-white/10 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] mx-auto">
                <span class="text-copper-light text-xs font-extrabold tracking-widest">توسعه پایدار و اصالت ملی در صنعت مس</span>
            </div>

            <!-- Title -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-4 mx-auto" style="line-height: 1.8 !important;">
                ریشه در خاک، پیشرو در <span class="text-transparent bg-clip-text bg-gradient-to-l from-copper-dark via-copper to-copper-light">صنعت و نوآوری</span>
            </h1>

            <p class="text-sm md:text-base text-slate-400 mx-auto font-light leading-relaxed mb-20 max-w-2xl">
                صنایع و معادن مس کرمان زمین؛ پیشرو در توسعه پایدار، خودکفایی علمی و معدن‌کاری پیشرفته مس
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

<main class="about-page-main" id="content" dir="rtl">
    <style>
        /* ─── Premium Custom CSS System (No Tailwind JIT Dependency) ─── */

        .about-page-main {
            background: linear-gradient(to bottom, #FAF8F5, #ffffff, #FAF8F5);
            color: #1a2235;
            font-family: 'PeydaWebVF', 'Peyda', sans-serif;
            overflow-x: hidden;
            padding-bottom: 9rem;
        }

        /* ── Floating Stats Strip ── */
        .stats-strip-wrapper {
            margin-top: -100px;
            position: relative;
            z-index: 25;
            padding: 0 1.5rem;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
        .stats-strip-card {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.04);
            border-radius: 2.25rem;
            padding: 3rem 4rem;
            box-shadow: 
                0 4px 30px rgba(0, 0, 0, 0.01),
                0 25px 55px rgba(26, 34, 53, 0.05);
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 2rem;
            align-items: center;
        }
        .stats-col {
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
            align-items: center;
            justify-content: center;
        }
        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            color: #C8682F;
            margin-bottom: 0.4rem;
            line-height: 1;
            display: flex;
            align-items: center;
        }
        .stat-number span {
            color: #C8682F;
        }
        .stat-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #64748b;
        }
        .stat-vertical-divider {
            width: 1px;
            height: 120px;
            background: rgba(0, 0, 0, 0.06);
        }
        @media (max-width: 768px) {
            .stats-strip-card {
                grid-template-columns: 1fr;
                padding: 2.5rem 2rem;
                gap: 2rem;
            }
            .stat-vertical-divider {
                display: none;
            }
            .stats-col {
                gap: 2rem;
            }
        }

        /* ── Section Labels ── */
        .section-label-container {
            text-align: center;
            margin-bottom: 4rem;
        }
        .premium-section-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, rgba(200, 104, 47, 0.08) 0%, rgba(200, 104, 47, 0.02) 100%);
            border: 1px solid rgba(200, 104, 47, 0.2);
            color: #C8682F;
            font-size: 0.72rem;
            font-weight: 800;
            padding: 8px 16px;
            border-radius: 100px;
            box-shadow: 0 4px 12px rgba(200, 104, 47, 0.03);
            text-transform: uppercase;
        }
        .premium-section-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            background-color: #C8682F;
            border-radius: 50%;
            box-shadow: 0 0 8px #E28652;
            display: inline-block;
        }
        .section-main-title {
            color: #1A2235;
            font-size: 2.25rem;
            font-weight: 900;
            margin-top: 1rem;
        }
        .section-title-line {
            width: 60px;
            height: 4px;
            background: linear-gradient(to left, #C8682F, #E28652);
            margin: 1.25rem auto 0 auto;
            border-radius: 10px;
        }

        /* ── Bento Grid Styling ── */
        .bento-grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.75rem;
        }
        .bento-card {
            border-radius: 2.25rem;
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            text-align: right;
        }
        .bento-card-2col {
            grid-column: span 2;
        }
        .bento-card-light {
            background-color: #ffffff;
            border: 1px solid rgba(200, 104, 47, 0.15);
            box-shadow: 
                0 4px 20px rgba(26, 34, 53, 0.03),
                0 20px 40px -15px rgba(26, 34, 53, 0.06);
        }
        .bento-card-light::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 10% 10%, rgba(200, 104, 47, 0.04) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.5s;
            pointer-events: none;
        }
        .bento-card-light:hover {
            transform: translateY(-6px);
            border-color: rgba(200, 104, 47, 0.22);
            box-shadow: 
                0 20px 40px -10px rgba(200, 104, 47, 0.07),
                0 10px 25px -10px rgba(0, 0, 0, 0.02);
        }
        .bento-card-light:hover::before {
            opacity: 1;
        }
        .bento-card-dark {
            background: linear-gradient(145deg, #1A2235 0%, #0F1522 100%);
            border: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: 
                0 4px 20px rgba(0, 0, 0, 0.15),
                0 20px 40px rgba(15, 21, 34, 0.2);
        }
        .bento-card-dark::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 90% 90%, rgba(200, 104, 47, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }
        .bento-card-dark:hover {
            transform: translateY(-6px);
            border-color: rgba(200, 104, 47, 0.35);
            box-shadow: 
                0 20px 40px -10px rgba(200, 104, 47, 0.18),
                0 10px 25px -10px rgba(0, 0, 0, 0.08);
        }
        .bento-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        .bento-card-light .bento-card-icon {
            background-color: rgba(200, 104, 47, 0.06);
            border: 1px solid rgba(200, 104, 47, 0.12);
            color: #C8682F;
        }
        .bento-card-dark .bento-card-icon {
            background-color: rgba(200, 104, 47, 0.12);
            border: 1px solid rgba(200, 104, 47, 0.2);
            color: #E28652;
        }
        .bento-card-header-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1rem;
        }
        .bento-card-badge-dot {
            width: 6px;
            height: 6px;
            background-color: #C8682F;
            border-radius: 50%;
            box-shadow: 0 0 8px #E28652;
        }
        .bento-card-badge-text {
            font-size: 0.72rem;
            font-weight: 800;
            color: #C8682F;
            text-transform: uppercase;
        }
        .bento-card-title {
            font-size: 1.5rem;
            font-weight: 900;
            line-height: 1.4;
            margin-bottom: 1rem;
        }
        .bento-card-light .bento-card-title {
            color: #1A2235;
        }
        .bento-card-dark .bento-card-title {
            color: #ffffff;
        }
        .bento-card-desc {
            font-size: 0.88rem;
            line-height: 2.1;
            font-weight: 500;
        }
        .bento-card-light .bento-card-desc {
            color: #64748b;
        }
        .bento-card-dark .bento-card-desc {
            color: #94a3b8;
        }
        .bento-card-footer {
            margin-top: 2rem;
            padding-top: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .bento-card-light .bento-card-footer {
            border-top: 1px solid rgba(200, 104, 47, 0.08);
            color: #C8682F;
        }
        .bento-card-dark .bento-card-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            color: #E28652;
            justify-content: space-between;
        }
        .bento-card-footer-dot {
            width: 4px;
            height: 4px;
            background-color: #C8682F;
            border-radius: 50%;
            opacity: 0.5;
        }
        @media (max-width: 991px) {
            .bento-grid-container {
                grid-template-columns: 1fr;
            }
            .bento-card-2col {
                grid-column: span 1;
            }
        }

        /* ── Value Chain Section ── */
        .value-chain-container {
            position: relative;
            margin-top: 4rem;
        }
        .value-chain-timeline {
            position: absolute;
            top: 50px;
            bottom: 50px;
            left: 50%;
            width: 2px;
            background: linear-gradient(to bottom, rgba(200, 104, 47, 0.02) 0%, rgba(200, 104, 47, 0.25) 15%, rgba(200, 104, 47, 0.25) 85%, rgba(200, 104, 47, 0.02) 100%);
            transform: translateX(-50%);
            z-index: 1;
        }
        .value-chain-step-row {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 3.5rem;
            align-items: center;
            margin-bottom: 7rem;
            position: relative;
            z-index: 5;
        }
        .value-chain-step-row:last-child {
            margin-bottom: 0;
        }
        .vc-col-img {
            grid-column: span 6;
        }
        .vc-col-content {
            grid-column: span 6;
            text-align: right;
        }
        .vc-image-frame-v2 {
            position: relative;
            border-radius: 2.25rem;
            padding: 10px;
            background: linear-gradient(135deg, rgba(200, 104, 47, 0.06) 0%, transparent 100%);
            border: 1px solid rgba(200, 104, 47, 0.18);
            box-shadow: 0 10px 30px -10px rgba(26, 34, 53, 0.06);
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
        }
        .vc-image-frame-v2 img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 1.85rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .vc-image-frame-v2:hover {
            border-color: rgba(200, 104, 47, 0.28);
            transform: translateY(-4px);
            box-shadow: 0 25px 45px rgba(200, 104, 47, 0.05);
        }
        .vc-image-frame-v2:hover img {
            transform: scale(1.05);
        }
        .vc-badge-v2 {
            position: absolute;
            top: 25px;
            right: 25px;
            background: rgba(15, 21, 34, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #ffffff;
            font-size: 0.72rem;
            font-weight: 800;
            padding: 6px 14px;
            border-radius: 10px;
            z-index: 10;
        }
        .vc-content-header {
            display: flex;
            align-items: flex-start;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        .vc-num-badge {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(200, 104, 47, 0.15) 0%, rgba(200, 104, 47, 0.05) 100%);
            border: 2px solid rgba(200, 104, 47, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: 900;
            color: #C8682F;
            box-shadow: 0 4px 15px rgba(200, 104, 47, 0.1);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            flex-shrink: 0;
        }
        .value-chain-step-row:hover .vc-num-badge {
            background-color: #C8682F;
            color: #ffffff;
            border-color: #C8682F;
            box-shadow: 0 8px 25px rgba(200, 104, 47, 0.3);
            transform: scale(1.06);
        }
        .vc-titles {
            flex-grow: 1;
        }
        .vc-title-fa {
            font-size: 1.75rem;
            font-weight: 900;
            color: #1A2235;
            line-height: 1.2;
            margin-bottom: 2px;
        }
        .vc-title-en {
            font-size: 0.85rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .vc-desc {
            color: #64748b;
            font-size: 0.92rem;
            line-height: 2.1;
            font-weight: 500;
            margin-bottom: 1.75rem;
        }
        .vc-tags-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .vc-tag {
            font-size: 0.72rem;
            font-weight: 700;
            color: #1A2235;
            background-color: rgba(26, 34, 53, 0.04);
            border: 1px solid rgba(26, 34, 53, 0.06);
            padding: 5px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .vc-tag:hover {
            color: #C8682F;
            background-color: rgba(200, 104, 47, 0.05);
            border-color: rgba(200, 104, 47, 0.18);
        }
        @media (max-width: 991px) {
            .value-chain-timeline {
                display: none;
            }
            .value-chain-step-row {
                grid-template-columns: 1fr;
                gap: 2rem;
                margin-bottom: 5rem;
            }
            .vc-col-img {
                grid-column: span 1;
            }
            .vc-col-content {
                grid-column: span 1;
            }
            .vc-col-img-reverse {
                order: -1;
            }
            .vc-image-frame-v2 img {
                height: 280px;
            }
        }

        /* ── Vision & Values Section ── */
        .vision-section {
            background-color: #0F1522;
            border-radius: 3rem;
            padding: 5rem;
            position: relative;
            overflow: hidden;
            color: #ffffff;
            margin-top: 6rem;
            margin-bottom: 4rem;
        }
        .vision-mesh-glow-1 {
            position: absolute;
            top: -30%;
            right: -10%;
            width: 60%;
            height: 80%;
            background-color: rgba(200, 104, 47, 0.1);
            border-radius: 50%;
            filter: blur(140px);
            pointer-events: none;
        }
        .vision-mesh-glow-2 {
            position: absolute;
            bottom: -20%;
            left: -10%;
            width: 50%;
            height: 70%;
            background-color: rgba(56, 189, 248, 0.04);
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
        }
        .vision-grid-overlay {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.015) 1.2px, transparent 1.2px);
            background-size: 24px 24px;
            pointer-events: none;
        }
        .vision-grid-row {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 10;
        }
        .vision-left-col {
            grid-column: span 5;
            text-align: right;
        }
        .vision-right-col {
            grid-column: span 7;
        }
        .vision-section-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: rgba(200, 104, 47, 0.12);
            border: 1px solid rgba(200, 104, 47, 0.25);
            color: #e8a070;
            font-size: 0.72rem;
            font-weight: 800;
            padding: 8px 16px;
            border-radius: 100px;
            margin-bottom: 1.5rem;
        }
        .vision-section-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            background-color: #E28652;
            border-radius: 50%;
            display: inline-block;
        }
        .vision-title {
            font-size: 2rem;
            font-weight: 900;
            line-height: 1.4;
            margin-bottom: 1.5rem;
            color: #ffffff;
        }
        .vision-desc {
            color: #94a3b8;
            font-size: 0.92rem;
            line-height: 2.1;
            font-weight: 400;
            margin-bottom: 2.5rem;
        }
        .vision-cta-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .cta-btn-primary {
            background-color: #C8682F;
            color: #ffffff;
            padding: 12px 28px;
            border-radius: 100px;
            font-size: 0.78rem;
            font-weight: 800;
            box-shadow: 0 8px 25px rgba(200, 104, 47, 0.3);
            transition: all 0.3s ease;
        }
        .cta-btn-primary:hover {
            background-color: #E28652;
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(200, 104, 47, 0.45);
            color: #ffffff;
        }
        .cta-btn-secondary {
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            padding: 12px 28px;
            border-radius: 100px;
            font-size: 0.78rem;
            font-weight: 800;
            transition: all 0.3s ease;
        }
        .cta-btn-secondary:hover {
            background-color: #ffffff;
            color: #0F1522;
            transform: translateY(-3px);
        }

        .values-grid-v2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }
        .value-card-v2 {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 1.75rem;
            padding: 2rem;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            text-align: right;
        }
        .value-card-v2:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(200, 104, 47, 0.4);
            transform: translateY(-4px);
            box-shadow: 0 15px 35px -5px rgba(200, 104, 47, 0.15);
        }
        .value-card-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(200, 104, 47, 0.15);
            border: 1px solid rgba(200, 104, 47, 0.2);
            color: #E28652;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            transition: all 0.4s ease;
        }
        .value-card-v2:hover .value-card-icon-box {
            background-color: #C8682F;
            color: #ffffff;
            transform: scale(1.05) rotate(5deg);
        }
        .value-card-title {
            font-size: 1rem;
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 0.5rem;
            transition: color 0.3s;
        }
        .value-card-v2:hover .value-card-title {
            color: #E28652;
        }
        .value-card-desc {
            color: #94a3b8;
            font-size: 0.78rem;
            line-height: 1.95;
            font-weight: 500;
        }
        @media (max-width: 991px) {
            .vision-section {
                padding: 3rem;
            }
            .vision-grid-row {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
            .vision-left-col {
                grid-column: span 1;
            }
            .vision-right-col {
                grid-column: span 1;
            }
        }
        @media (max-width: 575px) {
            .values-grid-v2 {
                grid-template-columns: 1fr;
            }
            .vision-section {
                padding: 2rem 1.5rem;
            }
        }

        /* ── Scroll Reveals ── */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: transform, opacity;
        }
        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }
        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }

        @keyframes pulse-glow {
            0%, 100% { opacity: 0.35; transform: scale(1); }
            50% { opacity: 0.65; transform: scale(1.08); }
        }
    </style>

    <!-- ─── MAIN CONTENT CONTAINER ─── -->
    <div class="relative z-20">
        <div class="container mx-auto px-6 lg:px-12 pt-12">

            <!-- ─── SECTION 1: HISTORY & BENTO GRID ─── -->
            <section class="mt-28 mb-32">
                <!-- Section Header -->
                <div class="section-label-container scroll-reveal">
                    <span class="premium-section-badge">ریشه‌ها و اصالت</span>
                    <h2 class="section-main-title">میراث معدن‌کاری و سیر تاریخی</h2>
                    <div class="section-title-line"></div>
                </div>

                <!-- Bento Grid -->
                <div class="bento-grid-container">
                    <!-- Card 1: Ancient History (2 cols wide) -->
                    <div class="bento-card bento-card-light bento-card-2col scroll-reveal">
                        <div>
                            <div class="bento-card-header-badge">
                                <span class="bento-card-badge-dot"></span>
                                <span class="bento-card-badge-text">قدمت تاریخی</span>
                            </div>
                            <h3 class="bento-card-title">مس کرمان؛ میراث ۶۰۰۰ ساله فلزکاری</h3>
                            <p class="bento-card-desc">
                                کاوش‌های باستان‌شناختی در محوطه‌هایی همچون «تل ابلیس» و «تپه یحیی» گواه آن است که استان کرمان از نخستین خاستگاه‌های ذوب مس و متالورژی در جهان باستان بوده است. نیاکان ما در این دشت پهناور، قرن‌ها پیش از عصر صنعتی مدرن، با روش‌های سنتی اقدام به استخراج کانسارها و ساخت ابزار مفرغی و مسی می‌کردند. این میراث تاریخی، الهام‌بخش ما در احیا و توسعه پیشرفته‌ترین روش‌های فرآوری فلز سرخ در عصر حاضر است.
                            </p>
                        </div>
                        <div class="bento-card-footer">
                            <span>پیشینه کهن فلات ایران</span>
                            <span class="bento-card-footer-dot"></span>
                            <span>از تل ابلیس تا صنعت نوین</span>
                        </div>
                    </div>

                    <!-- Card 2: Discovery (Dark Contrast Card) -->
                    <div class="bento-card bento-card-dark scroll-reveal delay-100">
                        <div>
                            <div class="bento-card-icon">
                                <?php echo kermancopper_icon('search', 'w-5 h-5'); ?>
                            </div>
                            <h3 class="bento-card-title">اکتشاف ذخیره سرچشمه</h3>
                            <p class="bento-card-desc">
                                در اواخر دهه ۱۳۴۰ خورشیدی، وجود یک کانسار مس پورفیری عظیم در دره سرچشمه کرمان با ارزیابی‌های ژئوشیمیایی پیشرفته تایید شد. این ذخیره بزرگ، یکی از غنی‌ترین توده‌های معدنی مس جهان است که نقطه‌عطفی در ورود ایران به صنعت متالورژی سنگین گردید.
                            </p>
                        </div>
                        <div class="bento-card-footer">
                            <span style="color: #94a3b8; font-weight: 400;">آغاز مطالعات سیستماتیک</span>
                            <span style="color: #E28652;">۱۳۴۶ خورشیدی</span>
                        </div>
                    </div>

                    <!-- Card 3: Modern Enterprise -->
                    <div class="bento-card bento-card-light scroll-reveal delay-100">
                        <div>
                            <div class="bento-card-icon">
                                <?php echo kermancopper_icon('factory', 'w-5 h-5'); ?>
                            </div>
                            <h3 class="bento-card-title">تجهیز و توسعه صنعتی</h3>
                            <p class="bento-card-desc">
                                به موازات پیشرفت طراحی‌ها، کارخانجات تغلیظ، ذوب و پالایشگاه الکترولیز مس برنامه‌ریزی و احداث گردید تا چرخه استخراج تا شمش مس کاتدی در قلب استان کرمان تکمیل گردد. مس کرمان زمین امروزه با ارتقای دانش مهندسی، یکی از پیشتازان بازارهای منطقه‌ای است.
                            </p>
                        </div>
                        <div class="bento-card-footer" style="justify-content: space-between;">
                            <span style="color: #64748b; font-weight: 500;">کاتد مس با خلوص عالی</span>
                            <span>هاب متالورژی ایران</span>
                        </div>
                    </div>

                    <!-- Card 4: Environment & CSR (2 cols wide) -->
                    <div class="bento-card bento-card-light bento-card-2col scroll-reveal delay-200">
                        <div>
                            <div class="bento-card-icon">
                                <?php echo kermancopper_icon('leaf', 'w-5 h-5'); ?>
                            </div>
                            <h3 class="bento-card-title">توسعه پایدار بومی و مسئولیت‌های زیست‌محیطی</h3>
                            <p class="bento-card-desc">
                                ما متعهد به ایجاد هم‌زیستی مسالمت‌آمیز میان صنعت سنگین و حفظ اکوسیستم‌های طبیعی کرمان هستیم. احداث کارخانجات اسید سولفوریک با هدف پالایش کامل گازهای خروجی کوره، توسعه فناوری‌های بازیافت آب و کاهش نرخ مصرف انرژی الکتریکی در صنایع فرآوری، گامی جدی در جهت معدن‌کاری سبز است.
                            </p>
                        </div>
                        <div class="bento-card-footer">
                            <span>پروژه‌های معدن‌کاری سبز</span>
                            <span class="bento-card-footer-dot"></span>
                            <span>مدیریت یکپارچه منابع آب و بازچرخانی</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ─── SECTION 2: VALUE CHAIN ─── -->
            <section class="mb-32">
                <!-- Section Header -->
                <div class="section-label-container scroll-reveal">
                    <span class="premium-section-badge">فرآیندها و دستاوردها</span>
                    <h2 class="section-main-title">زنجیره کامل ارزش؛ از خاک تا کاتد مس</h2>
                    <div class="section-title-line"></div>
                </div>

                <!-- Value Chain Layout -->
                <div class="value-chain-container">
                    <!-- Timeline Connector line -->
                    <div class="value-chain-timeline"></div>

                    <!-- Step 1: Mining -->
                    <div class="value-chain-step-row scroll-reveal">
                        <!-- Image -->
                        <div class="vc-col-img">
                            <div class="vc-image-frame-v2">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/about/realistic_mine.png" alt="معدن‌کاری و استخراج مس روباز">
                                <span class="vc-badge-v2">گام نخست: استخراج</span>
                            </div>
                        </div>
                        <!-- Content -->
                        <div class="vc-col-content">
                            <div class="vc-content-header">
                                <div class="vc-num-badge">۱</div>
                                <div class="vc-titles">
                                    <h3 class="vc-title-fa">استخراج روباز</h3>
                                    <span class="vc-title-en">Open-Pit Mining</span>
                                </div>
                            </div>
                            <p class="vc-desc">
                                استخراج مواد معدنی کانسار پورفیری سرچشمه با روش استخراج روباز در پله‌هایی با ارتفاع مناسب صورت می‌پذیرد. عملیات چال‌زنی، آتش‌باری سنگ‌های سخت و ترابری با غول‌پیکرترین کامیون‌های معدنی سنگ‌شکن‌ها را به کار می‌اندازد. نظارت مانیتورینگ آنلاین دیسپچینگ، ضامن امنیت و راندمان این فرآیند شبانه‌روزی است.
                            </p>
                            <div class="vc-tags-row">
                                <span class="vc-tag">دیسپچینگ هوشمند</span>
                                <span class="vc-tag">چال‌زنی سنگین</span>
                                <span class="vc-tag">ارتفاع پله: ۱۵ متر</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Concentration (Reversed layout) -->
                    <div class="value-chain-step-row scroll-reveal">
                        <!-- Content (First on desktop, second on mobile) -->
                        <div class="vc-col-content">
                            <div class="vc-content-header">
                                <div class="vc-num-badge">۲</div>
                                <div class="vc-titles">
                                    <h3 class="vc-title-fa">تغلیظ سنگ مس</h3>
                                    <span class="vc-title-en">Concentration</span>
                                </div>
                            </div>
                            <p class="vc-desc">
                                سنگ معدن خرد شده در آسیاب‌های گلوله‌ای و نیمه‌خودشناور به ابعاد میکرومتری خرد می‌شود. سپس در سلول‌های فلوتاسیون با افزودن شناورکننده‌های شیمیایی، ذرات مس‌دار از باطله جدا شده و عیار مس سنگ خام از ۰.۶٪ به ۲۸٪ در قالب کنسانتره مس صعود می‌کند.
                            </p>
                            <div class="vc-tags-row">
                                <span class="vc-tag">فلوتاسیون پیشرفته</span>
                                <span class="vc-tag">عیار محصول: ۲۸٪</span>
                                <span class="vc-tag">آسیاب نیمه‌خودشناور (SAG)</span>
                            </div>
                        </div>
                        <!-- Image (Second on desktop, first on mobile) -->
                        <div class="vc-col-img vc-col-img-reverse">
                            <div class="vc-image-frame-v2">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/about/image1.png" alt="تغلیظ و فرآوری مس">
                                <span class="vc-badge-v2">گام دوم: فرآوری و تغلیظ</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Smelting -->
                    <div class="value-chain-step-row scroll-reveal">
                        <!-- Image -->
                        <div class="vc-col-img">
                            <div class="vc-image-frame-v2">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/about/realistic_foundry.png" alt="ذوب و ریخته‌گری مس">
                                <span class="vc-badge-v2">گام سوم: ذوب و ریخته‌گری</span>
                            </div>
                        </div>
                        <!-- Content -->
                        <div class="vc-col-content">
                            <div class="vc-content-header">
                                <div class="vc-num-badge">۳</div>
                                <div class="vc-titles">
                                    <h3 class="vc-title-fa">ذوب و تولید آند</h3>
                                    <span class="vc-title-en">Smelting</span>
                                </div>
                            </div>
                            <p class="vc-desc">
                                کنسانتره مس تغلیظ شده در کوره‌های پیشرفته شعله‌ای و فلش حرارت داده می‌شود تا ناخالصی‌ها در قالب سرباره تخلیه و مس مات با عیار بالای ۶۰٪ حاصل شود. در مرحله بعد مس تاول‌زا تولید و سرانجام مس آندی با خلوص ۹۹.۳٪ برای ریخته‌گری در چرخ آند ریخته می‌شود.
                            </p>
                            <div class="vc-tags-row">
                                <span class="vc-tag">کوره‌های فلش پیشرفته</span>
                                <span class="vc-tag">خلوص آند: ۹۹.۳٪</span>
                                <span class="vc-tag">چرخ آند گردان</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Refining (Reversed layout) -->
                    <div class="value-chain-step-row scroll-reveal">
                        <!-- Content -->
                        <div class="vc-col-content">
                            <div class="vc-content-header">
                                <div class="vc-num-badge">۴</div>
                                <div class="vc-titles">
                                    <h3 class="vc-title-fa">تصفیه الکترولیتی</h3>
                                    <span class="vc-title-en">Refining & Cathode</span>
                                </div>
                            </div>
                            <p class="vc-desc">
                                در آخرین مرحله از زنجیره تولید، صفحات آند مس در وان‌های الکترولیت حاوی سولفات مس قرار گرفته و با اعمال جریان الکتریکی، یون‌های خالص مس به سمت ورقه‌های کاتد جذب می‌شوند. محصول نهایی، کاتد مس با خلوص عالی ۹۹.۹۹٪ است که آماده عرضه در بورس کالا و بازارهای صادراتی جهانی است.
                            </p>
                            <div class="vc-tags-row">
                                <span class="vc-tag">خلوص کاتد: ۹۹.۹۹٪</span>
                                <span class="vc-tag">استاندارد عالی LME Grade A</span>
                                <span class="vc-tag">الکترولیز صنعتی مدرن</span>
                            </div>
                        </div>
                        <!-- Image -->
                        <div class="vc-col-img vc-col-img-reverse">
                            <div class="vc-image-frame-v2">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/about/mes-premium.png" alt="الکترولیز و کاتد مس خالص">
                                <span class="vc-badge-v2">گام چهارم: الکترولیز و کاتد</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ─── SECTION 3: VISION & VALUES ─── -->
            <section class="vision-section scroll-reveal">
                <!-- Background Mesh Glows -->
                <div class="vision-mesh-glow-1"></div>
                <div class="vision-mesh-glow-2"></div>
                <div class="vision-grid-overlay"></div>

                <div class="vision-grid-row">
                    <!-- Left: Text and CTAs -->
                    <div class="vision-left-col font-peyda">
                        <span class="vision-section-badge">چشم‌انداز و استراتژی</span>
                        <h2 class="vision-title">با تکیه بر خودباوری ملی، مس‌آفرین آینده کشوریم</h2>
                        <p class="vision-desc">
                            صنایع و معادن مس کرمان زمین مصمم است با تکیه بر توان داخلی و پیاده‌سازی فناوری‌های نوین، فرآیندهای سنتی را دگرگون ساخته و تولید پایدار خود را به تراز بین‌المللی برساند.
                        </p>
                        <div class="vision-cta-buttons">
                            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="cta-btn-primary">تماس مستقیم با ما</a>
                            <a href="<?php echo esc_url( home_url( '/#news' ) ); ?>" class="cta-btn-secondary">اخبار و رویدادها</a>
                        </div>
                    </div>

                    <!-- Right: Values Grid -->
                    <div class="vision-right-col">
                        <div class="values-grid-v2">
                            <!-- Value 1 -->
                            <div class="value-card-v2">
                                <div class="value-card-icon-box">
                                    <?php echo kermancopper_icon('shield-check', 'w-5 h-5'); ?>
                                </div>
                                <h4 class="value-card-title">تعهد به کیفیت مطلق</h4>
                                <p class="value-card-desc">تولیدات ما طبق آخرین استانداردهای LME بوده و در بازارهای جهانی قابل رقابت است.</p>
                            </div>
                            
                            <!-- Value 2 -->
                            <div class="value-card-v2">
                                <div class="value-card-icon-box">
                                    <?php echo kermancopper_icon('users', 'w-5 h-5'); ?>
                                </div>
                                <h4 class="value-card-title">توسعه سرمایه انسانی</h4>
                                <p class="value-card-desc">ایجاد زمینه رشد تخصصی برای هزاران جوان بااستعداد بومی استان کرمان.</p>
                            </div>

                            <!-- Value 3 -->
                            <div class="value-card-v2">
                                <div class="value-card-icon-box">
                                    <?php echo kermancopper_icon('sprout', 'w-5 h-5'); ?>
                                </div>
                                <h4 class="value-card-title">حفظ محیط زیست</h4>
                                <p class="value-card-desc">کاهش آلایندگی با سیستم‌های کنترل آنلاین و فیلتراسیون کوره ذوب.</p>
                            </div>

                            <!-- Value 4 -->
                            <div class="value-card-v2">
                                <div class="value-card-icon-box">
                                    <?php echo kermancopper_icon('award', 'w-5 h-5'); ?>
                                </div>
                                <h4 class="value-card-title">رونق بازارهای ملی</h4>
                                <p class="value-card-desc">تضمین تامین پایدار مواد اولیه برای صنایع پایین‌دستی برق، فولاد و الکترونیک.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <!-- Scroll Intersection Observer Script -->
    <script>
    (function(){
        const els = document.querySelectorAll('.scroll-reveal');
        if(!els.length) return;
        const io = new IntersectionObserver(function(entries){
            entries.forEach(function(e){
                if(e.isIntersecting){ 
                    e.target.classList.add('revealed'); 
                    io.unobserve(e.target); 
                }
            });
        }, { threshold: 0.05 });
        els.forEach(function(el){ io.observe(el); });
    })();
    </script>
</main>

<?php get_footer(); ?>
