<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Htr_Contact_Us_Button
 * @subpackage Htr_Contact_Us_Button/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Htr_Contact_Us_Button
 * @subpackage Htr_Contact_Us_Button/admin
 * @author     Your Name <email@example.com>
 */
class HTR_Contact_Us_Button_Admin {

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
     * Register the stylesheets for the admin area.
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
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( $this->plugin_name, HTR_CUB_PLUGIN_URL . 'admin/css/htr-contact-us-button-admin.css', array(), $this->version, 'all' );
    }

    /**
     * Register the JavaScript for the admin area.
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
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( $this->plugin_name, HTR_CUB_PLUGIN_URL . 'admin/js/htr-contact-us-button-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );

        wp_localize_script(
            $this->plugin_name,
            'htr_cub_admin',
            array(
                'name_label'        => esc_html__( 'Name:', 'htr-cub' ),
                'icon_label'        => esc_html__( 'Icon (Font Awesome class):', 'htr-cub' ),
                'link_label'        => esc_html__( 'Link:', 'htr-cub' ),
                'target_label'      => esc_html__( 'Link Target:', 'htr-cub' ),
                'same_tab_label'    => esc_html__( 'Same Tab', 'htr-cub' ),
                'new_tab_label'     => esc_html__( 'New Tab', 'htr-cub' ),
                'remove_button_label' => esc_html__( 'Remove Button', 'htr-cub' ),
            )
        );
    }

    /**
     * Add options page to the admin menu.
     *
     * @since    1.0.0
     */
    public function add_plugin_admin_menu() {
        add_options_page(
            'HTR Contact Us Button Settings',
            'Contact Us Button',
            'manage_options',
            $this->plugin_name,
            array( $this, 'display_plugin_setup_page' )
        );
    }

    /**
     * Register all settings, sections, and fields.
     *
     * @since    1.0.0
     */
    public function register_settings() {
        register_setting(
            $this->plugin_name,
            'htr_cub_options',
            array( $this, 'htr_cub_options_validate' )
        );

        add_settings_section(
            'htr_cub_general_settings',
            'General Settings',
            array( $this, 'htr_cub_general_settings_callback' ),
            $this->plugin_name
        );

        add_settings_field(
            'htr_cub_button_position',
            'Button Position',
            array( $this, 'htr_cub_button_position_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_bottom_offset',
            'Bottom Offset (px)',
            array( $this, 'htr_cub_bottom_offset_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_right_offset',
            'Right Offset (px)',
            array( $this, 'htr_cub_right_offset_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_top_offset',
            'Top Offset (px)',
            array( $this, 'htr_cub_top_offset_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_left_offset',
            'Left Offset (px)',
            array( $this, 'htr_cub_left_offset_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_display_pages',
            'Display On Pages',
            array( $this, 'htr_cub_display_pages_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_custom_pages',
            'Custom Page IDs/Slugs (comma-separated)',
            array( $this, 'htr_cub_custom_pages_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_display_mode',
            'Button Display Mode',
            array( $this, 'htr_cub_display_mode_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_button_bg_color',
            'Button Background Color',
            array( $this, 'htr_cub_button_bg_color_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_button_icon_color',
            'Button Icon Color',
            array( $this, 'htr_cub_button_icon_color_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_button_border_color',
            'Button Border Color',
            array( $this, 'htr_cub_button_border_color_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_button_shadow',
            'Button Shadow (CSS value)',
            array( $this, 'htr_cub_button_shadow_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_button_hover_bg_color',
            'Button Hover Background Color',
            array( $this, 'htr_cub_button_hover_bg_color_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_button_hover_icon_color',
            'Button Hover Icon Color',
            array( $this, 'htr_cub_button_hover_icon_color_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_button_hover_border_color',
            'Button Hover Border Color',
            array( $this, 'htr_cub_button_hover_border_color_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );

        add_settings_field(
            'htr_cub_sub_buttons',
            'Sub Buttons',
            array( $this, 'htr_cub_sub_buttons_callback' ),
            $this->plugin_name,
            'htr_cub_general_settings'
        );
    }

    /**
     * Sanitize and validate the plugin options.
     *
     * @since    1.0.0
     * @param    array    $input    The array of settings as submitted by the form.
     * @return   array              The sanitized and validated settings.
     */
    public function htr_cub_options_validate( $input ) {
        $new_input = array();
        if ( isset( $input['htr_cub_button_position'] ) ) {
            $new_input['htr_cub_button_position'] = sanitize_text_field( $input['htr_cub_button_position'] );
        }
        if ( isset( $input['htr_cub_bottom_offset'] ) ) {
            $new_input['htr_cub_bottom_offset'] = absint( $input['htr_cub_bottom_offset'] );
        }
        if ( isset( $input['htr_cub_right_offset'] ) ) {
            $new_input['htr_cub_right_offset'] = absint( $input['htr_cub_right_offset'] );
        }
        if ( isset( $input['htr_cub_top_offset'] ) ) {
            $new_input['htr_cub_top_offset'] = absint( $input['htr_cub_top_offset'] );
        }
        if ( isset( $input['htr_cub_left_offset'] ) ) {
            $new_input['htr_cub_left_offset'] = absint( $input['htr_cub_left_offset'] );
        }
        if ( isset( $input['htr_cub_display_pages'] ) ) {
            $new_input['htr_cub_display_pages'] = sanitize_text_field( $input['htr_cub_display_pages'] );
        }
        if ( isset( $input['htr_cub_custom_pages'] ) ) {
            $new_input['htr_cub_custom_pages'] = sanitize_text_field( $input['htr_cub_custom_pages'] );
        }
        if ( isset( $input['htr_cub_display_mode'] ) ) {
            $new_input['htr_cub_display_mode'] = sanitize_text_field( $input['htr_cub_display_mode'] );
        }
        if ( isset( $input['htr_cub_button_bg_color'] ) ) {
            $new_input['htr_cub_button_bg_color'] = sanitize_hex_color( $input['htr_cub_button_bg_color'] );
        }
        if ( isset( $input['htr_cub_button_icon_color'] ) ) {
            $new_input['htr_cub_button_icon_color'] = sanitize_hex_color( $input['htr_cub_button_icon_color'] );
        }
        if ( isset( $input['htr_cub_button_border_color'] ) ) {
            $new_input['htr_cub_button_border_color'] = sanitize_hex_color( $input['htr_cub_button_border_color'] );
        }
        if ( isset( $input['htr_cub_button_shadow'] ) ) {
            $new_input['htr_cub_button_shadow'] = sanitize_text_field( $input['htr_cub_button_shadow'] );
        }
        if ( isset( $input['htr_cub_button_hover_bg_color'] ) ) {
            $new_input['htr_cub_button_hover_bg_color'] = sanitize_hex_color( $input['htr_cub_button_hover_bg_color'] );
        }
        if ( isset( $input['htr_cub_button_hover_icon_color'] ) ) {
            $new_input['htr_cub_button_hover_icon_color'] = sanitize_hex_color( $input['htr_cub_button_hover_icon_color'] );
        }
        if ( isset( $input['htr_cub_button_hover_border_color'] ) ) {
            $new_input['htr_cub_button_hover_border_color'] = sanitize_hex_color( $input['htr_cub_button_hover_border_color'] );
        }
        if ( isset( $input['htr_cub_sub_buttons'] ) && is_array( $input['htr_cub_sub_buttons'] ) ) {
            $new_input['htr_cub_sub_buttons'] = array();
            foreach ( $input['htr_cub_sub_buttons'] as $button ) {
                $new_button = array();
                if ( isset( $button['name'] ) ) {
                    $new_button['name'] = sanitize_text_field( $button['name'] );
                }
                if ( isset( $button['icon'] ) ) {
                    $new_button['icon'] = sanitize_text_field( $button['icon'] );
                }
                if ( isset( $button['link'] ) ) {
                    $new_button['link'] = esc_url_raw( $button['link'] );
                }
                if ( isset( $button['target'] ) ) {
                    $new_button['target'] = sanitize_text_field( $button['target'] );
                }
                $new_input['htr_cub_sub_buttons'][] = $new_button;
            }
        }
        return $new_input;
    }

    /**
     * Render the general settings section callback.
     *
     * @since    1.0.0
     */
    public function htr_cub_general_settings_callback() {
        echo '<p>' . esc_html__( 'Configure the general settings for the Contact Us Button.', 'htr-cub' ) . '</p>';
    }

    /**
     * Render the button position setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_button_position_callback() {
        $options = get_option( 'htr_cub_options' );
        $position = isset( $options['htr_cub_button_position'] ) ? $options['htr_cub_button_position'] : 'bottom-right';
        ?>
        <select id="htr_cub_button_position" name="htr_cub_options[htr_cub_button_position]">
            <option value="bottom-right" <?php selected( $position, 'bottom-right' ); ?>><?php esc_html_e( 'Bottom Right', 'htr-cub' ); ?></option>
            <option value="bottom-left" <?php selected( $position, 'bottom-left' ); ?>><?php esc_html_e( 'Bottom Left', 'htr-cub' ); ?></option>
            <option value="top-right" <?php selected( $position, 'top-right' ); ?>><?php esc_html_e( 'Top Right', 'htr-cub' ); ?></option>
            <option value="top-left" <?php selected( $position, 'top-left' ); ?>><?php esc_html_e( 'Top Left', 'htr-cub' ); ?></option>
        </select>
        <?php
    }

    /**
     * Render the bottom offset setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_bottom_offset_callback() {
        $options = get_option( 'htr_cub_options' );
        $bottom_offset = isset( $options['htr_cub_bottom_offset'] ) ? $options['htr_cub_bottom_offset'] : 20;
        ?>
        <input type="number" id="htr_cub_bottom_offset" name="htr_cub_options[htr_cub_bottom_offset]" value="<?php echo esc_attr( $bottom_offset ); ?>" min="0" /> px
        <?php
    }

    /**
     * Render the right offset setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_right_offset_callback() {
        $options = get_option( 'htr_cub_options' );
        $right_offset = isset( $options['htr_cub_right_offset'] ) ? $options['htr_cub_right_offset'] : 20;
        ?>
        <input type="number" id="htr_cub_right_offset" name="htr_cub_options[htr_cub_right_offset]" value="<?php echo esc_attr( $right_offset ); ?>" min="0" /> px
        <?php
    }

    /**
     * Render the top offset setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_top_offset_callback() {
        $options = get_option( 'htr_cub_options' );
        $top_offset = isset( $options['htr_cub_top_offset'] ) ? $options['htr_cub_top_offset'] : 20;
        ?>
        <input type="number" id="htr_cub_top_offset" name="htr_cub_options[htr_cub_top_offset]" value="<?php echo esc_attr( $top_offset ); ?>" min="0" /> px
        <?php
    }

    /**
     * Render the left offset setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_left_offset_callback() {
        $options = get_option( 'htr_cub_options' );
        $left_offset = isset( $options['htr_cub_left_offset'] ) ? $options['htr_cub_left_offset'] : 20;
        ?>
        <input type="number" id="htr_cub_left_offset" name="htr_cub_options[htr_cub_left_offset]" value="<?php echo esc_attr( $left_offset ); ?>" min="0" /> px
        <?php
    }

    /**
     * Render the display on pages setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_display_pages_callback() {
        $options = get_option( 'htr_cub_options' );
        $display_pages = isset( $options['htr_cub_display_pages'] ) ? $options['htr_cub_display_pages'] : 'all';
        ?>
        <select id="htr_cub_display_pages" name="htr_cub_options[htr_cub_display_pages]">
            <option value="all" <?php selected( $display_pages, 'all' ); ?>><?php esc_html_e( 'All Pages', 'htr-cub' ); ?></option>
            <option value="homepage" <?php selected( $display_pages, 'homepage' ); ?>><?php esc_html_e( 'Homepage', 'htr-cub' ); ?></option>
            <option value="product_pages" <?php selected( $display_pages, 'product_pages' ); ?>><?php esc_html_e( 'Product Pages', 'htr-cub' ); ?></option>
            <option value="blog_pages" <?php selected( $display_pages, 'blog_pages' ); ?>><?php esc_html_e( 'Blog Pages', 'htr-cub' ); ?></option>
            <option value="category_pages" <?php selected( $display_pages, 'category_pages' ); ?>><?php esc_html_e( 'Category Pages', 'htr-cub' ); ?></option>
            <option value="custom" <?php selected( $display_pages, 'custom' ); ?>><?php esc_html_e( 'Custom Pages', 'htr-cub' ); ?></option>
        </select>
        <?php
    }

    /**
     * Render the custom page IDs/slugs setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_custom_pages_callback() {
        $options = get_option( 'htr_cub_options' );
        $custom_pages = isset( $options['htr_cub_custom_pages'] ) ? $options['htr_cub_custom_pages'] : '';
        ?>
        <input type="text" id="htr_cub_custom_pages" name="htr_cub_options[htr_cub_custom_pages]" value="<?php echo esc_attr( $custom_pages ); ?>" class="regular-text" />
        <p class="description"><?php esc_html_e( 'Enter comma-separated page IDs or slugs where the buttons should be displayed (e.g., 1, 2, my-page-slug).', 'htr-cub' ); ?></p>
        <?php
    }

    /**
     * Render the button display mode setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_display_mode_callback() {
        $options = get_option( 'htr_cub_options' );
        $display_mode = isset( $options['htr_cub_display_mode'] ) ? $options['htr_cub_display_mode'] : 'single';
        ?>
        <select id="htr_cub_display_mode" name="htr_cub_options[htr_cub_display_mode]">
            <option value="single" <?php selected( $display_mode, 'single' ); ?>><?php esc_html_e( 'Single Button', 'htr-cub' ); ?></option>
            <option value="multiple_horizontal" <?php selected( $display_mode, 'multiple_horizontal' ); ?>><?php esc_html_e( 'Multiple Buttons (Horizontal)', 'htr-cub' ); ?></option>
            <option value="multiple_vertical" <?php selected( $display_mode, 'multiple_vertical' ); ?>><?php esc_html_e( 'Multiple Buttons (Vertical)', 'htr-cub' ); ?></option>
            <option value="dropdown_vertical" <?php selected( $display_mode, 'dropdown_vertical' ); ?>><?php esc_html_e( 'Dropdown Menu (Vertical)', 'htr-cub' ); ?></option>
            <option value="dropdown_horizontal" <?php selected( $display_mode, 'dropdown_horizontal' ); ?>><?php esc_html_e( 'Dropdown Menu (Horizontal)', 'htr-cub' ); ?></option>
        </select>
        <?php
    }

    /**
     * Render the button background color setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_button_bg_color_callback() {
        $options = get_option( 'htr_cub_options' );
        $bg_color = isset( $options['htr_cub_button_bg_color'] ) ? $options['htr_cub_button_bg_color'] : '#0073aa';
        ?>
        <input type="text" id="htr_cub_button_bg_color" name="htr_cub_options[htr_cub_button_bg_color]" value="<?php echo esc_attr( $bg_color ); ?>" class="htr-cub-color-picker" />
        <?php
    }

    /**
     * Render the button icon color setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_button_icon_color_callback() {
        $options = get_option( 'htr_cub_options' );
        $icon_color = isset( $options['htr_cub_button_icon_color'] ) ? $options['htr_cub_button_icon_color'] : '#ffffff';
        ?>
        <input type="text" id="htr_cub_button_icon_color" name="htr_cub_options[htr_cub_button_icon_color]" value="<?php echo esc_attr( $icon_color ); ?>" class="htr-cub-color-picker" />
        <?php
    }

    /**
     * Render the button border color setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_button_border_color_callback() {
        $options = get_option( 'htr_cub_options' );
        $border_color = isset( $options['htr_cub_button_border_color'] ) ? $options['htr_cub_button_border_color'] : '#0073aa';
        ?>
        <input type="text" id="htr_cub_button_border_color" name="htr_cub_options[htr_cub_button_border_color]" value="<?php echo esc_attr( $border_color ); ?>" class="htr-cub-color-picker" />
        <?php
    }

    /**
     * Render the button shadow setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_button_shadow_callback() {
        $options = get_option( 'htr_cub_options' );
        $shadow = isset( $options['htr_cub_button_shadow'] ) ? $options['htr_cub_button_shadow'] : '0px 0px 10px rgba(0,0,0,0.2)';
        ?>
        <input type="text" id="htr_cub_button_shadow" name="htr_cub_options[htr_cub_button_shadow]" value="<?php echo esc_attr( $shadow ); ?>" class="regular-text" />
        <p class="description"><?php esc_html_e( 'Enter CSS box-shadow value (e.g., 0px 0px 10px rgba(0,0,0,0.2)).', 'htr-cub' ); ?></p>
        <?php
    }

    /**
     * Render the button hover background color setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_button_hover_bg_color_callback() {
        $options = get_option( 'htr_cub_options' );
        $hover_bg_color = isset( $options['htr_cub_button_hover_bg_color'] ) ? $options['htr_cub_button_hover_bg_color'] : '#005177';
        ?>
        <input type="text" id="htr_cub_button_hover_bg_color" name="htr_cub_options[htr_cub_button_hover_bg_color]" value="<?php echo esc_attr( $hover_bg_color ); ?>" class="htr-cub-color-picker" />
        <?php
    }

    /**
     * Render the button hover icon color setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_button_hover_icon_color_callback() {
        $options = get_option( 'htr_cub_options' );
        $hover_icon_color = isset( $options['htr_cub_button_hover_icon_color'] ) ? $options['htr_cub_button_hover_icon_color'] : '#ffffff';
        ?>
        <input type="text" id="htr_cub_button_hover_icon_color" name="htr_cub_options[htr_cub_button_hover_icon_color]" value="<?php echo esc_attr( $hover_icon_color ); ?>" class="htr-cub-color-picker" />
        <?php
    }

    /**
     * Render the button hover border color setting field.
     *
     * @since    1.0.0
     */
    public function htr_cub_button_hover_border_color_callback() {
        $options = get_option( 'htr_cub_options' );
        $hover_border_color = isset( $options['htr_cub_button_hover_border_color'] ) ? $options['htr_cub_button_hover_border_color'] : '#005177';
        ?>
        <input type="text" id="htr_cub_button_hover_border_color" name="htr_cub_options[htr_cub_button_hover_border_color]" value="<?php echo esc_attr( $hover_border_color ); ?>" class="htr-cub-color-picker" />
        <?php
    }

    /**
     * Render the sub buttons repeater field.
     *
     * @since    1.0.0
     */
    public function htr_cub_sub_buttons_callback() {
        $options = get_option( 'htr_cub_options' );
        $sub_buttons = isset( $options['htr_cub_sub_buttons'] ) ? $options['htr_cub_sub_buttons'] : array();
        ?>
        <div id="htr-cub-sub-buttons-repeater">
            <div class="htr-cub-sub-buttons-list">
                <?php if ( ! empty( $sub_buttons ) ) : ?>
                    <?php foreach ( $sub_buttons as $index => $button ) : ?>
                        <div class="htr-cub-sub-button-item">
                            <p>
                                <label for="htr_cub_sub_buttons_<?php echo $index; ?>_name"><?php esc_html_e( 'Name:', 'htr-cub' ); ?></label>
                                <input type="text" id="htr_cub_sub_buttons_<?php echo $index; ?>_name" name="htr_cub_options[htr_cub_sub_buttons][<?php echo $index; ?>][name]" value="<?php echo esc_attr( $button['name'] ); ?>" class="regular-text" />
                            </p>
                            <p>
                                <label for="htr_cub_sub_buttons_<?php echo $index; ?>_icon"><?php esc_html_e( 'Icon (Font Awesome class):', 'htr-cub' ); ?></label>
                                <input type="text" id="htr_cub_sub_buttons_<?php echo $index; ?>_icon" name="htr_cub_options[htr_cub_sub_buttons][<?php echo $index; ?>][icon]" value="<?php echo esc_attr( $button['icon'] ); ?>" class="regular-text" />
                            </p>
                            <p>
                                <label for="htr_cub_sub_buttons_<?php echo $index; ?>_link"><?php esc_html_e( 'Link:', 'htr-cub' ); ?></label>
                                <input type="url" id="htr_cub_sub_buttons_<?php echo $index; ?>_link" name="htr_cub_options[htr_cub_sub_buttons][<?php echo $index; ?>][link]" value="<?php echo esc_attr( $button['link'] ); ?>" class="regular-text" />
                            </p>
                            <p>
                                <label for="htr_cub_sub_buttons_<?php echo $index; ?>_target"><?php esc_html_e( 'Link Target:', 'htr-cub' ); ?></label>
                                <select id="htr_cub_sub_buttons_<?php echo $index; ?>_target" name="htr_cub_options[htr_cub_sub_buttons][<?php echo $index; ?>][target]">
                                    <option value="_self" <?php selected( $button['target'], '_self' ); ?>><?php esc_html_e( 'Same Tab', 'htr-cub' ); ?></option>
                                    <option value="_blank" <?php selected( $button['target'], '_blank' ); ?>><?php esc_html_e( 'New Tab', 'htr-cub' ); ?></option>
                                </select>
                            </p>
                            <button type="button" class="button htr-cub-remove-sub-button"><?php esc_html_e( 'Remove Button', 'htr-cub' ); ?></button>
                            <hr />
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <button type="button" class="button button-secondary" id="htr-cub-add-sub-button"><?php esc_html_e( 'Add New Sub Button', 'htr-cub' ); ?></button>
        </div>
        <?php
    }

    /**
     * Render the settings page for the plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_setup_page() {
        include_once HTR_CUB_PLUGIN_DIR . 'admin/partials/htr-contact-us-button-admin-display.php';
    }

}
