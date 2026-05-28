<?php
/**
 * Header Settings Panel
 *
 * @package KermanCopper
 */

/**
 * Register Header Controls
 * 
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kermancopper_customize_header( $wp_customize ) {
    
    // Panel: Header Settings
    $wp_customize->add_panel( 'kermancopper_header_panel', array(
        'title'       => __( 'تنظیمات هدر', 'kermancopper' ),
        'priority'    => 20,
        'description' => __( 'مدیریت نوار بالایی، لوگو و شبکه‌های اجتماعی', 'kermancopper' ),
    ) );

    // Section: Top Bar Info
    $wp_customize->add_section( 'kermancopper_topbar_section', array(
        'title'    => __( 'نوار اطلاعات (Top Bar)', 'kermancopper' ),
        'panel'    => 'kermancopper_header_panel',
        'priority' => 10,
    ) );

    // Setting: Show Top Bar
    $wp_customize->add_setting( 'kermancopper_show_topbar', array(
        'default'           => true,
        'sanitize_callback' => 'kermancopper_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'kermancopper_show_topbar', array(
        'label'    => __( 'نمایش نوار بالایی', 'kermancopper' ),
        'section'  => 'kermancopper_topbar_section',
        'type'     => 'checkbox',
    ) );

    // Setting: Address
    $wp_customize->add_setting( 'kermancopper_address', array(
        'default'           => 'تهران، سعادت آباد، خیابان مروارید ۲۶۴۹',
        'sanitize_callback' => 'kermancopper_sanitize_text',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'kermancopper_address', array(
        'label'    => __( 'آدرس شرکت', 'kermancopper' ),
        'section'  => 'kermancopper_topbar_section',
        'type'     => 'text',
    ) );

    // Setting: Email
    $wp_customize->add_setting( 'kermancopper_email', array(
        'default'           => 'info@copperindustry.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'kermancopper_email', array(
        'label'    => __( 'ایمیل تماس', 'kermancopper' ),
        'section'  => 'kermancopper_topbar_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_phone', array(
        'default'           => '',
        'sanitize_callback' => 'kermancopper_sanitize_text',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'kermancopper_phone', array(
        'label'    => __( 'شماره تماس', 'kermancopper' ),
        'section'  => 'kermancopper_topbar_section',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'kermancopper_customize_header' );

if ( class_exists( 'WP_Customize_Control' ) ) {
    class KermanCopper_Rich_Text_Control extends WP_Customize_Control {
        public $type = 'kermancopper_richtext';

        public function render_content() {
            if ( empty( $this->label ) ) {
                return;
            }
            echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
            if ( ! empty( $this->description ) ) {
                echo '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
            }
            wp_editor( $this->value(), $this->id, array(
                'textarea_name' => $this->id,
                'textarea_rows' => 5,
                'teeny'         => true,
                'media_buttons' => false,
            ) );
        }
    }
}

if ( class_exists( 'WP_Customize_Control' ) ) {
    class KermanCopper_Faq_Repeater_Control extends WP_Customize_Control {
        public $type = 'kermancopper_faq_repeater';

        private function render_item( $index, $question, $answer ) {
            ?>
            <div class="kermancopper-faq-item" data-index="<?php echo esc_attr( $index ); ?>">
                <p>
                    <label><?php echo esc_html__( 'سوال', 'kermancopper' ); ?></label>
                    <input type="text" class="widefat faq-question" value="<?php echo esc_attr( $question ); ?>" />
                </p>
                <p>
                    <label><?php echo esc_html__( 'پاسخ', 'kermancopper' ); ?></label>
                    <textarea rows="3" class="widefat faq-answer"><?php echo esc_textarea( $answer ); ?></textarea>
                </p>
                <button type="button" class="button-link-delete faq-remove"><?php echo esc_html__( 'حذف', 'kermancopper' ); ?></button>
            </div>
            <?php
        }

        public function render_content() {
            if ( empty( $this->label ) ) {
                return;
            }
            $items = json_decode( $this->value(), true );
            if ( ! is_array( $items ) ) {
                $items = array();
            }
            ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <div class="kermancopper-faq-control">
                <div class="kermancopper-faq-items">
                    <?php foreach ( $items as $index => $item ) : ?>
                        <?php
                        $question = isset( $item['question'] ) ? $item['question'] : '';
                        $answer = isset( $item['answer'] ) ? $item['answer'] : '';
                        $this->render_item( $index, $question, $answer );
                        ?>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="button faq-add"><?php echo esc_html__( 'افزودن سوال', 'kermancopper' ); ?></button>
                <input type="hidden" class="faq-items-json" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
            </div>
            <?php
        }
    }
}

function kermancopper_faq_item_markup( $index = 0, $question = '', $answer = '' ) {
    ob_start();
    ?>
    <div class="kermancopper-faq-item" data-index="<?php echo esc_attr( $index ); ?>">
        <p>
            <label><?php echo esc_html__( 'سوال', 'kermancopper' ); ?></label>
            <input type="text" class="widefat faq-question" value="<?php echo esc_attr( $question ); ?>" />
        </p>
        <p>
            <label><?php echo esc_html__( 'پاسخ', 'kermancopper' ); ?></label>
            <textarea rows="3" class="widefat faq-answer"><?php echo esc_textarea( $answer ); ?></textarea>
        </p>
        <button type="button" class="button-link-delete faq-remove"><?php echo esc_html__( 'حذف', 'kermancopper' ); ?></button>
    </div>
    <?php
    return ob_get_clean();
}

function kermancopper_faq_item_add() {
    if ( ! current_user_can( 'edit_theme_options' ) ) {
        wp_send_json_error();
    }
    check_ajax_referer( 'kermancopper_faq_nonce', 'nonce' );
    $index = isset( $_POST['index'] ) ? absint( wp_unslash( $_POST['index'] ) ) : 0;
    wp_send_json_success(
        array(
            'html' => kermancopper_faq_item_markup( $index ),
        )
    );
}
add_action( 'wp_ajax_kermancopper_faq_item_add', 'kermancopper_faq_item_add' );

function kermancopper_faq_item_remove() {
    if ( ! current_user_can( 'edit_theme_options' ) ) {
        wp_send_json_error();
    }
    check_ajax_referer( 'kermancopper_faq_nonce', 'nonce' );
    wp_send_json_success();
}
add_action( 'wp_ajax_kermancopper_faq_item_remove', 'kermancopper_faq_item_remove' );

function kermancopper_customize_faq_controls_assets() {
    $nonce = wp_create_nonce( 'kermancopper_faq_nonce' );
    $data = wp_json_encode(
        array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => $nonce,
        )
    );
    $script = "window.KermanCopperFaqControl = $data;";
    $script .= <<<'JS'
jQuery(function($){
    function serializeFaq($control){
        var items=[];
        $control.find('.kermancopper-faq-item').each(function(){
            var q=$(this).find('.faq-question').val()||'';
            var a=$(this).find('.faq-answer').val()||'';
            if(q!==''||a!==''){items.push({question:q,answer:a});}
        });
        $control.find('.faq-items-json').val(JSON.stringify(items)).trigger('change');
    }
    $(document).on('click','.kermancopper-faq-control .faq-add',function(e){
        e.preventDefault();
        var $control=$(this).closest('.kermancopper-faq-control');
        var index=$control.find('.kermancopper-faq-item').length;
        $.post(window.KermanCopperFaqControl.ajaxUrl,{action:'kermancopper_faq_item_add',nonce:window.KermanCopperFaqControl.nonce,index:index}).done(function(resp){
            if(resp&&resp.success&&resp.data&&resp.data.html){
                $control.find('.kermancopper-faq-items').append(resp.data.html);
                serializeFaq($control);
            }
        });
    });
    $(document).on('click','.kermancopper-faq-control .faq-remove',function(e){
        e.preventDefault();
        var $item=$(this).closest('.kermancopper-faq-item');
        var $control=$(this).closest('.kermancopper-faq-control');
        $.post(window.KermanCopperFaqControl.ajaxUrl,{action:'kermancopper_faq_item_remove',nonce:window.KermanCopperFaqControl.nonce}).always(function(){
            $item.remove();
            serializeFaq($control);
        });
    });
    $(document).on('input','.kermancopper-faq-control .faq-question, .kermancopper-faq-control .faq-answer',function(){
        var $control=$(this).closest('.kermancopper-faq-control');
        serializeFaq($control);
    });
});
JS;
    wp_add_inline_script( 'customize-controls', $script );
}
add_action( 'customize_controls_enqueue_scripts', 'kermancopper_customize_faq_controls_assets' );



function kermancopper_customize_homepage( $wp_customize ) {
    if ( ! current_user_can( 'edit_theme_options' ) ) {
        return;
    }

    $wp_customize->add_panel( 'kermancopper_homepage_panel', array(
        'title'       => __( 'تنظیمات صفحه اصلی', 'kermancopper' ),
        'priority'    => 30,
    ) );

    $wp_customize->add_section( 'kermancopper_home_news_notices_section', array(
        'title'    => __( 'مدیریت اخبار و اطلاعیه‌ها', 'kermancopper' ),
        'panel'    => 'kermancopper_homepage_panel',
        'priority' => 10,
    ) );

    $categories = get_categories( array( 'hide_empty' => false ) );
    $category_choices = array( '' => __( 'انتخاب دسته', 'kermancopper' ) );
    foreach ( $categories as $category ) {
        $category_choices[ $category->term_id ] = $category->name;
    }

    $wp_customize->add_setting( 'kermancopper_home_news_title', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_news_title', array(
        'label'    => __( 'عنوان بخش اخبار', 'kermancopper' ),
        'section'  => 'kermancopper_home_news_notices_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_news_kicker', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_news_kicker', array(
        'label'   => __( 'متن بالای عنوان اخبار', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_news_category', array(
        'sanitize_callback' => 'kermancopper_sanitize_category_id',
    ) );
    $wp_customize->add_control( 'kermancopper_home_news_category', array(
        'label'   => __( 'دسته‌بندی اخبار', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'select',
        'choices' => $category_choices,
    ) );

    $wp_customize->add_setting( 'kermancopper_home_news_count', array(
        'sanitize_callback' => 'kermancopper_sanitize_number_range_1_20',
    ) );
    $wp_customize->add_control( 'kermancopper_home_news_count', array(
        'label'       => __( 'تعداد نمایش اخبار', 'kermancopper' ),
        'section'     => 'kermancopper_home_news_notices_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1, 'max' => 20 ),
    ) );

    $wp_customize->add_setting( 'kermancopper_home_news_archive_text', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_50',
    ) );
    $wp_customize->add_control( 'kermancopper_home_news_archive_text', array(
        'label'   => __( 'متن دکمه آرشیو اخبار', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_news_show_date', array(
        'sanitize_callback' => 'kermancopper_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'kermancopper_home_news_show_date', array(
        'label'   => __( 'نمایش تاریخ اخبار', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'checkbox',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_news_archive_url', array(
        'sanitize_callback' => 'kermancopper_sanitize_url',
    ) );
    $wp_customize->add_control( 'kermancopper_home_news_archive_url', array(
        'label'       => __( 'لینک آرشیو اخبار', 'kermancopper' ),
        'section'     => 'kermancopper_home_news_notices_section',
        'type'        => 'url',
        'input_attrs' => array( 'readonly' => 'readonly' ),
        'description' => __( 'به صورت خودکار از دسته انتخابی ساخته می‌شود.', 'kermancopper' ),
    ) );

    $wp_customize->add_setting( 'kermancopper_home_notices_title', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_notices_title', array(
        'label'    => __( 'عنوان بخش اطلاعیه‌ها', 'kermancopper' ),
        'section'  => 'kermancopper_home_news_notices_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_notices_kicker', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_notices_kicker', array(
        'label'   => __( 'متن بالای عنوان اطلاعیه‌ها', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_section( 'kermancopper_home_hero_section', array(
        'title'    => __( 'مدیریت هدر اصلی', 'kermancopper' ),
        'panel'    => 'kermancopper_homepage_panel',
        'priority' => 15,
    ) );

    $wp_customize->add_setting( 'kermancopper_home_hero_slide_1_image_id', array(
        'sanitize_callback' => 'kermancopper_sanitize_image_id',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'kermancopper_home_hero_slide_1_image_id', array(
        'label'     => __( 'تصویر پس‌زمینه هدر', 'kermancopper' ),
        'section'   => 'kermancopper_home_hero_section',
        'mime_type' => 'image',
    ) ) );

    $wp_customize->add_setting( 'kermancopper_home_hero_slide_1_alt', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_hero_slide_1_alt', array(
        'label'   => __( 'متن جایگزین تصویر پس‌زمینه هدر', 'kermancopper' ),
        'section' => 'kermancopper_home_hero_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_hero_badge_text', array(
        'default'           => 'صنایع و معادن مس کرمان زمین | مهد مس ایران',
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_hero_badge_text', array(
        'label'   => __( 'متن نشان بالای عنوان (Badge)', 'kermancopper' ),
        'section' => 'kermancopper_home_hero_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_hero_pattern_image_id', array(
        'sanitize_callback' => 'kermancopper_sanitize_image_id',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'kermancopper_home_hero_pattern_image_id', array(
        'label'     => __( 'تصویر پترن هدر', 'kermancopper' ),
        'section'   => 'kermancopper_home_hero_section',
        'mime_type' => 'image',
    ) ) );

    $wp_customize->add_setting( 'kermancopper_home_hero_title', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_hero_title', array(
        'label'   => __( 'عنوان اصلی هدر (خط اول)', 'kermancopper' ),
        'section' => 'kermancopper_home_hero_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_hero_title_highlight', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_hero_title_highlight', array(
        'label'       => __( 'بخش رنگی عنوان هدر (گرادیانت مسی)', 'kermancopper' ),
        'description' => __( 'این متن پس از کلمه «قلب» با رنگ مسی گرادیانت نمایش داده می‌شود.', 'kermancopper' ),
        'section'     => 'kermancopper_home_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_hero_subtitle', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_hero_subtitle', array(
        'label'   => __( 'زیرعنوان هدر', 'kermancopper' ),
        'section' => 'kermancopper_home_hero_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_hero_description', array(
        'sanitize_callback' => 'kermancopper_sanitize_text',
    ) );
    $wp_customize->add_control( 'kermancopper_home_hero_description', array(
        'label'   => __( 'توضیحات هدر', 'kermancopper' ),
        'section' => 'kermancopper_home_hero_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_hero_button_primary_text', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_hero_button_primary_text', array(
        'label'   => __( 'متن دکمه اول', 'kermancopper' ),
        'section' => 'kermancopper_home_hero_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_hero_button_primary_url', array(
        'sanitize_callback' => 'kermancopper_sanitize_url',
    ) );
    $wp_customize->add_control( 'kermancopper_home_hero_button_primary_url', array(
        'label'   => __( 'لینک دکمه اول', 'kermancopper' ),
        'section' => 'kermancopper_home_hero_section',
        'type'    => 'url',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_hero_button_secondary_text', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_hero_button_secondary_text', array(
        'label'   => __( 'متن دکمه دوم', 'kermancopper' ),
        'section' => 'kermancopper_home_hero_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_hero_button_secondary_url', array(
        'sanitize_callback' => 'kermancopper_sanitize_url',
    ) );
    $wp_customize->add_control( 'kermancopper_home_hero_button_secondary_url', array(
        'label'   => __( 'لینک دکمه دوم', 'kermancopper' ),
        'section' => 'kermancopper_home_hero_section',
        'type'    => 'url',
    ) );

    $wp_customize->add_section( 'kermancopper_home_about_section', array(
        'title'    => __( 'مدیریت درباره ما', 'kermancopper' ),
        'panel'    => 'kermancopper_homepage_panel',
        'priority' => 20,
    ) );

    $wp_customize->add_setting( 'kermancopper_home_about_kicker', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_about_kicker', array(
        'label'   => __( 'متن بالای عنوان', 'kermancopper' ),
        'section' => 'kermancopper_home_about_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_about_title_highlight', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_about_title_highlight', array(
        'label'   => __( 'بخش رنگی عنوان', 'kermancopper' ),
        'section' => 'kermancopper_home_about_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_about_title_rest', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_about_title_rest', array(
        'label'   => __( 'ادامه عنوان', 'kermancopper' ),
        'section' => 'kermancopper_home_about_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_about_description', array(
        'sanitize_callback' => 'kermancopper_sanitize_text',
    ) );
    $wp_customize->add_control( 'kermancopper_home_about_description', array(
        'label'   => __( 'توضیحات درباره ما', 'kermancopper' ),
        'section' => 'kermancopper_home_about_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_about_mission_title', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_50',
    ) );
    $wp_customize->add_control( 'kermancopper_home_about_mission_title', array(
        'label'   => __( 'عنوان ماموریت', 'kermancopper' ),
        'section' => 'kermancopper_home_about_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_about_mission_text', array(
        'sanitize_callback' => 'kermancopper_sanitize_text',
    ) );
    $wp_customize->add_control( 'kermancopper_home_about_mission_text', array(
        'label'   => __( 'متن ماموریت', 'kermancopper' ),
        'section' => 'kermancopper_home_about_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_about_vision_title', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_50',
    ) );
    $wp_customize->add_control( 'kermancopper_home_about_vision_title', array(
        'label'   => __( 'عنوان چشم‌انداز', 'kermancopper' ),
        'section' => 'kermancopper_home_about_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_about_vision_text', array(
        'sanitize_callback' => 'kermancopper_sanitize_text',
    ) );
    $wp_customize->add_control( 'kermancopper_home_about_vision_text', array(
        'label'   => __( 'متن چشم‌انداز', 'kermancopper' ),
        'section' => 'kermancopper_home_about_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_about_secondary_image_id', array(
        'sanitize_callback' => 'kermancopper_sanitize_image_id',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'kermancopper_home_about_secondary_image_id', array(
        'label'      => __( 'تصویر دوم درباره ما (کارخانه ذوب)', 'kermancopper' ),
        'section'    => 'kermancopper_home_about_section',
        'mime_type'  => 'image',
    ) ) );

    $wp_customize->add_setting( 'kermancopper_home_about_main_image_id', array(
        'sanitize_callback' => 'kermancopper_sanitize_image_id',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'kermancopper_home_about_main_image_id', array(
        'label'     => __( 'تصویر اول درباره ما (معدن)', 'kermancopper' ),
        'section'   => 'kermancopper_home_about_section',
        'mime_type' => 'image',
    ) ) );

    $wp_customize->add_setting( 'kermancopper_home_about_experience_count', array(
        'sanitize_callback' => 'kermancopper_sanitize_number_nonnegative',
    ) );
    $wp_customize->add_control( 'kermancopper_home_about_experience_count', array(
        'label'   => __( 'عدد سابقه', 'kermancopper' ),
        'section' => 'kermancopper_home_about_section',
        'type'    => 'number',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_about_experience_label', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_about_experience_label', array(
        'label'   => __( 'متن سابقه - خط اول', 'kermancopper' ),
        'section' => 'kermancopper_home_about_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_about_experience_sublabel', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_about_experience_sublabel', array(
        'label'   => __( 'متن سابقه - خط دوم', 'kermancopper' ),
        'section' => 'kermancopper_home_about_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_notices_category', array(
        'sanitize_callback' => 'kermancopper_sanitize_category_id',
    ) );
    $wp_customize->add_control( 'kermancopper_home_notices_category', array(
        'label'   => __( 'دسته‌بندی اطلاعیه‌ها', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'select',
        'choices' => $category_choices,
    ) );

    $wp_customize->add_setting( 'kermancopper_home_notices_count', array(
        'sanitize_callback' => 'kermancopper_sanitize_number_range_1_20',
    ) );
    $wp_customize->add_control( 'kermancopper_home_notices_count', array(
        'label'       => __( 'تعداد نمایش اطلاعیه‌ها', 'kermancopper' ),
        'section'     => 'kermancopper_home_news_notices_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1, 'max' => 20 ),
    ) );

    $wp_customize->add_setting( 'kermancopper_home_notices_archive_text', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_50',
    ) );
    $wp_customize->add_control( 'kermancopper_home_notices_archive_text', array(
        'label'   => __( 'متن دکمه آرشیو اطلاعیه‌ها', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_notices_show_date', array(
        'sanitize_callback' => 'kermancopper_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'kermancopper_home_notices_show_date', array(
        'label'   => __( 'نمایش تاریخ اطلاعیه‌ها', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'checkbox',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_notices_archive_url', array(
        'sanitize_callback' => 'kermancopper_sanitize_url',
    ) );
    $wp_customize->add_control( 'kermancopper_home_notices_archive_url', array(
        'label'       => __( 'لینک آرشیو اطلاعیه‌ها', 'kermancopper' ),
        'section'     => 'kermancopper_home_news_notices_section',
        'type'        => 'url',
        'input_attrs' => array( 'readonly' => 'readonly' ),
        'description' => __( 'به صورت خودکار از دسته انتخابی ساخته می‌شود.', 'kermancopper' ),
    ) );

    $wp_customize->add_section( 'kermancopper_home_faq_section', array(
        'title'    => __( 'مدیریت سوالات متداول', 'kermancopper' ),
        'panel'    => 'kermancopper_homepage_panel',
        'priority' => 20,
    ) );

    $wp_customize->add_setting( 'kermancopper_home_faq_kicker', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_faq_kicker', array(
        'label'   => __( 'متن بالای عنوان سوالات متداول', 'kermancopper' ),
        'section' => 'kermancopper_home_faq_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_faq_title', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_faq_title', array(
        'label'   => __( 'عنوان بخش سوالات متداول', 'kermancopper' ),
        'section' => 'kermancopper_home_faq_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_faq_description', array(
        'sanitize_callback' => 'kermancopper_sanitize_text',
    ) );
    $wp_customize->add_control( 'kermancopper_home_faq_description', array(
        'label'   => __( 'توضیحات سوالات متداول', 'kermancopper' ),
        'section' => 'kermancopper_home_faq_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_faq_link_text', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_50',
    ) );
    $wp_customize->add_control( 'kermancopper_home_faq_link_text', array(
        'label'   => __( 'متن لینک پشتیبانی', 'kermancopper' ),
        'section' => 'kermancopper_home_faq_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_faq_link_url', array(
        'sanitize_callback' => 'kermancopper_sanitize_url',
    ) );
    $wp_customize->add_control( 'kermancopper_home_faq_link_url', array(
        'label'   => __( 'لینک پشتیبانی', 'kermancopper' ),
        'section' => 'kermancopper_home_faq_section',
        'type'    => 'url',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_faq_items', array(
        'sanitize_callback' => 'kermancopper_sanitize_faq_items',
    ) );
    $wp_customize->add_control( new KermanCopper_Faq_Repeater_Control( $wp_customize, 'kermancopper_home_faq_items', array(
        'label'   => __( 'سوالات و پاسخ‌ها', 'kermancopper' ),
        'section' => 'kermancopper_home_faq_section',
    ) ) );


}
add_action( 'customize_register', 'kermancopper_customize_homepage' );
