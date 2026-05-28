<?php
/**
 * Customizer Repeater Control
 *
 * @package KermanCopper
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return;
}

class KermanCopper_Repeater_Control extends WP_Customize_Control {
    public $type = 'kermancopper_repeater';
    public $fields = array();

    public function enqueue() {
        wp_enqueue_script( 'kermancopper-repeater', get_template_directory_uri() . '/assets/js/customizer-repeater.js', array( 'jquery', 'customize-controls' ), '1.0.0', true );
        wp_enqueue_style( 'kermancopper-repeater', get_template_directory_uri() . '/assets/css/customizer-repeater.css', array(), '1.0.0' );
    }

    public function render_content() {
        $value = $this->value();
        if ( is_string( $value ) ) {
            $value = json_decode( $value, true );
        }
        if ( ! is_array( $value ) ) {
            $value = array();
        }
        ?>
        <label>
            <?php if ( ! empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php endif; ?>
            <?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php endif; ?>
        </label>

        <div class="kermancopper-repeater-container" data-fields="<?php echo esc_attr( wp_json_encode( $this->fields ) ); ?>">
            <ul class="kermancopper-repeater-items">
                <?php
                if ( ! empty( $value ) ) {
                    foreach ( $value as $index => $item ) {
                        $this->render_item( $item );
                    }
                }
                ?>
            </ul>
            <button type="button" class="button kermancopper-repeater-add"><?php esc_html_e( 'افزودن آیتم جدید', 'kermancopper' ); ?></button>
            <input type="hidden" class="kermancopper-repeater-value" <?php $this->link(); ?> value="<?php echo esc_attr( wp_json_encode( $value ) ); ?>" />
        </div>
        <?php
    }

    private function render_item( $item_data = array() ) {
        ?>
        <li class="kermancopper-repeater-item">
            <div class="kermancopper-repeater-item-header">
                <span class="dashicons dashicons-menu"></span>
                <span class="kermancopper-repeater-item-title"><?php esc_html_e( 'آیتم', 'kermancopper' ); ?></span>
                <button type="button" class="kermancopper-repeater-item-remove"><span class="dashicons dashicons-no-alt"></span></button>
            </div>
            <div class="kermancopper-repeater-item-content">
                <?php foreach ( $this->fields as $field_key => $field_args ) : ?>
                    <div class="kermancopper-repeater-field">
                        <label><?php echo esc_html( $field_args['label'] ); ?></label>
                        <?php
                        $field_value = isset( $item_data[ $field_key ] ) ? $item_data[ $field_key ] : '';
                        if ( 'textarea' === $field_args['type'] ) {
                            echo '<textarea data-field="' . esc_attr( $field_key ) . '">' . esc_textarea( $field_value ) . '</textarea>';
                        } else {
                            echo '<input type="text" data-field="' . esc_attr( $field_key ) . '" value="' . esc_attr( $field_value ) . '" />';
                        }
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </li>
        <?php
    }
}
