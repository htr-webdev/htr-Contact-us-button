<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Htr_Contact_Us_Button
 * @subpackage Htr_Contact_Us_Button/admin/partials
 */
?>

<div class="wrap">

    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

    <form method="post" name="htr_cub_options" action="options.php">

        <?php
            // Grab all settings fields
            settings_fields( $this->plugin_name );
            do_settings_sections( $this->plugin_name );
            submit_button();
        ?>

    </form>

</div>
