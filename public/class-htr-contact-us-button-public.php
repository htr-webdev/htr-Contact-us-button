<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Htr_Contact_Us_Button
 * @subpackage Htr_Contact_Us_Button/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Htr_Contact_Us_Button
 * @subpackage Htr_Contact_Us_Button/public
 * @author     Your Name <email@example.com>
 */
class HTR_Contact_Us_Button_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version           The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in HTR_Contact_Us_Button_Loader as all of the hooks are defined
         * in HTR_Contact_Us_Button_Loader. Run the HTR_Contact_Us_Button_Loader to
         * execute the hooks with WordPress.
         */
        wp_enqueue_style( $this->plugin_name, HTR_CUB_PLUGIN_URL . 'public/css/htr-contact-us-button-public.css', array(), $this->version, 'all' );
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in HTR_Contact_Us_Button_Loader as all of the hooks are defined
         * in HTR_Contact_Us_Button_Loader. Run the HTR_Contact_Us_Button_Loader to
         * execute the hooks with WordPress.
         */
        wp_enqueue_script( $this->plugin_name, HTR_CUB_PLUGIN_URL . 'public/js/htr-contact-us-button-public.js', array( 'jquery' ), $this->version, false );
    }

    /**
     * Render the contact buttons on the front-end.
     *
     * @since    1.0.0
     */
    public function render_contact_buttons() {
        $options = get_option( 'htr_cub_options' );

        // Check if buttons should be displayed on the current page
        if ( ! $this->should_display_on_current_page( $options ) ) {
            return;
        }

        $display_mode = isset( $options['htr_cub_display_mode'] ) ? $options['htr_cub_display_mode'] : 'single';
        $button_position = isset( $options['htr_cub_button_position'] ) ? $options['htr_cub_button_position'] : 'bottom-right';
        $bottom_offset = isset( $options['htr_cub_bottom_offset'] ) ? $options['htr_cub_bottom_offset'] : 20;
        $right_offset = isset( $options['htr_cub_right_offset'] ) ? $options['htr_cub_right_offset'] : 20;
        $top_offset = isset( $options['htr_cub_top_offset'] ) ? $options['htr_cub_top_offset'] : 20;
        $left_offset = isset( $options['htr_cub_left_offset'] ) ? $options['htr_cub_left_offset'] : 20;

        $button_bg_color = isset( $options['htr_cub_button_bg_color'] ) ? $options['htr_cub_button_bg_color'] : '#0073aa';
        $button_icon_color = isset( $options['htr_cub_button_icon_color'] ) ? $options['htr_cub_button_icon_color'] : '#ffffff';
        $button_border_color = isset( $options['htr_cub_button_border_color'] ) ? $options['htr_cub_button_border_color'] : '#0073aa';
        $button_shadow = isset( $options['htr_cub_button_shadow'] ) ? $options['htr_cub_button_shadow'] : '0px 0px 10px rgba(0,0,0,0.2)';
        $button_hover_bg_color = isset( $options['htr_cub_button_hover_bg_color'] ) ? $options['htr_cub_button_hover_bg_color'] : '#005177';
        $button_hover_icon_color = isset( $options['htr_cub_button_hover_icon_color'] ) ? $options['htr_cub_button_hover_icon_color'] : '#ffffff';
        $button_hover_border_color = isset( $options['htr_cub_button_hover_border_color'] ) ? $options['htr_cub_button_hover_border_color'] : '#005177';

        $sub_buttons = isset( $options['htr_cub_sub_buttons'] ) ? $options['htr_cub_sub_buttons'] : array();

        // Generate dynamic CSS
        $dynamic_css = "
            .htr-cub-wrapper {
                position: fixed;
                z-index: 9999;
        ";

        if ( 'bottom-right' === $button_position ) {
            $dynamic_css .= "bottom: {$bottom_offset}px; right: {$right_offset}px;";
        } elseif ( 'bottom-left' === $button_position ) {
            $dynamic_css .= "bottom: {$bottom_offset}px; left: {$left_offset}px;";
        } elseif ( 'top-right' === $button_position ) {
            $dynamic_css .= "top: {$top_offset}px; right: {$right_offset}px;";
        } elseif ( 'top-left' === $button_position ) {
            $dynamic_css .= "top: {$top_offset}px; left: {$left_offset}px;";
        }

        $dynamic_css .= "
            }
            .htr-cub-button {
                background-color: {$button_bg_color};
                color: {$button_icon_color};
                border-color: {$button_border_color};
                box-shadow: {$button_shadow};
            }
            .htr-cub-button:hover {
                background-color: {$button_hover_bg_color};
                color: {$button_hover_icon_color};
                border-color: {$button_hover_border_color};
            }
        ";

        wp_add_inline_style( $this->plugin_name, $dynamic_css );

        // Render buttons based on display mode
        echo '<div class="htr-cub-wrapper htr-cub-display-mode-' . esc_attr( $display_mode ) . '">';

        if ( 'single' === $display_mode ) {
            // Render a single button (main button)
            echo '<a href="#" class="htr-cub-button htr-cub-main-button">Main Button</a>'; // Placeholder
        } elseif ( in_array( $display_mode, array( 'multiple_horizontal', 'multiple_vertical' ) ) ) {
            // Render multiple buttons
            foreach ( $sub_buttons as $button ) {
                echo '<a href="' . esc_url( $button['link'] ) . '" target="' . esc_attr( $button['target'] ) . '" class="htr-cub-button">' . esc_html( $button['name'] ) . '</a>';
            }
        } elseif ( in_array( $display_mode, array( 'dropdown_vertical', 'dropdown_horizontal' ) ) ) {
            // Render dropdown menu
            echo '<div class="htr-cub-dropdown">';
            echo '<button class="htr-cub-button htr-cub-main-button">Main Button</button>'; // Placeholder for main dropdown button
            echo '<div class="htr-cub-dropdown-content">';
            foreach ( $sub_buttons as $button ) {
                echo '<a href="' . esc_url( $button['link'] ) . '" target="' . esc_attr( $button['target'] ) . '">' . esc_html( $button['name'] ) . '</a>';
            }
            echo '</div>';
            echo '</div>';
        }

        echo '</div>';
    }

    /**
     * Check if the contact buttons should be displayed on the current page.
     *
     * @since    1.0.0
     * @param    array    $options    The plugin options.
     * @return   bool                 True if buttons should be displayed, false otherwise.
     */
    private function should_display_on_current_page( $options ) {
        $display_pages = isset( $options['htr_cub_display_pages'] ) ? $options['htr_cub_display_pages'] : 'all';
        $custom_pages = isset( $options['htr_cub_custom_pages'] ) ? array_map( 'trim', explode( ',', $options['htr_cub_custom_pages'] ) ) : array();

        if ( 'all' === $display_pages ) {
            return true;
        } elseif ( 'homepage' === $display_pages && is_front_page() ) {
            return true;
        } elseif ( 'product_pages' === $display_pages && function_exists( 'is_product' ) && is_product() ) {
            return true;
        } elseif ( 'blog_pages' === $display_pages && ( is_home() || is_archive() || is_single() ) ) { // Covers blog home, archives, and single posts
            return true;
        } elseif ( 'category_pages' === $display_pages && is_category() ) {
            return true;
        } elseif ( 'custom' === $display_pages && ! empty( $custom_pages ) ) {
            global $post;
            if ( $post && ( in_array( $post->ID, $custom_pages ) || in_array( $post->post_name, $custom_pages ) ) ) {
                return true;
            }
        }

        return false;
    }

}
