/*
 * This is the public JavaScript file for HTR Contact Us Button plugin.
 */
(function( $ ) {
    'use strict';

    $(document).ready(function() {
        // Handle dropdown menu toggle for mobile/click support
        $('.htr-cub-toggle-btn').on('click', function(e) {
            e.preventDefault();
            $(this).closest('.htr-cub-dropdown').toggleClass('active');
        });

        // Close the dropdown if the user clicks outside of it
        $(window).on('click', function(e) {
            if (!$(e.target).closest('.htr-cub-dropdown').length) {
                $('.htr-cub-dropdown').removeClass('active');
            }
        });
    });

})( jQuery );
