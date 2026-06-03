/*
 * This is the public JavaScript file for HTR Contact Us Button plugin.
 */
(function( $ ) {
    'use strict';

    $(document).ready(function() {
        // Handle dropdown menu toggle
        $('.htr-cub-dropdown .htr-cub-main-button').on('click', function(e) {
            e.preventDefault();
            $(this).next('.htr-cub-dropdown-content').toggleClass('show');
        });

        // Close the dropdown if the user clicks outside of it
        $(window).on('click', function(e) {
            if (!$(e.target).closest('.htr-cub-dropdown').length) {
                $('.htr-cub-dropdown-content').removeClass('show');
            }
        });
    });

})( jQuery );
